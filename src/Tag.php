<?php
/**
 * 标签管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 标签管理
 * Class Tag
 * @package WeChat
 */
class Tag extends BasicWorkWeChat
{

    /**
     * 创建标签
     * @param array $data 标签信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证
        tagname             是      标签名称，长度限制为32个字以内（汉字或英文字母），标签名不可与其他标签重名。
        tagid               否      标签id，非负整型，指定此参数时新增的标签会生成对应的标签id，不指定时则以目前最大的id自增。
     *
     * @example IDE跟踪查看案例
     * 
        {
            "tagname": "UI",
            "tagid": 12
        }
     * 
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
     * @param array $data 标签信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证
        tagid               是      标签ID
        tagname             是      标签名称，长度限制为32个字（汉字或英文字母），标签不可与其他标签重名。
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "tagid": 12,
            "tagname": "UI design"
        }
     * 
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
     * @param string $tagid 标签ID
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
     * @param array $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证
        tagid               是      标签ID
        userlist            否      企业成员ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过1000
        partylist           否      企业部门ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过100
     * 
     * @example IDE跟踪查看案例
     * 
        {
           "tagid": 12,
           "userlist":[ "user1","user2"],
           "partylist": [4]
        }
     * 
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
     * @param array $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        tagid           是      标签ID
        userlist        否      企业成员ID列表，注意：userlist、partylist不能同时为空，单次请求长度不超过1000
        partylist       否      企业部门ID列表，注意：userlist、partylist不能同时为空，单次请求长度不超过100
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "tagid": 12,
            "userlist":[ "user1","user2"],
            "partylist":[2,4]
        }
     * 
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
     * @return array
     */
    public function list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/tag/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}