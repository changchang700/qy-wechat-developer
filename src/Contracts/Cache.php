<?php
namespace WorkWeChat\Contracts;

/**
 * 文件缓存
 */
class Cache{
    
    public static $instance;


    protected $options = [
        'expire'        => 0,
        'cache_subdir'  => true,
        'prefix'        => '',
        'path'          => '',
        'hash_type'     => 'md5',
        'data_compress' => false,
        'serialize'     => true,
    ];

    protected $expire;

    /**
     * 序列化方法
     * @var array
     */
    protected static $serialize = ['serialize', 'unserialize', 'think_serialize:', 16];
    
    /**
     * 架构函数
     * @param array $options
     */
    public function __construct($options = [])
    {
        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }

        if (empty($this->options['path'])) {
            $this->options['path'] = '..'.DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
        } elseif (substr($this->options['path'], -1) != DIRECTORY_SEPARATOR) {
            $this->options['path'] .= DIRECTORY_SEPARATOR;
        }
        
        $this->init();
    }

    /**
     * 初始化检查
     * @access private
     * @return boolean
     */
    private function init()
    {
        // 创建项目缓存目录
        try {
            if (!is_dir($this->options['path']) && mkdir($this->options['path'], 0755, true)) {
                return true;
            }
        } catch (\Exception $e) {
        }

        return false;
    }
    
    public static function instance($options=[]){
        if(self::$instance && self::$instance instanceof self){
            return self::$instance;
        }else{
            return self::$instance =new self($options);
        }
    }

    /**
     * 取得变量的存储文件名
     * @access protected
     * @param  string $name 缓存变量名
     * @param  bool   $auto 是否自动创建目录
     * @return string
     */
    protected function getCacheKey($name, $auto = false)
    {
        $name = hash($this->options['hash_type'], $name);

        if ($this->options['cache_subdir']) {
            // 使用子目录
            $name = substr($name, 0, 2) . DIRECTORY_SEPARATOR . substr($name, 2);
        }

        if ($this->options['prefix']) {
            $name = $this->options['prefix'] . DIRECTORY_SEPARATOR . $name;
        }

        $filename = $this->options['path'] . $name . '.php';
        $dir      = dirname($filename);

        if ($auto && !is_dir($dir)) {
            try {
                mkdir($dir, 0755, true);
            } catch (\Exception $e) {
            }
        }

        return $filename;
    }

    /**
     * 判断缓存是否存在
     * @access public
     * @param  string $name 缓存变量名
     * @return bool
     */
    public function has($name)
    {
        return false !== $this->get($name) ? true : false;
    }

    /**
     * 读取缓存
     * @access public
     * @param  string $name 缓存变量名
     * @param  mixed  $default 默认值
     * @return mixed
     */
    public function get($name, $default = false)
    {
        $filename = $this->getCacheKey($name);

        if (!is_file($filename)) {
            return $default;
        }

        $content      = file_get_contents($filename);
        $this->expire = null;

        if (false !== $content) {
            $expire = (int) substr($content, 8, 12);
            if (0 != $expire && time() > filemtime($filename) + $expire) {
                //缓存过期删除缓存文件
                $this->unlink($filename);
                return $default;
            }

            $this->expire = $expire;
            $content      = substr($content, 32);

            if ($this->options['data_compress'] && function_exists('gzcompress')) {
                //启用数据压缩
                $content = gzuncompress($content);
            }
            return $this->unserialize($content);
        } else {
            return $default;
        }
    }

    /**
     * 写入缓存
     * @access public
     * @param  string        $name 缓存变量名
     * @param  mixed         $value  存储数据
     * @param  int|\DateTime $expire  有效时间 0为永久
     * @return boolean
     */
    public function set($name, $value, $expire = null)
    {
        if (is_null($expire)) {
            $expire = $this->options['expire'];
        }

        $expire   = $this->getExpireTime($expire);
        $filename = $this->getCacheKey($name, true);

        $data = $this->serialize($value);

        if ($this->options['data_compress'] && function_exists('gzcompress')) {
            //数据压缩
            $data = gzcompress($data, 3);
        }

        $data   = "<?php\n//" . sprintf('%012d', $expire) . "\n exit();?>\n" . $data;
        $result = file_put_contents($filename, $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 自增缓存（针对数值缓存）
     * @access public
     * @param  string    $name 缓存变量名
     * @param  int       $step 步长
     * @return false|int
     */
    public function inc($name, $step = 1)
    {
        if ($this->has($name)) {
            $value  = $this->get($name) + $step;
            $expire = $this->expire;
        } else {
            $value  = $step;
            $expire = 0;
        }

        return $this->set($name, $value, $expire) ? $value : false;
    }

    /**
     * 自减缓存（针对数值缓存）
     * @access public
     * @param  string    $name 缓存变量名
     * @param  int       $step 步长
     * @return false|int
     */
    public function dec($name, $step = 1)
    {
        if ($this->has($name)) {
            $value  = $this->get($name) - $step;
            $expire = $this->expire;
        } else {
            $value  = -$step;
            $expire = 0;
        }

        return $this->set($name, $value, $expire) ? $value : false;
    }

    /**
     * 删除缓存
     * @access public
     * @param  string $name 缓存变量名
     * @return boolean
     */
    public function rm($name)
    {
        try {
            return $this->unlink($this->getCacheKey($name));
        } catch (\Exception $e) {
        }
    }
    
    
    /**
     * 获取有效期
     * @access protected
     * @param  integer|\DateTime $expire 有效期
     * @return integer
     */
    protected function getExpireTime($expire)
    {
        if ($expire instanceof \DateTime) {
            $expire = $expire->getTimestamp() - time();
        }

        return $expire;
    }

     /**
     * 序列化数据
     * @access protected
     * @param  mixed $data
     * @return string
     */
    protected function serialize($data)
    {
        if (is_scalar($data) || !$this->options['serialize']) {
            return $data;
        }

        $serialize = self::$serialize[0];

        return self::$serialize[2] . $serialize($data);
    }

    /**
     * 反序列化数据
     * @access protected
     * @param  string $data
     * @return mixed
     */
    protected function unserialize($data)
    {
        if ($this->options['serialize'] && 0 === strpos($data, self::$serialize[2])) {
            $unserialize = self::$serialize[1];

            return $unserialize(substr($data, self::$serialize[3]));
        } else {
            return $data;
        }
    }
    
    /**
     * 判断文件是否存在后，删除
     * @access private
     * @param  string $path
     * @return bool
     * @author byron sampson <xiaobo.sun@qq.com>
     * @return boolean
     */
    private function unlink($path)
    {
        return is_file($path) && unlink($path);
    }
}
