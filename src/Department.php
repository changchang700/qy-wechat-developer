<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 部门管理
 * 
 * Class Department
 * @package WeChat
 */
class Department extends BasicWorkWeChat
{

    /**
     * 创建部门
     * 
     * @param array $data 部门信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90204
     * @return array
     */
    public function create(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新部门
     * 
     * @param array $data 部门信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90206
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/department/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除部门
     * 
     * @param int $id 部门id。（注：不能删除根部门；不能删除含有子部门、成员的部门）
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90207
     * @return array
     */
    public function delete(int $id):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/department/delete?access_token=ACCESS_TOKEN&id={$id}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取部门列表
     * 
     * @param int $id 部门id。获取指定部门及其下的子部门（以及及子部门的子部门等等，递归）。 如果不填，默认获取全量组织架构
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90208
     * @return array
     */
    public function list(int $id=-1001):array
    {
        if ($id === -1001){
            $url = "https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=ACCESS_TOKEN";
        }else{
            $url = "https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=ACCESS_TOKEN&id={$id}";
        }
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
}