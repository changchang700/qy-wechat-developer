<?php
/**
 * 菜单管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 菜单管理
 * Class Menu
 * @package WorkWeChat
 */
class Menu extends BasicWorkWeChat
{
    /**
     * 创建菜单
     * @param string $data 参数信息
     * @param string $agentId 应用ID
     * @uses IDE跟踪查看详细参数
     *
         参数	                    必须	                说明
         access_token	            是	                调用接口凭证
         agentid	                是	                企业应用的id，整型。可在应用的设置页面查看
         button	                    是	                一级菜单数组，个数应为1~3个
         sub_button	                否	                二级菜单数组，个数应为1~5个
         type        	            是	                菜单的响应动作类型
         name        	            是	                菜单的名字。不能为空，主菜单不能超过16字节，子菜单不能超过40字节。
         key 	              click等点击类型必须	        菜单KEY值，用于消息接口推送，不超过128字节
         url     	            view类型必须	            网页链接，成员点击菜单可打开链接，不超过1024字节。为了提高安全性，建议使用https的url
         pagepath	        view_miniprogram类型必须      小程序的页面路径
         appid	            view_miniprogram类型必须	    小程序的appid（仅与企业绑定的小程序可配置）
     *
     * @example IDE跟踪查看案例
     *构造click和view类型的请求包如下
         {
            "button":[
                {
                    "type":"click",
                    "name":"今日歌曲",
                    "key":"V1001_TODAY_MUSIC"
                },
                {
                    "name":"菜单",
                    "sub_button":[
                        {
                            "type":"view",
                            "name":"搜索",
                            "url":"http://www.soso.com/"
                        },
                        {
                            "type":"click",
                            "name":"赞一下我们",
                            "key":"V1001_GOOD"
                        }
                    ]
                }
            ]
         }
     *
     *
     *其他新增按钮类型的请求
        {
            "button": [
                {
                    "name": "扫码",
                    "sub_button": [
                        {
                            "type": "scancode_waitmsg",
                            "name": "扫码带提示",
                            "key": "rselfmenu_0_0",
                            "sub_button": [ ]
                        },
                        {
                            "type": "scancode_push",
                            "name": "扫码推事件",
                            "key": "rselfmenu_0_1",
                            "sub_button": [ ]
                        },
                        {
                            "type":"view_miniprogram",
                            "name":"小程序",
                            "pagepath":"pages/lunar/index",
                            "appid":"wx4389ji4kAAA"
                        }
                    ]
                },
                {
                    "name": "发图",
                    "sub_button": [
                        {
                            "type": "pic_sysphoto",
                            "name": "系统拍照发图",
                            "key": "rselfmenu_1_0",
                            "sub_button": [ ]
                        },
                        {
                            "type": "pic_photo_or_album",
                            "name": "拍照或者相册发图",
                            "key": "rselfmenu_1_1",
                            "sub_button": [ ]
                        },
                        {
                            "type": "pic_weixin",
                            "name": "微信相册发图",
                            "key": "rselfmenu_1_2",
                            "sub_button": [ ]
                        }
                    ]
                },
                {
                "name": "发送位置",
                "type": "location_select",
                "key": "rselfmenu_2_0"
                }
            ]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function create_menu(string $data,string $agentId):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN&agentid={$agentId}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取菜单
     * @param string $agentId 应用ID
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_menu(string $agentId):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN&agentid={$agentId}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * @param string $agentId 应用ID
     * @return array
     */
    public function delete(string $agentId):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN&agentid={$agentId}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }






}