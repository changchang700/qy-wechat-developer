<?php
/**
 * 互联企业
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 互联企业
 * Class Tag
 * @package WeChat
 */
class Agent extends BasicWorkWeChat
{

    /**
     * 获取应用的可见范围
     * 
     * 本接口只返回互联企业中非本企业内的成员和部门的信息，如果要获取本企业的可见范围，请调用“获取应用”接口
     * 
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数	说明
        errcode	返回码
        errmsg	对返回码的文本描述内容
        userids	可见的userids，是用 CorpId + ’/‘ + USERID 拼成的字符串
        department_ids	可见的department_ids，是用 linkedid + ’/‘ + department_id 拼成的字符串
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
    public function create(string $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/agent/get_perm_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取互联企业成员详细信息
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        userid          是      该字段用的是互联应用可见范围接口返回的userids参数，用的是 CorpId + ’/‘ + USERID 拼成的字符串
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "userid": "CORPID/USERID"
        }
     * 
     */
    public function get(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取互联企业部门成员
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
        fetch_child     否      是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门，不传默认只获取本部门成员
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID",
            "fetch_child": true
        }
     * 
     */
    public function simplelist(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/simplelist?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取互联企业部门成员详情
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
        fetch_child     否      是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门，不传默认只获取本部门成员
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID",
            "fetch_child": true
        }
     * 
     */
    public function list(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取互联企业部门列表
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID"
        }
     * 
     */
    public function department_list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
}