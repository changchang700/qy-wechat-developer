<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 日程管理
 * 
 * Class Oa
 * @package WorkWeChat
 */
class Oa extends BasicWorkWeChat
{

    /**
     * 获取审批模板详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91982
     * @return array
     */
    public function gettemplatedetail(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/gettemplatedetail?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 提交审批申请
     * 
     * @param array $data
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91853
     * @return array
     */
    public function applyevent(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/applyevent?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 批量获取审批单号
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91816
     * @return array
     */
    public function getapprovalinfo(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/getapprovalinfo?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取审批申请详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91983
     * @return array
     */
    public function getapprovaldetail(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/getapprovaldetail?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取审批数据（旧）
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91530
     * @return array
     */
    public function getapprovaldata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/getapprovaldata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取企业假期管理配置
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93375
     * @return array
     */
    public function getcorpconf(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/vacation/getcorpconf?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取成员假期余额
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93376
     * @return array
     */
    public function getuservacationquota(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/vacation/getuservacationquota?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改成员假期余额
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93377
     * @return array
     */
    public function setoneuserquota(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/vacation/setoneuserquota?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 批量获取汇报记录单号
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93393
     * @return array
     */
    public function get_record_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/journal/get_record_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取汇报记录详情
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93394
     * @return array
     */
    public function get_record_detail(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/journal/get_record_detail?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取汇报统计数据
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/93395
     * @return array
     */
    public function get_stat_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/journal/get_stat_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询自建应用审批单当前状态
     * 
     * @param array $data 请求参数
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90269
     * @return array
     */
    public function getopenapprovaldata(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/getopenapprovaldata?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建日历
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数      	  是否必须	说明
        calendar	    是	    日历信息
        organizer	    是	    指定的组织者userid。注意该字段指定后不可更新
        readonly	    否	    日历组织者对日历是否只读权限（即不可编辑日历，不可在日历上添加日程，仅可作为组织者删除日历）。0-否；1-是。默认为1，即只读
        set_as_default	否	    是否将该日历设置为组织者的默认日历。 0-否；1-是。默认为0，即不设为默认日历
        summary	        是	    日历标题。1 ~ 128 字符
        color	        是	    日历在终端上显示的颜色，RGB颜色编码16进制表示，例如：”#0000FF” 表示纯蓝色
        description 	否	    日历描述。0 ~ 512 字符
        shares	        否	    日历共享成员列表。最多2000人
        shares.userid	是	    日历共享成员的id
        shares.readonly	否	    共享成员对日历是否只读权限（即不可编辑日历，不可在日历上添加日程，仅可以退出日历）。 0-否；1-是。默认为1，即只读
     *
     * @example IDE跟踪查看案例
     *
        {
            "calendar" : {
                "organizer" : "userid1",
                "readonly" : 1,
                "set_as_default" : 1,
                "summary" : "test_summary",
                "color" : "#FF3030",
                "description" : "test_describe",
                "shares" : [
                    {
                        "userid" : "userid2"
                    },
                    {
                        "userid" : "userid3",
                        "readonly" : 1
                    }
                ]
            }
        }
     *
     * @return array
     */
    public function calendar_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/calendar/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新日历
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        calendar	    是	    日历信息
        cal_id	        是	    日历ID
        readonly	    否	    日历组织者对日历是否只读权限（即不可编辑日历，不可在日历上添加日程，仅可作为组织者删除日历）。0-否；1-是。默认为1，即只读
        summary	        是	    日历标题。1 ~ 128 字符
        color	        是	    日历颜色，RGB颜色编码16进制表示，例如：”#0000FF” 表示纯蓝色
        description	    否	    日历描述。0 ~ 512 字符
        shares	        否	    日历共享成员列表。最多2000人
        shares.userid	是	    日历共享成员的id
        shares.readonly	否	    共享成员对日历是否只读权限（即不可编辑日历，不可在日历上添加日程，仅可以退出日历）。 0-否；1-是。默认为1，即只读
     *
     * @example IDE跟踪查看案例
     *
        {
            "calendar" : {
                "cal_id":"wcjgewCwAAqeJcPI1d8Pwbjt7nttzAAA",
                "readonly" : 1,
                "summary" : "test_summary",
                "color" : "#FF3030",
                "description" : "test_describe_1",
                "shares" : [
                    {
                        "userid" : "userid1"
                    },
                    {
                        "userid" : "userid2",
                        "readonly" : 1
                    }
                ]
            }
        }
     * 注意, 不可更新组织者。
     * @return array
     */
    public function calendar_update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/calendar/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取日历
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	          是否必须	说明
        cal_id_list	    是	    日历ID列表，调用创建日历接口后获得。一次最多可获取1000条
     *
     * @example IDE跟踪查看案例
        {
            "cal_id_list": ["wcjgewCwAAqeJcPI1d8Pwbjt7nttzAAA"]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function calender_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/calendar/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除日志
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	        是否必须	    说明
        cal_id	    是	        日历ID
     *
     * @example IDE跟踪查看案例
        {
            "cal_id":"wcjgewCwAAqeJcPI1d8Pwbjt7nttzAAA"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function calendar_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/calendar/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 创建日程
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	                      是否必须	说明
        schedule	                是	    日程信息
        organizer	                是	    组织者
        start_time	                是	    日程开始时间，Unix时间戳
        end_time	                是	    日程结束时间，Unix时间戳
        attendees	                否	    日程参与者列表。最多支持2000人
        userid	                    是	    日程参与者ID
        summary	                    否	    日程标题。0 ~ 128 字符。不填会默认显示为“新建事件”
        description	                否	    日程描述。0 ~ 512 字符
        reminders	                否	    提醒相关信息
        is_remind	                否	    是否需要提醒。0-否；1-是
        remind_before_event_secs	否	    日程开始（start_time）前多少秒提醒，当is_remind为1时有效。例如： 300表示日程开始前5分钟提醒。目前仅支持以下数值： 0 - 事件开始时, 300 - 事件开始前5分钟,900 - 事件开始前15分钟,3600 - 事件开始前1小时,  86400 - 事件开始前1天
        is_repeat	                否	    是否重复日程。0-否；1-是
        repeat_type	                否	    重复类型，当is_repeat为1时有效。目前支持如下类型： 0 - 每日,1 - 每周, 2 - 每月,5 - 每年,7 - 工作日
        location	                否	    日程地址。0 ~ 128 字符
        cal_id	                    否	    日程所属日历ID。注意，这个日历必须是属于组织者(organizer)的日历；如果不填，那么插入到组织者的默认日历上
     *
     * @example IDE跟踪查看案例
        {
            "schedule": {
                "organizer": "userid1",
                "start_time": 1571274600,
                "end_time": 1571320210,
                "attendees": [
                    {
                        "userid": "userid2"
                    }
                ],
                "summary": "test_summary",
                "description": "test_description",
                "reminders": {
                    "is_remind": 1,
                    "remind_before_event_secs": 3600,
                    "is_repeat": 1,
                    "repeat_type": 7
                },
                "location": "test_place",
                "cal_id": "wcjgewCwAAqeJcPI1d8Pwbjt7nttzAAA"
            }
        }
     * @return array
     */
    public function schedule_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/schedule/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新日程
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	                      是否必须	说明
        schedule	                是	    日程信息
        organizer	                是	    组织者。注意，暂不支持变更组织者
        schedule_id	                是	    日程ID
        start_time	                是	    日程开始时间，Unix时间戳
        end_time	                是	    日程结束时间，Unix时间戳
        attendees	                否	    日程参与者列表。最多支持2000人
        userid	                    是	    日程参与者ID
        summary	                    否	    日程标题。0 ~ 128 字符。不填会默认显示为“新建事件”
        description	                否	    日程描述。0 ~ 512 字符
        reminders	                否	    提醒相关信息
        is_remind	                否	    是否需要提醒。0-否；1-是
        remind_before_event_secs	否	    日程开始（start_time）前多少秒提醒，当is_remind为1时有效。例如： 300表示日程开始前5分钟提醒。目前仅支持以下数值： 0 - 事件开始时 ,300 - 事件开始前5分钟,900 - 事件开始前15分钟,3600 - 事件开始前1小时,86400 - 事件开始前1天
        is_repeat	                否	    是否重复日程。0-否；1-是
        repeat_type	                否	    重复类型，当is_repeat为1时有效。目前支持如下类型：    0 - 每日,1 - 每周,2 - 每月,5 - 每年,7 - 工作日
        location	                否	    日程地址。0 ~ 128 字符
     *
     * @example IDE跟踪查看案例
    {
        "schedule": {
            "organizer": "userid1",
            "schedule_id": "17c7d2bd9f20d652840f72f59e796AAA",
            "start_time": 1571274600,
            "end_time": 1571320210,
            "attendees": [
                {
                    "userid": "userid2"
                }
            ],
            "summary": "test_summary",
            "description": "test_description",
            "reminders": {
                "is_remind": 1,
                "remind_before_event_secs": 3600,
                "is_repeat": 1,
                "repeat_type": 7
            },
            "location": "test_place"
        }
    }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function schedule_update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/schedule/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取日程
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	              是否必须	说明
        schedule_id_list	是	    日程ID列表。一次最多拉取1000条
     *
     * @example IDE跟踪查看案例
        {
            "schedule_id_list": [
                "17c7d2bd9f20d652840f72f59e796AAA"
            ]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function schedule_get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/schedule/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 取消日程
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	          是否必须	说明
        schedule_id	    是	    日程ID
     *
     * @example IDE跟踪查看案例
        {
            "schedule_id":"17c7d2bd9f20d652840f72f59e796AAA"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function schedule_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/schedule/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取日历下的日程列表
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	      是否必须	说明
        cal_id	    是	    日历ID
        offset	    否	    分页，偏移量, 默认为0
        limit	    否	    分页，预期请求的数据量，默认为500，取值范围 1 ~ 1000
     *
     * @example IDE跟踪查看案例
        {
            "cal_id": "wcjgewCwAAqeJcPI1d8Pwbjt7nttzAAA",
            "offset" : 100,
            "limit" : 1000
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function schedule_get_by_calendar(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/schedule/get_by_calendar?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 添加会议室
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	                    必须	    说明
        access_token	        是	    调用接口凭证
        name	                是	    会议室名称，最多30个字符
        capacity	            是	    会议室所能容纳的人数
        city	                否	    会议室所在城市
        building	            否	    会议室所在楼宇
        floor	                否	    会议室所在楼层
        equipment	            否	    会议室支持的设备列表,参数详细含义见附录
        coordinate.latitude	    否	    会议室所在建筑纬度,可通过腾讯地图坐标拾取器获取
        coordinate.longitude	否	    会议室所在建筑经度,可通过腾讯地图坐标拾取器获取
     *
     * @example IDE跟踪查看案例
        {
            "name":"18F-会议室",
            "capacity":10,
            "city":"深圳",
            "building":"腾讯大厦",
            "floor":"18F",
            "equipment":[1,2,3],
            "coordinate":
            {
                "latitude":"22.540503",
                "longitude":"113.934528"
            }
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询会议室
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        city	        否	    会议室所在城市
        building	    否	    会议室所在楼宇
        floor       	否	    会议室所在楼层
        equipment	    否	    会议室支持的设备列表,参数详细含义见附录
     *
     * @example IDE跟踪查看案例
        {
            "city":"深圳",
            "building":"腾讯大厦",
            "floor":"18F",
            "equipment":[1,2,3]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 编辑会议室
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	                    必须	    说明
        access_token	        是	    调用接口凭证
        meetingroom_id	        是	    会议室的id
        name	                否	    会议室名称，最多30个字符
        capacity	            否	    会议室所能容纳的人数
        city	                否	    会议室所在城市
        building	            否	    会议室所在楼宇
        floor	                否	    会议室所在楼层
        equipment	            否	    会议室支持的设备列表,参数详细含义见附录
        coordinate.latitude	    否	    会议室所在建筑纬度,可通过腾讯地图坐标拾取器获取
        coordinate.longitude	否	    会议室所在建筑经度,可通过腾讯地图坐标拾取器获取
     *
     * @example IDE跟踪查看案例
        {
            "meetingroom_id":2,
            "name":"18F-会议室",
            "capacity":10,
            "city":"深圳",
            "building":"腾讯大厦",
            "floor":"18F",
            "equipment":[1,2,3],
            "coordinate":
            {
                "latitude":"22.540503",
                "longitude":"113.934528"
            }
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_edit(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除会议室
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        meetingroom_id	是	    会议室的id
     *
     * @example IDE跟踪查看案例
        {
            "meetingroom_id":1,
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 查询会议室的预定信息 ，不支持跨天查询。
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        meetingroom_id	否	    会议室id
        start_time	    否	    查询预定的起始时间，默认为当前时间
        end_time	    否	    查询预定的结束时间， 默认为明日0时
        city	        否	    会议室所在城市
        building	    否	    会议室所在楼宇
        floor	        否	    会议室所在楼层
     *
     * @example IDE跟踪查看案例
        {
            "meetingroom_id":1,
            "start_time":1593532800,
            "end_time":1593619200,
            "city":"深圳",
            "building":"腾讯大厦",
            "floor":"18F"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_get_booking_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/get_booking_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 预定会议室，并自动关联日程。
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数          	必须	    说明
        access_token	是	    调用接口凭证
        subject	        否	    会议主题
        meetingroom_id	是	    会议室id
        start_time	    是	    预定开始时间
        end_time	    是	    预定结束时间
        booker	        是	    预定人的userid
        attendees	    否	    参与人的userid列表
     *
     * @example IDE跟踪查看案例
        {
            "meetingroom_id":1,
            "subject":"周会",
            "start_time":1593532800,
            "end_time":1593619200,
            "booker":"zhangsan",
            "attendees":["lisi", "wangwu"]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_book(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/book?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 取消预定会议室
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        meeting_id	    是	    会议的id
        keep_schedule	否	    是否保留日程，0-同步删除 1-保留
     *
     * @example IDE跟踪查看案例
        {
            "meeting_id":"mt42b34949gsaseb6e027c123cbafAAA",
            "keep_schedule":1
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function meetingroom_cancel_book(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/meetingroom/cancel_book?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
}