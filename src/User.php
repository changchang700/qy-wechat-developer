<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 成员管理
 * 
 * Class User
 * @package WeChat
 */
class User extends BasicWorkWeChat
{

    /**
     * 创建成员
     * 
     * @param array $data 成员信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90195
     * @return array
     */
    public function create(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 读取成员
     * 
     * @param string $userid 成员UserID
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90196
     * @return array
     */
    public function get(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 更新成员
     * 
     * @param type $data 成员信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90197
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除成员
     * 
     * @param string $userid 成员UserID。对应管理端的帐号
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90198
     * @return array
     */
    public function delete(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 批量删除成员
     * 
     * @param array $data 成员UserID列表。对应管理端的帐号。最多支持200个。若存在无效UserID，直接返回错误
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90199
     * @return array
     */
    public function batchdelete(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/batchdelete?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取部门成员
     * 
     * @param int $department_id 获取的部门id
     * @param bool $fetch_child 是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90200
     * @return array
     */
    public function simplelist(int $department_id,bool $fetch_child=false):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token=ACCESS_TOKEN&department_id={$department_id}&fetch_child={$fetch_child}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取部门成员详情
     * 
     * @param int $department_id 获取的部门id
     * @param bool $fetch_child 1/0：是否递归获取子部门下面的成员
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90201
     * @return array
     */
    public function list(int $department_id,bool $fetch_child=false):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=ACCESS_TOKEN&department_id={$department_id}&fetch_child={$fetch_child}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * userid与openid互换
     * 
     * @param array $data 企业内的成员id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90202
     * @return array
     */
    public function convert_to_openid(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_openid?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 二次验证
     * 
     * @param string $userid 成员UserID。对应管理端的帐号
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90203
     * @return array
     */
    public function authsucc(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/authsucc?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 邀请成员
     * 
     * @param array $data 参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90975
     * @return array
     */
    public function invite(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/invite?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取加入企业二维码
     * 
     * @param string $size_type qrcode尺寸类型，1: 171 x 171; 2: 399 x 399; 3: 741 x 741; 4: 2052 x 2052
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91714
     * @return array
     */
    public function get_join_qrcode(string $size_type):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/get_join_qrcode?access_token=ACCESS_TOKEN&size_type={$size_type}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取企业活跃成员数
     * 
     * @param array $data
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92714
     * @return array
     */
    public function get_active_stat(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/get_active_stat?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取访问用户身份（网页授权登录）
     * 
     * @param string $code 通过成员授权获取到的code，最大为512字节。每次成员授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91023
     * @return array
     */
    public function getuserinfo_by_web(string $code):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN&code={$code}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取访问用户身份（扫码授权登录）
     * 
     * @param string $code 通过成员授权获取到的code，最大为512字节。每次成员授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91019
     * @return array
     */
    public function getuserinfo_by_qr($code):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN&code={$code}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
}