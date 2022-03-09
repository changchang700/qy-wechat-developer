<?php
/**
 * 群聊管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 群聊管理
 * Class Appchat
 * @package WorkWeChat
 */
class Appchat extends BasicWorkWeChat
{

    /**
     * 创建群聊会话
     * 
     * @param string $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90245
     * @return array
     */
    public function create(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改群聊会话
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90246
     * @return array
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取群聊会话
     * 
     * @param string $chatID 群聊ID
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90247
     * @return array
     */
    public function get( $chatID):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/get?access_token=ACCESS_TOKEN&chatid={$chatID}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 应用推送消息
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90248
     * @return array
     */
    public function send(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}