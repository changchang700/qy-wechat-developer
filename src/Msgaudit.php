<?php
/**
 * 会话内容存档管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 会话内容存档管理
 * Class Msgaudit
 * @package WorkWeChat
 */
class Msgaudit extends BasicWorkWeChat
{

    /**
     * 获取会话内容存档开启成员列表
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        type	        否	    拉取对应版本的开启成员列表。1表示办公版；2表示服务版；3表示企业版。非必填，不填写的时候返回全量成员列表。
     *
     * @example IDE跟踪查看案例
     *
        {
            "type":1
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_permit_user_list(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/msgaudit/get_permit_user_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取会话同意情况
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	                必须	    说明
        access_token	    是	    调用接口凭证
        info	            是	    待查询的会话信息，数组
        userid	            是	    内部成员的userid
        exteranalopenid	    是	    外部成员的externalopenid
     *
     * @example IDE跟踪查看案例
     *
        {
            "info":[
                {"userid":"XuJinSheng","exteranalopenid":"wmeDKaCQAAGd9oGiQWxVsAKwV2HxNAAA"},
                {"userid":"XuJinSheng","exteranalopenid":"wmeDKaCQAAIQ_p7ACn_jpLVBJSGocAAA"},
                {"userid":"XuJinSheng","exteranalopenid":"wmeDKaCQAAPE_p7ABnxkpLBBJSGocAAA"}
            ]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function check_single_agree(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/msgaudit/check_single_agree?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取会话内容存档内部群信息
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数          	必须	    说明
        access_token	是	    调用接口凭证
        roomid	        是	    待查询的群id
     *
     * @example IDE跟踪查看案例
     *
        {
            "roomid":"wrNplhCgAAIVZohLe57zKnvIV7xBKrig"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function groupchat_get(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/msgaudit/groupchat/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }




}
