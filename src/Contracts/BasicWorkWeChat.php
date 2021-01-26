<?php
namespace WorkWeChat\Contracts;

use mysql_xdevapi\Exception;
use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\DataArray;
use WorkWeChat\Exceptions\InvalidArgumentException;
use WorkWeChat\Exceptions\InvalidResponseException;

/**
 * 实例类属性
 * @property \WorkWeChat\Agent $agent
 * @property \WorkWeChat\Appchat $appchat
 * @property \WorkWeChat\Batch $batch
 * @property \WorkWeChat\Card $card
 * @property \WorkWeChat\Checkin $checkin
 * @property \WorkWeChat\Corp $corp
 * @property \WorkWeChat\Corpgroup $corpgroup
 * @property \WorkWeChat\Department $department
 * @property \WorkWeChat\Dial $dial
 * @property \WorkWeChat\Externalcontact  $externalcontact
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
     * 实例
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

        $this->access_token = Tools::getCache($this->getAccessTokenCacheKey());
        if (!empty($this->access_token)) {
            return $this->access_token;
        }
        // 处理开放平台授权公众号获取AccessToken
        if (!empty($this->GetAccessTokenCallback) && is_callable($this->GetAccessTokenCallback)) {
            $this->access_token = call_user_func_array($this->GetAccessTokenCallback, [$this->conf[static::class]->get('appid'), $this]);
            if (!empty($this->access_token)) {
                Tools::setCache($this->getAccessTokenCacheKey(), $this->access_token, 7000);
            }
            return $this->access_token;
        }
        list($corpid, $corpsecret) = [$this->conf[static::class]->get('corpid'), $this->conf[static::class]->get('corpsecret')];
        $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$corpid}&corpsecret={$corpsecret}";
        $result = Tools::json2arr(Tools::get($url));
        if (!empty($result['access_token'])) {
            Tools::setCache($this->getAccessTokenCacheKey(), $result['access_token'], $result['expires_in'] ?? 7000);
        }
        return $this->access_token = $result['access_token'];
    }

    protected $sub_access_token = null;

    /**
     * 获取下级企业的access_token
     * @return mixed|null
     * @throws InvalidResponseException
     * @throws \WorkWeChat\Exceptions\LocalCacheException
     */
    public function getSubCorpAccessToken()
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

        Tools::setCache($this->getAccessTokenCacheKey(), $this->access_token = $access_token);
    }

    /**
     * 获取缓存键名
     * @param bool $is_sub  【false 获取下级企业的access_token】，
     * @return string
     */
    private function getAccessTokenCacheKey($is_sub = false)
    {
        $cache_type = $is_sub ? '_sub_access_token' : '_access_token';
        return $this->conf[static::class]->get('appid') . $this->conf[static::class]->get('corpsecret') . $cache_type ;
    }

    /**
     * 清理删除 AccessToken
     * @return bool
     */
    public function delAccessToken()
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

    /**
     * 构建文件请求类型
     * @param $filename
     * @param null $mimetype
     * @param null $postname
     * @return \CURLFile|string
     */
    public function getCurlFile($filename, $mimetype = null, $postname = null)
    {
        if (is_string($filename) && file_exists($filename)) {
            if (is_null($postname)) $postname = basename($filename);
            if (is_null($mimetype)) $mimetype = self::getExtMine(pathinfo($filename, 4));
            if (class_exists('CURLFile')) {
                return new \CURLFile($filename, $mimetype, $postname);
            } else {
                return "@{$filename};filename={$postname};type={$mimetype}";
            }
        } else if (($ext = pathinfo($filename, PATHINFO_EXTENSION)) and in_array($ext, ['jpg','jpeg','video','mp4','mp3','amr','png'])) {
            return new \CURLFile($filename, $mimetype, $postname);
        }
        return $filename;
    }


    /**
     * 获取文件后缀类型
     * @param $ext
     * @param array $mine
     * @return string
     */
    public static function getExtMine($ext, $mine = [])
    {
        $mines = self::getMines();
        foreach (is_string($ext) ? explode(',', $ext) : $ext as $e) {
            $mine[] = isset($mines[strtolower($e)]) ? $mines[strtolower($e)] : 'application/octet-stream';
        }
        return join(',', array_unique($mine));
    }

    /**
     * 获取所有文件扩展的类型
     * @return array
     * @throws LocalCacheException
     */
    private static function getMines()
    {
        $mines = self::getCache('all_ext_mine');
        if (empty($mines)) {
            $content = file_get_contents('http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');
            preg_match_all('#^([^\s]{2,}?)\s+(.+?)$#ism', $content, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) foreach (explode(" ", $match[2]) as $ext) $mines[$ext] = $match[1];
            self::setCache('all_ext_mine', $mines);
        }
        return $mines;
    }
}