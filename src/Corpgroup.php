<?php
/**
 * 企业互联管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 企业互联管理
 * Class Corpgroup
 * @package WorkWeChat
 */
class Corpgroup extends BasicWorkWeChat
{

    /**
     * 获取应用共享信息
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	必须	说明
        access_token	是	调用接口凭证，上级企业应用access_token
        agentid	是	上级企业应用agentid
     *
     * @example IDE跟踪查看案例
     *
        {
            "agentid":1111
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function corp_list_app_share_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/list_app_share_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取下级企业的access_token
     * @param string $data
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证，上级企业应用access_token
        corpid	        是	    已授权的下级企业corpid
        agentid	        是	    已授权的下级企业应用ID
     *
     * @example IDE跟踪查看案例
     *
        {
            "corpid": "wwabc",
            "agentid": 1111
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function corp_gettoken(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/gettoken?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}
