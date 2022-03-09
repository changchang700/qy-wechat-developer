<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 标签管理
 * 
 * Class Tag
 * @package WeChat
 */
class Tag extends BasicWorkWeChat
{

    /**
     * 创建标签
     * 
     * @param array $data 标签信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90210
     * @return array
     */
    public function create(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新标签名字
     * 
     * @param array $data 标签信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90211
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除标签
     * 
     * @param string $tagid 标签ID
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90212
     * @return array
     */
    public function delete(string $tagid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/delete?access_token=ACCESS_TOKEN&tagid={$tagid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取标签成员
     * 
     * @param string $tagid 标签ID
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90213
     * @return array
     */
    public function get(string $tagid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/get?access_token=ACCESS_TOKEN&tagid={$tagid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 增加标签成员
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90214
     * @return array
     */
    public function addtagusers(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/addtagusers?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除标签成员
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90215
     * @return array
     */
    public function deltagusers(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/deltagusers?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取标签列表
     * 
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90216
     * @return array
     */
    public function list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}