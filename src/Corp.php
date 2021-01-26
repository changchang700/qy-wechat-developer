<?php
/**
 * 审批管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 审批管理
 * Class Corp
 * @package WorkWeChat
 */
class Corp extends BasicWorkWeChat
{
    /**
     * 获取审批数据（旧）
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证。必须使用审批应用的secret获取，获取方式参考：文档-获取access_token
        starttime	    是	    获取审批记录的开始时间。Unix时间戳
        endtime	        是	    获取审批记录的结束时间。Unix时间戳
        next_spnum	    否	    第一个拉取的审批单号，不填从该时间段的第一个审批单拉取
     *
     * @example IDE跟踪查看案例
     *
        {
            "starttime":  1492617600,
            "endtime":    1492790400,
            "next_spnum": 201704200003
        }
     *
        获取审批记录请求参数endtime需要大于startime， 同时起始时间跨度不要超过30天；
        一次请求返回的审批记录上限是100条，超过100条记录请使用next_spnum进行分页拉取。
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getapprovaldata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/getapprovaldata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询自建应用审批单当前状态
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        thirdNo	        是	    开发者发起申请时定义的审批单号
     *
     * @example IDE跟踪查看案例
     *
        {
            "thirdNo": "201806010001"
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getopenapprovaldata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/getopenapprovaldata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}