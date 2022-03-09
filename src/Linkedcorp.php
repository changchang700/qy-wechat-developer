<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 互联企业消息推送管理
 * 
 * Class Linkedcorp
 * @package WorkWeChat
 */
class Linkedcorp extends BasicWorkWeChat
{

    /**
     * 发送应用消息
     * @param array $data
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90250
     * @return array
     */
    public function message_send(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/message/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

}