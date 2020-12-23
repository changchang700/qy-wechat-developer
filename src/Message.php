<?php
/**
 * 消息推送管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 消息推送管理
 * Class Message
 * @package WorkWeChat
 */
class Message extends BasicWorkWeChat
{
    /**
     * 发送应用消息
     * @param string $data 参数信息
     *
     * 文本消息
     * @uses IDE跟踪查看详细参数
     *
        参数              	    是否必须	    说明
        touser	                   否	    指定接收消息的成员，成员ID列表（多个接收者用‘|’分隔，最多支持1000个）。 特殊情况：指定为”@all”，则向该企业应用的全部成员发送
        toparty                    否	    指定接收消息的部门，部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为”@all”时忽略本参数
        totag	                   否	    指定接收消息的标签，标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为”@all”时忽略本参数
        msgtype	                   是	    消息类型，此时固定为：text
        agentid	                   是	    企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        content	                   是	    消息内容，最长不超过2048个字节，超过将截断（支持id转译）
        safe	                   否	    表示是否是保密消息，0表示否，1表示是，默认0
        enable_id_trans            否	    表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check     否	    表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval   否	    表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
         {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "text",
            "agentid" : 1,
            "text" : {
                "content" : "你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。"
            },
            "safe":0,
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
         }
     * touser、toparty、totag不能同时为空，后面不再强调。
     * 其中text参数的content字段可以支持换行、以及A标签，即可打开自定义的网页（可参考以上示例代码）(注意：换行符请用转义过的\n)
     *
     * 图片消息
     * @uses IDE跟踪查看详细参数
     *
    参数	                    是否必须	    说明
    touser	                    否	    成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
    toparty	                    否	    部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
    totag	                    否	    标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
    msgtype	                    是	    消息类型，此时固定为：image
    agentid	                    是	    企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
    media_id                    是	    图片媒体文件id，可以调用上传临时素材接口获取
    safe	                    否	    表示是否是保密消息，0表示否，1表示是，默认0
    enable_duplicate_check	    否	    表示是否开启重复消息检查，0表示否，1表示是，默认0
    duplicate_check_interval	否	    表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "image",
            "agentid" : 1,
            "image" : {
                "media_id" : "MEDIA_ID"
            },
            "safe":0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 语音消息
     * @uses IDE跟踪查看详细参数
     *
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：voice
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        media_id	                是	        语音文件id，可以调用上传临时素材接口获取
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "voice",
            "agentid" : 1,
            "voice" : {
                "media_id" : "MEDIA_ID"
            },
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 视频消息
     * @uses IDE跟踪查看详细参数
     *
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：video
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        media_id                    	        是	视频媒体文件id，可以调用上传临时素材接口获取
        title	                    否	        视频消息的标题，不超过128个字节，超过会自动截断
        description	                否	        视频消息的描述，不超过512个字节，超过会自动截断
        safe	                    否	        表示是否是保密消息，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "video",
            "agentid" : 1,
            "video" : {
                "media_id" : "MEDIA_ID",
                "title" : "Title",
                "description" : "Description"
            },
            "safe":0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 文件消息
     * @uses IDE跟踪查看详细参数
     *
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：file
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        media_id                    是	        文件id，可以调用上传临时素材接口获取
        safe	                    否	        表示是否是保密消息，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "file",
            "agentid" : 1,
            "file" : {
                "media_id" : "1Yv-zXfHjSjU-7LH-GwtYqDGS-zz6w22KmWAT5COgP7o"
            },
            "safe":0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 文件卡片消息
     * @uses IDE跟踪查看详细参数
     *
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：textcard
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        title	                    是	        标题，不超过128个字节，超过会自动截断（支持id转译）
        description	                是	        描述，不超过512个字节，超过会自动截断（支持id转译）
        url	                        是	        点击后跳转的链接。
        btntxt	                    否	        按钮文字。 默认为“详情”， 不超过4个文字，超过自动截断。
        enable_id_trans         	否	        表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1 | PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "textcard",
            "agentid" : 1,
            "textcard" : {
                "title" : "领奖通知",
                "description" : "<div class=\"gray\">2016年9月26日</div> <div class=\"normal\">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class=\"highlight\">请于2016年10月10日前联系行政同事领取</div>",
                "url" : "URL",
                "btntxt":"更多"
            },
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     * 卡片消息的展现形式非常灵活，支持使用br标签或者空格来进行换行处理，也支持使用div标签来使用不同的字体颜色，目前内置了3种文字颜色：灰色(gray)、高亮(highlight)、默认黑色(normal)，将其作为div标签的class属性即可，具体用法请参考上面的示例。
     *
     * 图文消息
     * @uses IDE跟踪查看详细参数
     *
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：news
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        articles                    是	        图文消息，一个图文消息支持1到8条图文
        title	                    是	        标题，不超过128个字节，超过会自动截断（支持id转译）
        description	                否	        描述，不超过512个字节，超过会自动截断（支持id转译）
        url	                        是	        点击后跳转的链接。
        picurl	                    否	        图文消息的图片链接，支持JPG、PNG格式，较好的效果为大图 1068*455，小图150*150。
        enable_id_trans	            否	        表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1 | PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "news",
            "agentid" : 1,
            "news" : {
                "articles" : [
                    {
                        "title" : "中秋节礼品领取",
                        "description" : "今年中秋节公司有豪礼相送",
                        "url" : "URL",
                        "picurl" : "http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png"
                    }
                ]
            },
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 图文消息（mpnews）
     * mpnews类型的图文消息，跟普通的图文消息一致，唯一的差异是图文内容存储在企业微信。多次发送mpnews，会被认为是不同的图文，阅读、点赞的统计会被分开计算。
     * @uses IDE跟踪查看详细参数
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：mpnews
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        articles                    是	        图文消息，一个图文消息支持1到8条图文
        title	                    是	        标题，不超过128个字节，超过会自动截断（支持id转译）
        thumb_media_id	            是	        图文消息缩略图的media_id, 可以通过素材管理接口获得。此处thumb_media_id即上传接口返回的media_id
        author	                    否	        图文消息的作者，不超过64个字节
        content_source_url	        否	        图文消息点击“阅读原文”之后的页面链接
        content	                    是	        图文消息的内容，支持html标签，不超过666 K个字节（支持id转译）
        digest	                    否	        图文消息的描述，不超过512个字节，超过会自动截断（支持id转译）
        safe	                    否	        表示是否是保密消息，0表示可对外分享，1表示不能分享且内容显示水印，2表示仅限在企业内分享，默认为0；注意仅mpnews类型的消息支持safe值为2，其他消息类型不支持
        enable_id_trans	            否	        表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1 | PartyID2",
            "totag": "TagID1 | TagID2",
            "msgtype" : "mpnews",
            "agentid" : 1,
            "mpnews" : {
                "articles":[
                    {
                        "title": "Title",
                        "thumb_media_id": "MEDIA_ID",
                        "author": "Author",
                        "content_source_url": "URL",
                        "content": "Content",
                        "digest": "Digest description"
                    }
                ]
            },
            "safe":0,
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * markdown消息
     * @uses IDE跟踪查看详细参数
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：markdown
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        content	                    是	        markdown内容，最长不超过2048个字节，必须是utf8编码
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1|PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype": "markdown",
            "agentid" : 1,
            "markdown": {
                "content": "您的会议室已经预定，稍后会同步到`邮箱`
                    >**事项详情**
                    >事　项：<font color=\"info\">开会</font>
                    >组织者：@miglioguan
                    >参与者：@miglioguan、@kunliu、@jamdeezhou、@kanexiong、@kisonwang
                    >
                    >会议室：<font color=\"info\">广州TIT 1楼 301</font>
                    >日　期：<font color=\"warning\">2018年5月18日</font>
                    >时　间：<font color=\"comment\">上午9:00-11:00</font>
                    >
                    >请准时参加会议。
                    >
                    >如需修改会议信息，请点击：[修改会议信息](https://work.weixin.qq.com)"
            },
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     *小程序通知消息
     * @uses IDE跟踪查看详细参数
        参数	                        是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。
        msgtype	                    是	        消息类型，此时固定为：miniprogram_notice
        appid	                    是	        小程序appid，必须是与当前小程序应用关联的小程序
        page	                    否	        点击消息卡片后的小程序页面，仅限本小程序内的页面。该字段不填则消息点击后不跳转。
        title	                    是	        消息标题，长度限制4-12个汉字（支持id转译）
        description	                否	        消息描述，长度限制4-12个汉字（支持id转译）
        emphasis_first_item     	否	        是否放大第一个content_item
        content_item	            否	        消息内容键值对，最多允许10个item
        key	                        是	        长度10个汉字以内
        value	                    是	        长度30个汉字以内（支持id转译）
        enable_id_trans	            否	        表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "zhangsan|lisi",
            "toparty": "1|2",
            "totag": "1|2",
            "msgtype" : "miniprogram_notice",
            "miniprogram_notice" : {
                "appid": "wx123123123123123",
                "page": "pages/index?userid=zhangsan&orderid=123123123",
                "title": "会议室预订成功通知",
                "description": "4月27日 16:16",
                "emphasis_first_item": true,
                "content_item": [
                    {
                        "key": "会议室",
                        "value": "402"
                    },
                    {
                        "key": "会议地点",
                        "value": "广州TIT-402会议室"
                    },
                    {
                        "key": "会议时间",
                        "value": "2018年8月1日 09:00-09:30"
                    },
                    {
                        "key": "参与人员",
                        "value": "周剑轩"
                    }
                ]
            },
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * 任务卡片消息，仅企业微信2.8.2及以上版本支持
     * @uses IDE跟踪查看详细参数
        参数	                      是否必须	    说明
        touser	                    否	        成员ID列表（消息接收者，多个接收者用‘|’分隔，最多支持1000个）。特殊情况：指定为@all，则向关注该企业应用的全部成员发送
        toparty	                    否	        部门ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        totag	                    否	        标签ID列表，多个接收者用‘|’分隔，最多支持100个。当touser为@all时忽略本参数
        msgtype	                    是	        消息类型，此时固定为：taskcard
        agentid	                    是	        企业应用的id，整型。企业内部开发，可在应用的设置页面查看；第三方服务商，可通过接口 获取企业授权信息 获取该参数值
        title	                    是	        标题，不超过128个字节，超过会自动截断（支持id转译）
        description	                是	        描述，不超过512个字节，超过会自动截断（支持id转译）
        url	                        否	        点击后跳转的链接。最长2048字节，请确保包含了协议头(http/https)
        task_id	                    是	        任务id，同一个应用发送的任务卡片消息的任务id不能重复，只能由数字、字母和“_-@”组成，最长支持128字节
        btn	                        是	        按钮列表，按钮个数为1~2个。
        btn:key	                    是	        按钮key值，用户点击后，会产生任务卡片回调事件，回调事件会带上该key值，只能由数字、字母和“_-@”组成，最长支持128字节
        btn:name	                是	        按钮名称
        btn:replace_name	        否	        点击按钮后显示的名称，默认为“已处理”
        btn:color	                否	        按钮字体颜色，可选“red”或者“blue”,默认为“blue”
        btn:is_bold	                否	        按钮字体是否加粗，默认false
        enable_id_trans	            否	        表示是否开启id转译，0表示否，1表示是，默认0
        enable_duplicate_check	    否	        表示是否开启重复消息检查，0表示否，1表示是，默认0
        duplicate_check_interval	否	        表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : "UserID1|UserID2|UserID3",
            "toparty" : "PartyID1 | PartyID2",
            "totag" : "TagID1 | TagID2",
            "msgtype" : "taskcard",
            "agentid" : 1,
            "taskcard" : {
                "title" : "赵明登的礼物申请",
                "description" : "礼品：A31茶具套装<br>用途：赠与小黑科技张总经理",
                "url" : "URL",
                "task_id" : "taskid123",
                "btn":[
                    {
                        "key": "key111",
                        "name": "批准",
                        "replace_name": "已批准",
                        "color":"red",
                        "is_bold": true
                    },
                    {
                        "key": "key222",
                        "name": "驳回",
                        "replace_name": "已驳回"
                    }
                ]
            },
            "enable_id_trans": 0,
            "enable_duplicate_check": 0,
            "duplicate_check_interval": 1800
        }
     *
     * @return array
     */
    public function send(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 更新任务卡片消息状态
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	    说明
        userids	        是	        企业的成员ID列表（消息接收者，最多支持1000个）。
        agentid	        是	        应用的agentid
        task_id	        是	        发送任务卡片消息时指定的task_id
        clicked_key	    是	        设置指定的按钮为选择状态，需要与发送消息时指定的btn:key一致
     *
     * @example IDE跟踪查看案例
     *
        {
            "userids" : ["userid1","userid2"],
            "agentid" : 1,
            "task_id": "taskid122",
            "clicked_key": "btn_key123"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function update_taskcard(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/update_taskcard?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 查询应用消息发送统计
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        time_type	    否	    查询哪天的数据，0：当天；1：昨天。默认为0。
     *
     * @example IDE跟踪查看案例
     *
        {
            "time_type": 0
        }
     *
     * @return array
     */
    public function get_statistics(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/get_statistics?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

}