<?php
/**
 * 部门管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 部门管理
 * Class Department
 * @package WeChat
 */
class Department extends BasicWorkWeChat
{

    /**
     * 创建部门
     * @param array $data 部门信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        name            是      部门名称。同一个层级的部门名称不能重复。长度限制为1~32个字符，字符不能包括\:?”<>｜
        name_en         否      英文名称。同一个层级的部门名称不能重复。需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜
        parentid        是      父部门id，32位整型
        order           否      在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
        id              否      部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "name": "广州研发中心",
            "name_en": "RDGZ",
            "parentid": 1,
            "order": 1,
            "id": 2
        }
     * 
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
     * @param array $data 部门信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        id              是      部门id
        name            否      部门名称。长度限制为1~32个字符，字符不能包括\:?”<>｜
        name_en         否      英文名称，需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜
        parentid        否      父部门id
        order           否      在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "id": 2,
            "name": "广州研发中心",
            "name_en": "RDGZ",
            "parentid": 1,
            "order": 1
        }
     * 
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
     * @return array
     */
    public function list(int $id):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=ACCESS_TOKEN&id={$id}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
}