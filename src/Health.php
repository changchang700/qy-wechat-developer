<?php
/**
 * 健康上报管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 健康上报管理
 * Class Health
 * @package WorkWeChat
 */
class Health extends BasicWorkWeChat
{

    /**
     * 获取健康上报使用统计
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证。
        date	        是	    具体某天的使用统计，最长支持获取30天前数据
     *
     * @example IDE跟踪查看案例
     *
        {
            "date": "2020-03-27"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_health_report_stat(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/health/get_health_report_stat?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取健康上报任务ID列表
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        offset	        否	    分页，偏移量, 默认为0
        limit	        否	    分页，预期请求的数据量，默认为100，取值范围 1 ~ 100
     *
     * @example IDE跟踪查看案例
     *
        {
            "offset": 0,
            "limit": 100
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_report_jobids(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/health/get_report_jobids?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 回去健康上报任务详情
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数          	必须	    说明
        access_token	是	    调用接口凭证
        jobid	        是	    任务ID
        date	        是	    具体某天任务详情
     *
     * @example IDE跟踪查看案例
     *
        {
            "jobid": "jobid1",
            "date": "2020-03-27"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_report_job_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/health/get_report_job_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取用户填写答案
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        jobid	        是	    任务ID
        date	        是	    具体某天任务的填写答案
        offset	        否	    数据偏移量
        limit	        否	    拉取的数据量
     *
     * @example IDE跟踪查看案例
     *
        {
            "jobid": "jobid1",
            "date": "2020-03-27",
            "offset": 0,
            "limit": 100
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_report_answer(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/health/get_report_answer?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}