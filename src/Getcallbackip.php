<?php
/**
 * 获取企业微信服务器的IP段
 */

namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 获取企业微信服务器的IP段
 * Class Getcallbackip
 * @package WorkWeChat
 */
class Getcallbackip extends BasicWorkWeChat
{
    /**
     * 获取企业微信服务器的ip段
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getcallbackip()
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/getcallbackip?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}