<?php
/**
 * 获取下级企业的小程序session
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 获取下级企业的小程序session
 * Class Miniprogram
 * @package WorkWeChat
 */
class Miniprogram extends BasicWorkWeChat
{

    /**
     * 获取下级企业的小程序session
     * @param string $data
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    类型	        说明
        access_token	是	    string	    调用接口凭证。下级企业的 access_token
        userid	        是	    string	    通过code2Session接口获取到的加密的userid,不多于64字节
        session_key	    是	    string	    通过code2Session接口获取到的属于上级企业的会话密钥-,不多于64字节
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "wmAoNVCwAAUrSqEqz7oQpEIEMVWDrPeg",
            "session_key": "n8cnNEoyW1pxSRz6/Lwjwg=="
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function transfer_session(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/miniprogram/transfer_session?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
}