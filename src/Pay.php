<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/25
 * Time: 14:01
 */

namespace WorkWeChat;


use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 支付
 * Class Pay
 * @package WorkWeChat
 */
class Pay extends BasicWorkWeChat
{
    /**
     * 新增商户号
     * @param array $data
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function addmerchant(array $data)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalpay/addmerchant?access_token=ACCESS_TOKEN';
        $this->registerApi($url,__METHOD__, func_get_args());

        return $this->callPostApi($url, $data);
    }

    /**
     * 查询商户号详情
     * @param string $mch_id
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getmerchant(string $mch_id)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalpay/getmerchant?access_token=ACCESS_TOKEN';
        $this->registerApi($url,__METHOD__, func_get_args());

        return $this->callGetApi($url, compact('mch_id'));
    }

    /**
     * 删除商户号
     * @param string $mch_id
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function delmerchant(string $mch_id)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalpay/delmerchant?access_token=ACCESS_TOKEN';
        $this->registerApi($url,__METHOD__, func_get_args());

        return $this->callPostApi($url, compact('mch_id'));
    }

    /**
     * 设置商户号使用范围
     * @param array $data
     * @example  参数结构{
            "mch_id":"12334",
            "allow_use_scope": {
            "user": ["zhangsan","lisi"],
            "partyid": [1],
                "tagid": [1,2,3]
            }
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function setMchUseScope(array $data)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalpay/set_mch_use_scope?access_token=ACCESS_TOKEN';
        $this->registerApi($url,__METHOD__, func_get_args());

        return $this->callPostApi($url, compact('data'));
    }

    /**
     * 获取对外收款记录
     * @param array $data
     * @example  请求参数结构{
        "begin_time":1605171726,
        "end_time":1605172726,
        "payee_userid":"zhangshan",
        "cursor":"CURSOR",
        "limit":10
    }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getBillList(array $data)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalpay/get_bill_list?access_token=ACCESS_TOKEN';

        $this->registerApi($url,__METHOD__, func_get_args());
        return $this->callPostApi($url, compact('data'));
    }
}