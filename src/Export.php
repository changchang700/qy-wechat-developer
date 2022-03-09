<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 导出管理
 * 
 * Class Export
 * @package WeChat
 */
class Export extends BasicWorkWeChat
{

    /**
     * 导出成员
     * 
     * @param array $data 导出参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94849
     * @return array
     */
    public function simple_user(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/export/simple_user?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 导出成员详情
     * 
     * @param array $data 导出参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90204
     * @return array
     */
    public function user(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/export/user?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 导出部门
     * 
     * @param array $data 导出参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94852
     * @return array
     */
    public function department(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/export/department?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 导出标签成员
     * 
     * @param array $data 导出参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94853
     * @return array
     */
    public function taguser(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/export/taguser?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取导出结果
     * 
     * @param string $jobid 导出参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94854
     * @return array
     */
    public function get_result(array $jobid): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/export/get_result?access_token=ACCESS_TOKEN&jobid=jobid_xxxxxxxxxxxxxxx";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}