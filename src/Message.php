<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 消息推送管理
 * 
 * Class Message
 * @package WorkWeChat
 */
class Message extends BasicWorkWeChat
{
    /**
     * 发送应用消息
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90236
     * @return array
     */
    public function send(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新任务卡片消息状态
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94888
     * @return array
     */
    public function update_taskcard(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/update_taskcard?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询应用消息发送统计
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94867
     * @return array
     */
    public function get_statistics(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/get_statistics?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

}