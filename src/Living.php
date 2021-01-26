<?php
/**
 * 企业直播管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 企业直播管理
 * Class Living
 * @package WorkWeChat
 */
class Living extends BasicWorkWeChat
{

    /**
     * 获取成员直播id列表
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        userid	        是	    企业成员的userid
        begin_time	    是	    开始时间，最长只能拉取180天前数据。只能取到2020-04-23日后数据
        end_time	    是	    结束时间，时间跨度不超过180天
        next_key	    否	    上一次调用时返回的next_key，初次调用可以填”0”
        limit	        否	    每次拉取的数据量，默认值和最大值都为100
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "begin_time": 1586136317,
            "end_time": 1586236317,
            "next_key": "NEXT_KEY",
            "limit": 100
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_user_livingid(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/living/get_user_livingid?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取直播详情
     * @param string $livingID 直播id
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_living_info(string $livingID):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/living/get_living_info?access_token=ACCESS_TOKEN&livingid={$livingID}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取看直播统计
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        livingid	    是	    直播的id
        next_key	    否	    上一次调用时返回的next_key，初次调用可以填”0”
     *
     * @example IDE跟踪查看案例
     *
        {
            "livingid": "livingid1",
            "next_key": "NEXT_KEY"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_watch_stat(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/living/get_watch_stat?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

//    /**
//     * 创建预约直播
//     * @param array $data
//     * @return array
//     * @throws Exceptions\InvalidResponseException
//     */
//    public function livingCreate(array $data)
//    {
//        $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/create?access_token=ACCESS_TOKEN';
//        $this->registerApi($url, __FUNCTION__, func_get_args());
//        return $this->callPostApi($url, $data);
//    }

//    /**
//     * 更新预约直播
//     * @param array $data
//     * @return array
//     * @throws Exceptions\InvalidResponseException
//     */
//    public function update(array $data)
//    {
//        $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/modify?access_token=ACCESS_TOKEN';
//        $this->registerApi($url, __FUNCTION__, func_get_args());
//        return $this->callPostApi($url, $data);
//    }

    /**
     * 直播操作
     * @param array $data
     * @param $type
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function modify(array $data, $type)
    {
        if (!in_array($type, ['create','update','delete','cancel','detail','detail_more'])) { // 创建 更新 删除 取消 详情 观看明细
            throw new \Exception('参数类型错误');
        }

        switch ($type) {
            case 'create' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/create?access_token=ACCESS_TOKEN';
            }
            case 'update' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/modify?access_token=ACCESS_TOKEN';
            }
            case 'cancel' : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/cancel?access_token=ACCESS_TOKEN';
            }
            case 'delete'  : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/delete_replay_data?access_token=ACCESS_TOKEN';
            }
            case 'detail'  : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/get_living_info?access_token=ACCESS_TOKEN&livingid=LIVINGID';
            }
            case 'detail_more'  : {
                $url = 'https://qyapi.weixin.qq.com/cgi-bin/living/get_watch_stat?access_token=ACCESS_TOKEN';
            }
        }

        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->callPostApi($url, $data);
    }
}
