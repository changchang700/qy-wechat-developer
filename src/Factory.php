<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/2/19
 * Time: 18:13
 */

namespace WorkWeChat;

/**
 * Class Factory
 * @package WorkWeChat
 */
class Factory
{
    /**
     * @param $name
     * @param array $config
     * @return \WorkWeChat\Contracts\BasicWorkWeChat $application
     */
    public static function make($name, array $config)
    {
        $namespace = self::getApp($name);
        $application = "\\WorkWeChat\\{$namespace}";
        
        return new $application($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }

    /**
     * @param string $value
     * @return mixed
     */
    private static function getApp(string $value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        
        return str_replace(' ', '', $value);
    }
}