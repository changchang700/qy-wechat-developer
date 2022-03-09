<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 客服管理
 * 
 * Class Kf
 * @package WeChat
 */
class Kf extends BasicWorkWeChat
{

    /**
     * 添加客服帐号
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94662
     * @return array
     */
    public function account_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/account/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除客服帐号
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94663
     * @return array
     */
    public function account_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/account/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改客服帐号
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94664
     * @return array
     */
    public function account_update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/account/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客服帐号列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94661
     * @return array
     */
    public function account_list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/account/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取客服帐号链接
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94665
     * @return array
     */
    public function add_contact_way(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/add_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 添加接待人员
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94646
     * @return array
     */
    public function servicer_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/servicer/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除接待人员
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94647
     * @return array
     */
    public function servicer_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/servicer/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取接待人员列表
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94645
     */
    public function servicer_list(string $open_kfid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/servicer/list?access_token=ACCESS_TOKEN&open_kfid={$open_kfid}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取会话状态
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94669#%E8%8E%B7%E5%8F%96%E4%BC%9A%E8%AF%9D%E7%8A%B6%E6%80%81
     * @return array
     */
    public function service_state_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/service_state/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 变更会话状态
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94669#%E5%8F%98%E6%9B%B4%E4%BC%9A%E8%AF%9D%E7%8A%B6%E6%80%81
     * @return array
     */
    public function service_state_trans(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/service_state/trans?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 读取消息
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94670#%E8%AF%BB%E5%8F%96%E6%B6%88%E6%81%AF
     * @return array
     */
    public function sync_msg(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/sync_msg?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 发送消息
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94677
     * @return array
     */
    public function send_msg(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/send_msg?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取配置的专员与客户群
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94674#%E8%8E%B7%E5%8F%96%E9%85%8D%E7%BD%AE%E7%9A%84%E4%B8%93%E5%91%98%E4%B8%8E%E5%AE%A2%E6%88%B7%E7%BE%A4
     * @return array
     */
    public function get_upgrade_service_config(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/customer/get_upgrade_service_config?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 为客户升级为专员或客户群服务
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94674#%E4%B8%BA%E5%AE%A2%E6%88%B7%E5%8D%87%E7%BA%A7%E4%B8%BA%E4%B8%93%E5%91%98%E6%88%96%E5%AE%A2%E6%88%B7%E7%BE%A4%E6%9C%8D%E5%8A%A1
     * @return array
     */
    public function upgrade_service(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/customer/upgrade_service?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 为客户取消推荐
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94674#%E4%B8%BA%E5%AE%A2%E6%88%B7%E5%8F%96%E6%B6%88%E6%8E%A8%E8%8D%90
     * @return array
     */
    public function cancel_upgrade_service(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/customer/cancel_upgrade_service?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取客户基础信息
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/95159
     * @return array
     */
    public function batchget(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/kf/customer/batchget?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}