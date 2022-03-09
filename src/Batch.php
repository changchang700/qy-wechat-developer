<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 异步批量接口
 * 
 * Class Tag
 * @package WeChat
 */
class Batch extends BasicWorkWeChat
{

    /**
     * 增量更新成员
     * 
     * @param array $data 增量更新成员
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90980
     * @return array
     */
    public function syncuser(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/syncuser?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 全量覆盖成员
     * 
     * @param array $data 全量覆盖成员
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90981
     * @return array
     */
    public function replaceuser(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/replaceuser?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 全量覆盖部门
     * 
     * @param array $data 全量覆盖部门
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90982
     * @return array
     */
    public function replaceparty(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/replaceparty?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取异步任务结果
     * 
     * @param string $jobid 任务ID
     * @return array
     */
    public function getresult(string $jobid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/getresult?access_token=ACCESS_TOKEN&jobid={$jobid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}