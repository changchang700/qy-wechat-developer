<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/22
 * Time: 16:57
 */

namespace WorkWeChat;


use WorkWeChat\Contracts\DataArray;
use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\UserServiceContracts;

class RedPackage
{
    private $config;

    /**
     * 初始化
     * RedPackage constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (empty($options['mch_id'])) {
            throw new InvalidArgumentException("Missing Config -- [缺少商户ID：mch_id]");
        }

        if (empty($options['wxappid'])) {
            throw new InvalidArgumentException("Missing Config -- [缺少企业微信APPID：wxappid或者企业微信的CorpID]");
        }

        if (empty($options['api_secret'])) {
            throw new InvalidArgumentException("Missing Config -- [缺少商户平台API密钥：secret]");
        }

        if (empty($options['agent_secret'])) {
            throw new InvalidArgumentException("Missing Config -- [缺少企业支付这个应用的secret]");
        }

        $this->config = new DataArray($options);
    }

    /**
     * 订单频率
     * @var string
     */
    private $click_cache = 'order:click';
    /**
     * 订单频率上限
     * @var string
     */
    private $click_top = 1800;
    /**
     * 总金额上限
     * @var string
     */
    private $amount_top = 1000000;
    /**
     * 总金额
     * @var string
     */
    private $amount_cache = 'amount:price';
    private $ssl_key = '-';
    private $ssl_cer = '-';

    private const PRODUCT = [
        'PRODUCT_1' => '商品促销',
        'PRODUCT_2' => '抽奖',
        'PRODUCT_3' => '虚拟物品兑奖',
        'PRODUCT_4' => '企业内部福利',
        'PRODUCT_5' => '渠道分润',
        'PRODUCT_6' => '保险回馈',
        'PRODUCT_7' => '彩票派奖',
        'PRODUCT_8' => '税务刮奖',
    ];

    /**
     * 发放企业红包
     * @param array $data
     * @return bool|string
     * @throws Exceptions\LocalCacheException
     */
    public function generalOrder(array $data)
    {
        $click = Tools::getCache($this->click_cache) ?? 0;
        $amount = Tools::getCache($this->amount_cache) ?? 0;

        if ($click>=$this->amount_top->click_top) throw new \Exception('发送过于频繁，1800/每分钟');
        if ($amount>=1800) throw new \Exception('商户单日出资金额上限—100万元');

        $data['nonce_str'] = random(32);

        $data['mch_billno'] = date('YmdHis').random(11,true).rand(100,999);

        if (isset($data['sender_name']) and $data['sender_name']) {
            unset($data['agentid']);
        }

        if (isset($data['agentid']) and $data['agentid']) {
            unset($data['sender_name']);
        }

        if ((float)$data['total_amount']>200 or (float)$data['total_amount'] < 1) $data['scene_id'] = self::PRODUCT['PRODUCT_4'];

        $sign = Signature::getSignature($data, $this->config->get('api_secret'));
        $workwx_sign = Signature::getSignature($data, $this->config->get('agent_secret'));

        $postData = Tools::arr2xml($data);

        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendworkwxredpack';

        Tools::setCache($this->click_cache,$click+1,60);
        Tools::setCache($this->amount_cache, $amount+=$data['total_amount'], strtotime(date('Y-m-d 23:59:9')));

        return $this->sslPost($postData);
    }

    /**
     * 获取红包记录
     * @param array $data
     * @return bool|string
     * @throws Exceptions\LocalCacheException
     */
    public function getRedPocket(array $data)
    {
        try {
            $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/queryworkwxredpack';

            $data['nonce_str'] = random(32);
            $data['sign'] = Signature::getSignature($data, $this->config->get('api_secret'));
            return $this->sslPost($data);
        } catch (\Exception $e) {

        }
    }

    /**
     * 向员工付款
     * @param UserServiceContracts $user
     * @param array $data
     * @return bool|string
     */
    public function pay2Employe(UserServiceContracts $user, array $data)
    {
        try {

            /**
             * @TODO 需要对频率金额作出逻辑判断
             */
            $user->checkId();
            $user->count();
            $user->dayAmountLimits();
            $user->perAmount();
            $user->perTime();

            $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/paywwsptrans2pocket';

            $data['workwx_sign'] = Signature::getSignature($data, $this->config->get('api_secret'));
            return $this->sslPost($data);
        } catch (\Exception $e) {

        }

    }

    /**
     * 查询付款记录
     * @param array $data
     * @throws \Exception
     */
    public function queryWwspPrans2Pocket(array $data)
    {
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/querywwsptrans2pocket';

        try {
            $data['nonce_str'] = random(32);
            $data['sign'] = Signature::getSignature($data, $this->config->get('api_secret'));

            $this->sslPost($data);
        } catch (\Exception $e) {

        }
    }

    /**
     * 支付请求
     * @param array $data
     * @return bool|string
     * @throws Exceptions\LocalCacheException
     */
    private function sslPost(array $data)
    {
        $data['ssl_cer'] = $this->ssl_cer;
        $data['ssl_key'] = $this->ssl_key;
        return Tools::post($url, $data);
    }

}