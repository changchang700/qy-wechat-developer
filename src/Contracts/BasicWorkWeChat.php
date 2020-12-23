<?php
namespace WorkWeChat\Contracts;

use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\DataArray;
use WorkWeChat\Exceptions\InvalidArgumentException;
use WorkWeChat\Exceptions\InvalidResponseException;

/**
 * Class BasicWeChat
 * @package WeChat\Contracts
 */
class BasicWorkWeChat
{

    /**
     * 当前微信配置
     * @var DataArray
     */
    public $config;

    /**
     * 访问AccessToken
     * @var string
     */
    public $access_token = '';

    /**
     * 当前请求方法参数
     * @var array
     */
    protected $currentMethod = [];

    /**
     * 当前模式
     * @var bool
     */
    protected $isTry = false;

    /**
     * 静态缓存
     * @var static
     */
    protected static $cache;

    /**
     * BasicWeChat constructor.
     * @param array $options
     */
    public function __construct(array $options){
        if (empty($options['corpid'])) {
            throw new InvalidArgumentException("Missing Config -- [corpid]");
        }
        if (empty($options['corpsecret'])) {
            throw new InvalidArgumentException("Missing Config -- [corpsecret]");
        }
        if (!empty($options['cache_path'])) {
            Tools::$cache_path = $options['cache_path'];
        }
        $this->config = new DataArray($options);
    }

    /**
     * 静态创建对象
     * @param array $config
     * @return static
     */
    public static function instance(array $config){
        $key = md5(get_called_class() . serialize($config));
        if (isset(self::$cache[$key])) return self::$cache[$key];
        return self::$cache[$key] = new static($config);
    }

    /**
     * 获取访问accessToken
     * @return string
     * @throws \WeChat\Exceptions\InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    public function getAccessToken()
    {
        if (!empty($this->access_token)) {
            return $this->access_token;
        }
        $cache = $this->config->get('appid') . '_access_token';
        $this->access_token = Tools::getCache($cache);
        if (!empty($this->access_token)) {
            return $this->access_token;
        }
        // 处理开放平台授权公众号获取AccessToken
        if (!empty($this->GetAccessTokenCallback) && is_callable($this->GetAccessTokenCallback)) {
            $this->access_token = call_user_func_array($this->GetAccessTokenCallback, [$this->config->get('appid'), $this]);
            if (!empty($this->access_token)) {
                Tools::setCache($cache, $this->access_token, 7000);
            }
            return $this->access_token;
        }
        list($corpid, $corpsecret) = [$this->config->get('corpid'), $this->config->get('corpsecret')];
        $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$corpid}&corpsecret={$corpsecret}";
        $result = Tools::json2arr(Tools::get($url));
        if (!empty($result['access_token'])) {
            Tools::setCache($cache, $result['access_token'], 7000);
        }
        return $this->access_token = $result['access_token'];
    }

    /**
     * 设置外部接口 AccessToken
     * @param string $access_token
     * @throws \WeChat\Exceptions\LocalCacheException
     * @author 高一平 <iam@gaoyiping.com>
     *
     * 当用户使用自己的缓存驱动时，直接实例化对象后可直接设置 AccessToekn
     * - 多用于分布式项目时保持 AccessToken 统一
     * - 使用此方法后就由用户来保证传入的 AccessToekn 为有效 AccessToekn
     */
    public function setAccessToken($access_token)
    {
        if (!is_string($access_token)) {
            throw new InvalidArgumentException("Invalid AccessToken type, need string.");
        }
        $cache = $this->config->get('appid') . '_access_token';
        Tools::setCache($cache, $this->access_token = $access_token);
    }

    /**
     * 清理删除 AccessToken
     * @return bool
     */
    public function delAccessToken()
    {
        $this->access_token = '';
        return Tools::delCache($this->config->get('appid') . '_access_token');
    }

    /**
     * 以GET获取接口数据并转为数组
     * @param string $url 接口地址
     * @return array
     * @throws InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    protected function httpGetForJson($url)
    {
        try {
            return Tools::json2arr(Tools::get($url));
        } catch (InvalidResponseException $e) {
            if (isset($this->currentMethod['method']) && empty($this->isTry)) {
                if (in_array($e->getCode(), ['40014', '40001', '41001', '42001'])) {
                    $this->delAccessToken();
                    $this->isTry = true;
                    return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
                }
            }
            throw new InvalidResponseException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 以POST获取接口数据并转为数组
     * @param string $url 接口地址
     * @param array $data 请求数据
     * @param bool $buildToJson
     * @return array
     * @throws InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    protected function httpPostForJson($url, array $data, $buildToJson = true,$enEmoji = true)
    {
        try {
            return Tools::json2arr(Tools::post($url, $buildToJson ? Tools::arr2json($data,$enEmoji) : $data));
        } catch (InvalidResponseException $e) {
            if (!$this->isTry && in_array($e->getCode(), ['40014', '40001', '41001', '42001'])) {
                [$this->delAccessToken(), $this->isTry = true];
                return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
            }
            throw new InvalidResponseException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 注册当前请求接口
     * @param string $url 接口地址
     * @param string $method 当前接口方法
     * @param array $arguments 请求参数
     * @return mixed
     * @throws \WeChat\Exceptions\InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    protected function registerApi(&$url, $method, $arguments = [])
    {
        $this->currentMethod = ['method' => $method, 'arguments' => $arguments];
        if (empty($this->access_token)) {
            $this->access_token = $this->getAccessToken();
        }
        return $url = str_replace('ACCESS_TOKEN', $this->access_token, $url);
    }

    /**
     * 接口通用POST请求方法
     * @param string $url 接口URL
     * @param array $data POST提交接口参数
     * @param bool $isBuildJson
     * @return array
     * @throws InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    public function callPostApi($url, array $data, $isBuildJson = true)
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data, $isBuildJson);
    }

    /**
     * 接口通用GET请求方法
     * @param string $url 接口URL
     * @return array
     * @throws InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    public function callGetApi($url)
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

}