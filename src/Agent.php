<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 互联企业
 * 
 * Class Tag
 * @package WeChat
 */
class Agent extends BasicWorkWeChat
{

    /**
     * 获取应用的可见范围
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93172
     * @return array
     */
    public function get_perm_list(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/agent/get_perm_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取互联企业成员详细信息
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93171
     * @return array
     */
    public function get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门成员
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93168
     * @return array
     */
    public function simplelist(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/simplelist?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门成员详情
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93169
     * @return array
     */
    public function user_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门列表
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93170
     * @return array
     */
    public function department_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/department/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取指定的应用详情
     * 
     * @param $agentid 应用id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90227
     * @return array
     */
    public function agent_get(array $agentid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/get?access_token=ACCESS_TOKEN&agentid={$agentid}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取access_token对应的应用列表
     * 
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90227
     * @return array
     */
    public function agent_list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 设置应用
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90228
     * @return array
     */
    public function set(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 设置应用在工作台展示的模版
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92535
     * @return array
     */
    public function set_workbench_template(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set_workbench_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取应用在工作台展示的模版
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92535
     * @return array
     */
    public function get_workbench_template(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/get_workbench_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 设置应用在用户工作台展示的数据
     * 
     * @param $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92535
     * @return array
     */
    public function set_workbench_data(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set_workbench_data?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取应用共享信息
     *
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93403
     * @return array
     */
    public function list_app_share_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/list_app_share_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取下级/下游企业的access_token
     *
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93359
     * @return array
     */
    public function gettoken(array $data):array 
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/gettoken?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取下级/下游企业的access_token
     *
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93355
     * @return array
     */
    public function transfer_session(array $data):array 
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/miniprogram/transfer_session?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建菜单
     *
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90231
     * @return array
     */
    public function menu_create(array $data):array 
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN&agentid=AGENTID";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取菜单
     *
     * @param array $agentid 应用id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90232
     * @return array
     */
    public function menu_get(array $agentid):array 
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN&agentid={$agentid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 删除菜单
     *
     * @param array $agentid 应用id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90233
     * @return array
     */
    public function menu_delete(array $agentid):array 
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN&agentid={$agentid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}