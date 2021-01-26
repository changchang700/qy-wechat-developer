<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/25
 * Time: 9:50
 */

namespace WorkWeChat;


use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 企业微信授权
 * Class Oauth
 * @package WorkWeChat
 */
class Oauth extends BasicWorkWeChat
{
    /**
     * web授权页面
     * @param string $url
     */
    public function redirect(string $redirect)
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config['corpid'].'&redirect_uri='.urlencode($redirect).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }

    /**
     * 扫码授权登录
     * @param string $redirect
     */
    public function scanRedirect(string $redirect)
    {
        $url = 'https://open.work.weixin.qq.com/wwopen/sso/qrConnect?appid='.$this->config['corpid'].'&agentid='.$this->config['agentid'].'&redirect_uri='.urlencode($redirect).'&state=STATE';
        header('Location:'.$url);
    }

    /**
     * 获取访问用户身份
     * @param string $code 通过成员授权获取到的code，最大为512字节。每次成员授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
     * @return array
     * @throws Exceptions\InvalidResponseException
     * 企业成员用户返回{
        "errcode": 0,
        "errmsg": "ok",
        "UserId":"USERID"
        }
     * 非企业用户返回{
        "errcode": 0,
        "errmsg": "ok",
        "OpenId":"OPENID"
        }
     */
    public function getUserInfo(string $code)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN&code=CODE';
        $url = str_replace(['ACCESS_TOKEN','CODE'], [$this->getAccessToken(), $code], $url);

        return $this->callGetApi($url);
    }
}