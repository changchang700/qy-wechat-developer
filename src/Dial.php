<?php
/**
 * 获取公费电话拨打记录
 */

namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 获取公费电话拨打记录
 * Class Dial
 * @package WorkWeChat
 */
class Dial extends BasicWorkWeChat
{

    /**
     * 获取公费电话拨打记录
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        start_time	    否	    查询的起始时间戳
        end_time	    否	    查询的结束时间戳
        offset	        否	    分页查询的偏移量
        limit	        否	    分页查询的每页大小,默认为100条，如该参数大于100则按100处理
     *
     * @example IDE跟踪查看案例
     *
        {
            "start_time": 1536508800,
            "end_time": 1536940800,
            "offset": 0,
            "limit": 100
        }
     *
        注意，查询的时间范围为[start_time,end_time]，即前后均为闭区间。在两个参数都指定了的情况下，结束时间不得小于开始时间，开始时间也不得早于当前时间，否则会返回600018错误码(无效的起止时间)。
        限于网络传输，起止时间的最大跨度为30天，如超过30天，则以结束时间为基准向前取30天进行查询。
        果未指定起止时间，则默认查询最近30天范围内数据。
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_dial_record(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/dial/get_dial_record?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }


}