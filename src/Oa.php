<?php
/**
 * 日程管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 日程管理
 * Class Oa
 * @package WorkWeChat
 */
class Oa extends BasicWorkWeChat
{

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

    /**
     * 获取审批模板详情
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证。必须使用审批应用或企业内自建应用的secret获取，获取方式参考：文档-获取access_token
        template_id	    是	    模板的唯一标识id。可在“获取审批单据详情”、“审批状态变化回调通知”中获得，也可在审批模板的模板编辑页面浏览器Url链接中获得。
     *
     * @example IDE跟踪查看案例
     *
        {
            "template_id" : "ZLqk8pcsAoXZ1eYa6vpAgfX28MPdYU3ayMaSPHaaa"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function gettemplatedetail(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/gettemplatedetail?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 提交审批申请
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	                    必须	    说明
        access_token	        是	    调用接口凭证。必须使用审批应用或企业内自建应用的secret获取，获取方式参考：文档-获取access_token
        creator_userid	        是	    申请人userid，此审批申请将以此员工身份提交，申请人需在应用可见范围内
        template_id	            是	    模板id。可在“获取审批申请详情”、“审批状态变化回调通知”中获得，也可在审批模板的模板编辑页面链接中获得。暂不支持通过接口提交[打卡补卡][调班]模板审批单。
        use_template_approver	是	    审批人模式：0-通过接口指定审批人、抄送人（此时approver、notifyer等参数可用）; 1-使用此模板在管理后台设置的审批流程，支持条件审批。默认为0
        approver	            是	    审批流程信息，用于指定审批申请的审批流程，支持单人审批、多人会签、多人或签，可能有多个审批节点，仅use_template_approver为0时生效。
        └ userid	            是	    审批节点审批人userid列表，若为多人会签、多人或签，需填写每个人的userid
        └ attr	                是	    节点审批方式：1-或签；2-会签，仅在节点为多人审批时有效
        notifyer	            否	    抄送人节点userid列表，仅use_template_approver为0时生效。
        notify_type	            否	    抄送方式：1-提单时抄送（默认值）； 2-单据通过后抄送；3-提单和单据通过后抄送。仅use_template_approver为0时生效。
        apply_data	            是	    审批申请数据，可定义审批申请中各个控件的值，其中必填项必须有值，选填项可为空，数据结构同“获取审批申请详情”接口返回值中同名参数“apply_data”
        └ contents	            是	    审批申请详情，由多个表单控件及其内容组成，其中包含需要对控件赋值的信息
        └ └ control	            是	    控件类型：Text-文本；Textarea-多行文本；Number-数字；Money-金额；Date-日期/日期+时间；Selector-单选/多选；；Contact-成员/部门；Tips-说明文字；File-附件；Table-明细；
        └ └ id	                是	    控件id：控件的唯一id，可通过“获取审批模板详情”接口获取
        └ └ value	            是	    控件值 ，需在此为申请人在各个控件中填写内容不同控件有不同的赋值参数，具体说明详见附录。模板配置的控件属性为必填时，对应value值需要有值。
        summary_list	        是	    摘要信息，用于显示在审批通知卡片、审批列表的摘要信息，最多3行
        └ summary_info	        是	    摘要行信息，用于定义某一行摘要显示的内容
        └ └ text	            是	    摘要行显示文字，用于记录列表和消息通知的显示，不要超过20个字符
        └ └ lang	            是	    摘要行显示语言
     *
     * @example IDE跟踪查看案例
     *
        {
            "creator_userid": "WangXiaoMing",
            "template_id": "3Tka1eD6v6JfzhDMqPd3aMkFdxqtJMc2ZRioeFXkaaa",
            "use_template_approver":0,
            "approver": [
                {
                    "attr": 2,
                    "userid": ["WuJunJie","WangXiaoMing"]
                },
                {
                    "attr": 1,
                    "userid": ["LiuXiaoGang"]
                }
            ],
            "notifyer":[ "WuJunJie","WangXiaoMing" ],
            "notify_type" : 1,
            "apply_data": {
                "contents": [
                    {
                        "control": "Text",
                        "id": "Text-15111111111",
                        "value": {
                            "text": "文本填写的内容"
                        }
                    }
                ]
            },
            "summary_list": [
                {
                    "summary_info": [{
                        "text": "摘要第1行",
                        "lang": "zh_CN"
                    }]
                },
                {
                    "summary_info": [{
                        "text": "摘要第2行",
                        "lang": "zh_CN"
                    }]
                },
                {
                    "summary_info": [{
                        "text": "摘要第3行",
                        "lang": "zh_CN"
                    }]
                }
            ]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function applyevent(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/applyevent?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 批量获取审批单号
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	说明
        access_token	是	调用接口凭证。必须使用审批应用或企业内自建应用的secret获取，获取方式参考：文档-获取access_token
        starttime	    是	审批单提交的时间范围，开始时间，UNix时间戳
        endtime	        是	审批单提交的时间范围，结束时间，Unix时间戳
        cursor	        是	分页查询游标，默认为0，后续使用返回的next_cursor进行分页拉取
        size	        是	一次请求拉取审批单数量，默认值为100，上限值为100
        filters	        否	筛选条件，可对批量拉取的审批申请设置约束条件，支持设置多个条件
        └ key	        否	筛选类型，包括：
                                template_id - 模板类型/模板id；
                                creator - 申请人；
                                department - 审批单提单者所在部门；
                                sp_status - 审批状态。

                                注意:
                                仅“部门”支持同时配置多个筛选条件。
                                不同类型的筛选条件之间为“与”的关系，同类型筛选条件之间为“或”的关系
        └ value	        否	筛选值，对应为：template_id-模板id；creator-申请人userid ；department-所在部门id；sp_status-审批单状态（1-审批中；2-已通过；3-已驳回；4-已撤销；6-通过后撤销；7-已删除；10-已支付）
     *
     * @example IDE跟踪查看案例
     *
        {
            "starttime" : "1569546000",
            "endtime" : "1569718800",
            "cursor" : 0 ,
            "size" : 100 ,
            "filters" : [
                {
                    "key": "template_id",
                    "value": "ZLqk8pcsAoaXZ1eY56vpAgfX28MPdYU3ayMaSPHaaa"
                },
                {
                    "key" : "creator",
                    "value" : "WuJunJie"
                },
                {
                    "key" : "department",
                    "value" : "1688852032415111"
                },
                {
                    "key" : "sp_status",
                    "value" : "1"
                }
            ]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getapprovalinfo(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/getapprovalinfo?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取审批申请详情
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证。必须使用审批应用或企业内自建应用的secret获取，获取方式参考：文档-获取access_token
        sp_no	        是	    审批单编号。
     *
     * @example IDE跟踪查看案例
     *
        {
            "sp_no" : 201909270001
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function getapprovaldetail(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/oa/getapprovaldetail?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }



}