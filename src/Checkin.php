<?php
/**
 * OA数据接口管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * OA数据接口管理
 * Class Checkin
 * @package WorkWeChat
 */
class Checkin extends BasicWorkWeChat
{

    /**
     * 获取员工打卡规则
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证。必须使用打卡应用的Secret获取access_token，获取方式参考：文档-获取access_token
        datetime	    是	    需要获取规则的日期当天0点的Unix时间戳
        useridlist	    是	    需要获取打卡规则的用户列表
     *
     * @example IDE跟踪查看案例
     *
        {
            "datetime": 1511971200,
            "useridlist": ["james","paul"]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getcheckinoption(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckinoption?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取打卡记录数据
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	                    必须	    说明
        access_token	        是	    调用接口凭证。必须使用打卡应用的Secret获取access_token，获取方式参考：文档-获取access_token
        opencheckindatatype	    是	    打卡类型。1：上下班打卡；2：外出打卡；3：全部打卡
        starttime	            是	    获取打卡记录的开始时间。Unix时间戳
        endtime	                是	    获取打卡记录的结束时间。Unix时间戳
        useridlist	            是	    需要获取打卡记录的用户列表
     *
     * @example IDE跟踪查看案例
     *
        {
            "opencheckindatatype": 3,
            "starttime": 1492617600,
            "endtime": 1492790400,
            "useridlist": ["james","paul"]
        }
     *
        获取记录时间跨度不超过30天
        用户列表不超过100个。若用户超过100个，请分批获取
        有打卡记录即可获取打卡数据，与当前”打卡应用”是否开启无关
        标准打卡时间只对于固定排班和自定义排班两种类型有效
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getcheckindata(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckindata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 录入打卡人员人脸信息
     * @param string $data 请求信息
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    类型	        说明
        access_token	是	    string	    调用接口凭证，必须使用打卡应用的Secret获取access_token，获取方式参考：文档-获取access_token
        userid	        否	    string	    需要录入的用户id
        userface	    否	    string	    需要录入的人脸图片数据，需要将图片数据base64处理后填入，对已录入的人脸会进行更新处理
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "james",
            "userface": "PLACE_HOLDER"
        }
     * 注意：对于已有人脸的用户，使用此接口将使用传入的人脸覆盖原有人脸，请谨慎操作。
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function addcheckinuserface(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/addcheckinuserface?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }







}