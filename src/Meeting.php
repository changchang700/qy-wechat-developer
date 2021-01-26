<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/26
 * Time: 10:52
 */

namespace WorkWeChat;


use WorkWeChat\Contracts\BasicWorkWeChat;

class Meeting extends BasicWorkWeChat
{
    public function api(array $data, string $type)
    {
        if (!in_array($type , ['create', 'update', 'cancel', 'detail'])) throw new \Exception('不存在的接口类型');

        switch ($type) {
            case 'create' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/meeting/create?access_token=ACCESS_TOKEN';
            }
            case 'update' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/meeting/update?access_token=ACCESS_TOKEN';
            }
            case 'cancel' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/meeting/cancel?access_token=ACCESS_TOKEN';
            }
            case 'detail' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/meeting/get_info?access_token=ACCESS_TOKEN';
            }
        }
        
        return $this->callPostApi($url, $data);
    }

}