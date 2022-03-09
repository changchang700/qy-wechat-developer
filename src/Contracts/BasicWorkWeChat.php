<?php
namespace WorkWeChat\Contracts;

use Exception;
use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\DataError;
use WorkWeChat\Contracts\DataArray;
use WorkWeChat\Exceptions\InvalidArgumentException;
use WorkWeChat\Exceptions\InvalidResponseException;

/**
 * 实例类属性
 * 
 * Class BasicWeChat
 * @package WeChat\Contracts
 */
class BasicWorkWeChat
{

    /**
     * 企业微信配置
     *
     * @var array
     */
    public $config = [];

    /**
     * 访问AccessToken
     * @var string
     */
    public $access_token = '';

    /**
     * 企业微信SDK实例
     * @var array
     */
    public $instance = [];

    /**
     * 实例参数配置
     * @var array
     */
    public $conf = [];

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
     * 企业应用access_token
     *
     * @var [type]
     */
    protected $sub_access_token = null;

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

        $this->config = $this->conf[static::class] = new DataArray($options);
        $this->init();
    }

    public function init()
    {
        if (empty($this->getConfig())) throw new Exception('实例未初始化');
    }

    /**
     * 静态创建对象
     *
     * @param array $config
     * @return array
     */
    public static function instance(array $config):array
    {
        $key = md5(get_called_class() . serialize($config));
        if (isset(self::$cache[$key])) return self::$cache[$key];
        return self::$cache[$key] = new static($config);
    }

    /**
     * 获取访问accessToken
     *
     * @return string
     */
    public function getAccessToken():string
    {
        if (!empty($this->access_token)) {
            return $this->access_token;
        }

        $this->access_token = Tools::getCache($this->getAccessTokenCacheKey());
        if (!empty($this->access_token)) {
            return $this->access_token;
        }
        // 处理开放平台授权公众号获取AccessToken
        list($corpid, $corpsecret) = [$this->conf[static::class]->get('corpid'), $this->conf[static::class]->get('corpsecret')];
        $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$corpid}&corpsecret={$corpsecret}";
        $result = Tools::json2arr(Tools::get($url));
        if (!empty($result['access_token'])) {
            Tools::setCache($this->getAccessTokenCacheKey(), $result['access_token'], $result['expires_in'] ?? 7000);
        }
        return $this->access_token = $result['access_token'];
    }

    /**
     * 获取下级企业的access_token
     * @return string
     */
    public function getSubCorpAccessToken():string
    {
        if (!empty($this->sub_access_token)) {
            return $this->sub_access_token;
        }

        $this->sub_access_token = Tools::getCache($this->getAccessTokenCacheKey(true));
        if (!empty($this->sub_access_token)) {
            return $this->sub_access_token;
        }

        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/gettoken?access_token=".$this->getAccessToken();
        [$corpid, $agentid] = [$this->conf[static::class]->get('corpid'), $this->conf[static::class]->get('agentid')];

        $result = Tools::json2arr(Tools::post($url, compact('corpid','agentid')));
        if (!empty($result['access_token'])) {
            Tools::setCache($this->getAccessTokenCacheKey(true), $result['access_token'], $result['expires_in']);
        }
        return $this->sub_access_token = $result['access_token'];
    }

    /**
     * 设置外部接口 AccessToken
     * @param string $access_token
     *
     * 当用户使用自己的缓存驱动时，直接实例化对象后可直接设置 AccessToekn
     * - 多用于分布式项目时保持 AccessToken 统一
     * - 使用此方法后就由用户来保证传入的 AccessToekn 为有效 AccessToekn
     */
    public function setAccessToken($access_token):void
    {
        if (!is_string($access_token)) {
            throw new InvalidArgumentException("Invalid AccessToken type, need string.");
        }

        Tools::setCache($this->getAccessTokenCacheKey(), $this->access_token = $access_token);
    }

    /**
     * 获取缓存键名
     * @param bool $is_sub  【false 获取下级企业的access_token】，
     * @return string
     */
    private function getAccessTokenCacheKey($is_sub = false): string
    {
        $cache_type = $is_sub ? '_sub_access_token' : '_access_token';
        return $this->conf[static::class]->get('appid') . $this->conf[static::class]->get('corpsecret') . $cache_type ;
    }

    /**
     * 清理删除 AccessToken
     * @return bool
     */
    public function delAccessToken():bool
    {
        $this->access_token = '';
        return Tools::delCache($this->getAccessTokenCacheKey());
    }

    /**
     * 以GET获取接口数据并转为数组
     * @param string $url 接口地址
     * @return array
     * @throws InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     */
    protected function httpGetForJson($url):array
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
            throw new InvalidResponseException($e->getMessage()."【".DataError::toMessage($e->getCode())."】", $e->getCode());
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
    protected function httpPostForJson($url, array $data, $buildToJson = true,$enEmoji = true):array
    {
        try {
            return Tools::json2arr(Tools::post($url, $buildToJson ? Tools::arr2json($data,$enEmoji) : $data));
        } catch (InvalidResponseException $e) {
            if (!$this->isTry && in_array($e->getCode(), ['40014', '40001', '41001', '42001'])) {
                [$this->delAccessToken(), $this->isTry = true];
                return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
            }
            throw new InvalidResponseException($e->getMessage()."【".DataError::toMessage($e->getCode())."】", $e->getCode());
        }
    }

    /**
     * 注册当前请求接口
     * @param string $url 接口地址
     * @param string $method 当前接口方法
     * @param array $arguments 请求参数
     * @return mixed
     */
    protected function registerApi(&$url, $method, $arguments = []):string
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
     */
    public function callPostApi($url, array $data, $isBuildJson = true): array
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data, $isBuildJson);
    }

    /**
     * 接口通用GET请求方法
     * @param string $url 接口URL
     * @return array
     */
    public function callGetApi($url): array
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     *
     * @param $method
     * @param $argument
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $argument)
    {
        if (is_subclass_of($class = static::class, get_parent_class(static::class))) {

            $instance = new $class($this->conf[static::class]->get() ?? []);
            $this->init();
            if (method_exists($instance, $method)) {
                return $instance->$method(...$argument);
            }
        }

        throw new \Exception('不存在的方法调用'.static::class.'->'.$method);
    }

    /**
     * 获取应用配置
     * @return array|string|null
     */
    public function getConfig()
    {
        $this->config = $this->conf[static::class];
        return $this->config->get();
    }

    /**
     * 设置应用配置
     * @param array $config
     * @return $this
     */
    public function setConfig()
    {
        if (func_num_args()==2) {
            $config = array_replace_recursive($this->conf[static::class]->get(), [func_get_args()[0]=>func_get_args()[1]]);
        } else {
            $config = array_replace_recursive($this->conf[static::class]->get(), func_get_args()[0]);
        }

        $this->config = $this->conf[static::class] = new DataArray($config);
        return $this;
    }

    /**
     * 获取实例对象
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        $class = '\WorkWeChat\\'.ucfirst($key);

        if (is_subclass_of($class, get_parent_class(static::class))) {
            $instance = new $class($this->conf[static::class]->get() ?? []);
            $this->init();
            $this->instance[$class] = $instance;
            return $instance;
        }

        throw new \Exception('不存在的调用'.static::class.'->'.$key);
    }
}