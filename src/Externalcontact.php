<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 客户联系
 * 
 * Class Tag
 * @package WeChat
 */
class Externalcontact extends BasicWorkWeChat
{
    
    /**
     * 获取配置了客户联系功能的成员列表
     * 
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92570
     * @return array
     */
    public function get_follow_user_list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_follow_user_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 配置客户联系「联系我」方式
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92572
     * @return array
     */
    public function add_contact_way(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取企业已配置的「联系我」方式
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92572
     * @return array
     */
    public function get_contact_way(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 更新企业已配置的「联系我」方式
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92572
     * @return array
     */
    public function update_contact_way(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/update_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除企业已配置的「联系我」方式
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92572
     * @return array
     */
    public function del_contact_way(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取客户列表
     * 
     * @param string $userid 企业成员的userid
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92113
     * @return array
     */
    public function list(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/list?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取客户详情
     * 
     * @param string $external_userid 外部联系人的userid，注意不是企业成员的帐号
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92114
     * @return array
     */
    public function get(string $external_userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get?access_token=ACCESS_TOKEN&external_userid={$external_userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 批量获取客户详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92994
     * @return array
     */
    public function get_by_user(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/batch/get_by_user?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 修改客户备注信息
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92115
     * @return array
     */
    public function remark(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/remark?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取企业标签库
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92117#%E8%8E%B7%E5%8F%96%E4%BC%81%E4%B8%9A%E6%A0%87%E7%AD%BE%E5%BA%93
     * @return array
     */
    public function get_corp_tag_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_corp_tag_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 添加企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92117#%E6%B7%BB%E5%8A%A0%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function add_corp_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_corp_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 编辑企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92117#%E7%BC%96%E8%BE%91%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function edit_corp_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/edit_corp_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92117#%E5%88%A0%E9%99%A4%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function del_corp_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_corp_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取指定规则组下的企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94882#%E8%8E%B7%E5%8F%96%E6%8C%87%E5%AE%9A%E8%A7%84%E5%88%99%E7%BB%84%E4%B8%8B%E7%9A%84%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function get_strategy_tag_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_strategy_tag_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 为指定规则组创建企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94882#%E4%B8%BA%E6%8C%87%E5%AE%9A%E8%A7%84%E5%88%99%E7%BB%84%E5%88%9B%E5%BB%BA%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function add_strategy_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_strategy_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 编辑指定规则组下的企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94882#%E7%BC%96%E8%BE%91%E6%8C%87%E5%AE%9A%E8%A7%84%E5%88%99%E7%BB%84%E4%B8%8B%E7%9A%84%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function edit_strategy_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/edit_strategy_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除指定规则组下的企业客户标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94882#%E5%88%A0%E9%99%A4%E6%8C%87%E5%AE%9A%E8%A7%84%E5%88%99%E7%BB%84%E4%B8%8B%E7%9A%84%E4%BC%81%E4%B8%9A%E5%AE%A2%E6%88%B7%E6%A0%87%E7%AD%BE
     * @return array
     */
    public function del_strategy_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_strategy_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 编辑客户企业标签
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92118
     * @return array
     */
    public function mark_tag(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/mark_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 分配在职成员的客户
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92125
     * @return array
     */
    public function transfer_customer(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/transfer_customer?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询客户接替状态
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94088
     * @return array
     */
    public function transfer_result(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/transfer_result?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取待分配的离职成员列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92124
     * @return array
     */
    public function get_unassigned_list(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_unassigned_list?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 分配离职成员的客户
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94081
     * @return array
     */
    public function resigned_transfer_customer(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/resigned/transfer_customer?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询客户接替状态
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94082
     * @return array
     */
    public function resigned_transfer_result(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/resigned/transfer_result?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 分配离职成员的客户群
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92127
     * @return array
     */
    public function groupchat_transfer(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/transfer?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);

    }

    /**
     * 获取客户群列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92120
     * @return array
     */
    public function groupchat_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取客户群详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92122
     * @return array
     */
    public function groupchat_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 客户群opengid转换
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94822
     * @return array
     */
    public function opengid_to_chatid(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/opengid_to_chatid?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建发表任务
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95094#%E5%88%9B%E5%BB%BA%E5%8F%91%E8%A1%A8%E4%BB%BB%E5%8A%A1
     * @return array
     */
    public function add_moment_task(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_moment_task?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取任务创建结果
     * 
     * @param string $jobid 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95094#%E8%8E%B7%E5%8F%96%E4%BB%BB%E5%8A%A1%E5%88%9B%E5%BB%BA%E7%BB%93%E6%9E%9C
     * @return array
     */
    public function get_moment_task_result(string $jobid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_task_result?access_token=ACCESS_TOKEN&jobid={$jobid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取企业全部的发表列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93333#%E8%8E%B7%E5%8F%96%E4%BC%81%E4%B8%9A%E5%85%A8%E9%83%A8%E7%9A%84%E5%8F%91%E8%A1%A8%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_moment_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客户朋友圈企业发表的列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93333#%E8%8E%B7%E5%8F%96%E5%AE%A2%E6%88%B7%E6%9C%8B%E5%8F%8B%E5%9C%88%E4%BC%81%E4%B8%9A%E5%8F%91%E8%A1%A8%E7%9A%84%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_moment_task(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_task?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客户朋友圈发表时选择的可见范围
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93333#%E8%8E%B7%E5%8F%96%E5%AE%A2%E6%88%B7%E6%9C%8B%E5%8F%8B%E5%9C%88%E5%8F%91%E8%A1%A8%E6%97%B6%E9%80%89%E6%8B%A9%E7%9A%84%E5%8F%AF%E8%A7%81%E8%8C%83%E5%9B%B4
     * @return array
     */
    public function get_moment_customer_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_customer_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客户朋友圈发表后的可见客户列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93333#%E8%8E%B7%E5%8F%96%E5%AE%A2%E6%88%B7%E6%9C%8B%E5%8F%8B%E5%9C%88%E5%8F%91%E8%A1%A8%E5%90%8E%E7%9A%84%E5%8F%AF%E8%A7%81%E5%AE%A2%E6%88%B7%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_moment_send_result(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_send_result?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客户朋友圈的互动数据
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93333#%E8%8E%B7%E5%8F%96%E5%AE%A2%E6%88%B7%E6%9C%8B%E5%8F%8B%E5%9C%88%E7%9A%84%E4%BA%92%E5%8A%A8%E6%95%B0%E6%8D%AE
     * @return array
     */
    public function get_moment_comments(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_comments?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取规则组列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E8%8E%B7%E5%8F%96%E8%A7%84%E5%88%99%E7%BB%84%E5%88%97%E8%A1%A8
     * @return array
     */
    public function moment_strategy_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_moment_comments?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取规则组详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E8%8E%B7%E5%8F%96%E8%A7%84%E5%88%99%E7%BB%84%E8%AF%A6%E6%83%85
     * @return array
     */
    public function moment_strategy_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/moment_strategy/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取规则组管理范围
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E8%8E%B7%E5%8F%96%E8%A7%84%E5%88%99%E7%BB%84%E7%AE%A1%E7%90%86%E8%8C%83%E5%9B%B4
     * @return array
     */
    public function moment_strategy_get_range(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/moment_strategy/get_range?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建新的规则组
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E5%88%9B%E5%BB%BA%E6%96%B0%E7%9A%84%E8%A7%84%E5%88%99%E7%BB%84
     * @return array
     */
    public function moment_strategy_create(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/moment_strategy/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 编辑规则组及其管理范围
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E7%BC%96%E8%BE%91%E8%A7%84%E5%88%99%E7%BB%84%E5%8F%8A%E5%85%B6%E7%AE%A1%E7%90%86%E8%8C%83%E5%9B%B4
     * @return array
     */
    public function moment_strategy_edit(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/moment_strategy/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除规则组
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94890#%E5%88%A0%E9%99%A4%E8%A7%84%E5%88%99%E7%BB%84
     * @return array
     */
    public function moment_strategy_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/moment_strategy/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建企业群发
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92135
     * @return array
     */
    public function add_msg_template(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_msg_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取群发记录列表
     * 
     * @param array $data
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93338#%E8%8E%B7%E5%8F%96%E7%BE%A4%E5%8F%91%E8%AE%B0%E5%BD%95%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_groupmsg_list(array $data)
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_groupmsg_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取群发成员发送任务列表
     * 
     * @param array $data
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93338#%E8%8E%B7%E5%8F%96%E7%BE%A4%E5%8F%91%E6%88%90%E5%91%98%E5%8F%91%E9%80%81%E4%BB%BB%E5%8A%A1%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_groupmsg_task(array $data)
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_groupmsg_task?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取企业群发消息发送结果
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93338#%E8%8E%B7%E5%8F%96%E4%BC%81%E4%B8%9A%E7%BE%A4%E5%8F%91%E6%88%90%E5%91%98%E6%89%A7%E8%A1%8C%E7%BB%93%E6%9E%9C
     * @return array
     */
    public function get_group_msg_result(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_groupmsg_send_result?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 发送新客户欢迎语
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92137
     * @return array
     */
    public function send_welcome_msg(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/send_welcome_msg?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 添加入群欢迎语素材
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92366#%E6%B7%BB%E5%8A%A0%E5%85%A5%E7%BE%A4%E6%AC%A2%E8%BF%8E%E8%AF%AD%E7%B4%A0%E6%9D%90
     * @return array
     */
    public function group_welcome_template_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 编辑入群欢迎语素材
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92366#%E7%BC%96%E8%BE%91%E5%85%A5%E7%BE%A4%E6%AC%A2%E8%BF%8E%E8%AF%AD%E7%B4%A0%E6%9D%90
     * @return array
     */
    public function group_welcome_template_edit(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取入群欢迎语素材
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92366#%E8%8E%B7%E5%8F%96%E5%85%A5%E7%BE%A4%E6%AC%A2%E8%BF%8E%E8%AF%AD%E7%B4%A0%E6%9D%90
     * @return array
     */
    public function group_welcome_template_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除群欢迎语素材
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92366#%E5%88%A0%E9%99%A4%E5%85%A5%E7%BE%A4%E6%AC%A2%E8%BF%8E%E8%AF%AD%E7%B4%A0%E6%9D%90
     * @return array
     */
    public function group_welcome_template_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取「联系客户统计」数据
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92132
     * @return array
     */
    public function get_user_behavior_data(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_user_behavior_data?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取「群聊数据统计」数据(按群主聚合的方式)
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92133#%E6%8C%89%E7%BE%A4%E4%B8%BB%E8%81%9A%E5%90%88%E7%9A%84%E6%96%B9%E5%BC%8F
     * @return array
     */
    public function groupchat_statistic(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/statistic?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取「群聊数据统计」数据(按自然日聚合的方式)
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/92133#%E6%8C%89%E8%87%AA%E7%84%B6%E6%97%A5%E8%81%9A%E5%90%88%E7%9A%84%E6%96%B9%E5%BC%8F
     * @return array
     */
    public function groupchat_by_day(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/statistic_group_by_day?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建商品图册
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95096#%E5%88%9B%E5%BB%BA%E5%95%86%E5%93%81%E5%9B%BE%E5%86%8C
     * @return array
     */
    public function add_product_album(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_product_album?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取商品图册
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95096#%E8%8E%B7%E5%8F%96%E5%95%86%E5%93%81%E5%9B%BE%E5%86%8C
     * @return array
     */
    public function get_product_album(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_product_album?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取商品图册列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95096#%E8%8E%B7%E5%8F%96%E5%95%86%E5%93%81%E5%9B%BE%E5%86%8C%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_product_album_list(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_product_album_list?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 编辑商品图册
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95096#%E7%BC%96%E8%BE%91%E5%95%86%E5%93%81%E5%9B%BE%E5%86%8C
     * @return array
     */
    public function update_product_album(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/update_product_album?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除商品图册
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95096#%E5%88%A0%E9%99%A4%E5%95%86%E5%93%81%E5%9B%BE%E5%86%8C
     * @return array
     */
    public function delete_product_album(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/delete_product_album?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 新建敏感词规则
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95097#%E6%96%B0%E5%BB%BA%E6%95%8F%E6%84%9F%E8%AF%8D%E8%A7%84%E5%88%99
     * @return array
     */
    public function add_intercept_rule(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_intercept_rule?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取敏感词规则列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95097#%E8%8E%B7%E5%8F%96%E6%95%8F%E6%84%9F%E8%AF%8D%E8%A7%84%E5%88%99%E5%88%97%E8%A1%A8
     * @return array
     */
    public function get_intercept_rule_list(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_intercept_rule_list?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取敏感词规则详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95097#%E8%8E%B7%E5%8F%96%E6%95%8F%E6%84%9F%E8%AF%8D%E8%A7%84%E5%88%99%E8%AF%A6%E6%83%85
     * @return array
     */
    public function get_intercept_rule(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_intercept_rule?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改敏感词规则
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95097#%E4%BF%AE%E6%94%B9%E6%95%8F%E6%84%9F%E8%AF%8D%E8%A7%84%E5%88%99
     * @return array
     */
    public function update_intercept_rule(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/update_intercept_rule?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除敏感词规则
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95097#%E5%88%A0%E9%99%A4%E6%95%8F%E6%84%9F%E8%AF%8D%E8%A7%84%E5%88%99
     * @return array
     */
    public function del_intercept_rule(array $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_intercept_rule?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 上传附件资源
     *
     * @param string $filename 上传文件路径
     * @param string $media_type 媒体文件类型，分别有图片（image）、视频（video）、普通文件（file）
     * @param array $attachment_type 附件类型，不同的附件类型用于不同的场景。1：朋友圈；2:商品图册
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95098
     * @return array
     */
    public function upload(string $filename, string $media_type = 'image', array $attachment_type):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/media/upload_attachment?access_token=ACCESS_TOKEN&media_type={$media_type}&attachment_type={$attachment_type}";
        $this->registerApi($url, __FUNCTION__, func_get_args());

        return $this->httpPostForJson($url, ['media' => Tools::createCurlFile($filename)], false);
    }
}

