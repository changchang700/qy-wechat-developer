<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/22
 * Time: 16:58
 */

namespace WorkWeChat;

/**
 * 签名类
 * Class Signature
 * @package WorkWeChat
 */
class Signature
{
    protected $origin;
    protected $is_sign;

    /**
     * 过滤数据
     * @param array $data
     * @return array
     */
    private static function getCleanData(array &$data)
    {
        self::$origin = $data;

        if (isset($data['sign'])) {
            self::$is_sign = true;
            unset($data['sign']);
        }

        return array_filter($data);
    }

    /**
     * 生成签名|校验签名
     * @param array $data
     * @param $secret
     * @return bool|string
     */
    public static function getSignature(array $data, $secret)
    {
        self::getCleanData($data);

        sort($data, SORT_STRING);
        
        $data = $data + compact('secret');

        $signString = strtoupper(md5(http_build_query($data)));
        
        if (self::$is_sign and str_equal($signString, self::$origin['sign'])) return true;

        return $signString;
    }
}