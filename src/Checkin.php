<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * OA数据接口管理
 * 
 * Class Checkin
 * @package WorkWeChat
 */
class Checkin extends BasicWorkWeChat
{

    /**
     * 获取员工打卡规则
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90263
     * @return array
     */
    public function getcheckinoption(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckinoption?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取打卡记录数据
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90262
     * @return array
     */
    public function getcheckindata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckindata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取打卡日报数据
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93374
     * @return array
     */
    public function getcheckin_daydata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckin_daydata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取打卡月报数据
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93387
     * @return array
     */
    public function getcheckin_monthdata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckin_monthdata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取打卡人员排班信息
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93380
     * @return array
     */
    public function getcheckinschedulist(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckinschedulist?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 为打卡人员排班
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93385
     * @return array
     */
    public function setcheckinschedulist(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/setcheckinschedulist?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }


    /**
     * 录入打卡人员人脸信息
     * 
     * @param array $data 请求信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93378
     * @return array
     */
    public function addcheckinuserface(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/checkin/addcheckinuserface?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取设备打卡数据
     * 
     * @param array $data 请求信息
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/94126
     * @return array
     */
    public function get_hardware_checkin_data(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/hardware/get_hardware_checkin_data?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}