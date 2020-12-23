<?php
/**
 * 互联企业消息推送管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 互联企业消息推送管理
 * Class Linkedcorp
 * @package WorkWeChat
 */
class Linkedcorp extends BasicWorkWeChat
{

    /**
     * 互联企业发送应用消息
     * @param string $data
     *
     * 文本消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中，corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：text
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        content	    是	    消息内容，最长不超过2048个字节
        safe	    否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "text",
            "agentid" : 1,
            "text" : {
                "content" : "你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。"
            },
            "safe":0
        }
     * 注意：linked_id为互联ID，此ID可以在管理后台-通讯录-互联企业-详情里查看
     *
     * 图片消息
     * @uses IDE跟踪查看详细参数
     *
        参数	         是否必须	说明
        touser	        否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	        否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	        否	    本企业的标签ID列表，最多支持100个。
        toall	        否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	        是	    消息类型，此时固定为：image
        agentid	        是	    企业应用的id，整型。可在应用的设置页面查看
        media_id        是	    图片媒体文件id，可以调用上传临时素材接口获取
        safe	        否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "image",
            "agentid" : 1,
            "image" : {
                "media_id" : "MEDIA_ID"
            },
            "safe":0
        }
     *
     * 语音消息
     * @uses IDE跟踪查看详细参数
     *
        参数	     是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：voice
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        media_id	是	    语音文件id，可以调用上传临时素材接口获取
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "voice",
            "agentid" : 1,
            "voice" : {
                "media_id" : "MEDIA_ID"
            }
        }
     *
     * 视频消息
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        touser	        否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	        否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	        否	    本企业的标签ID列表，最多支持100个。
        toall	        否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	        是	    消息类型，此时固定为：video
        agentid	        是	    企业应用的id，整型。可在应用的设置页面查看
        media_id        	    是	视频媒体文件id，可以调用上传临时素材接口获取
        title	        否	    视频消息的标题，不超过128个字节，超过会自动截断
        description	    否	    视频消息的描述，不超过512个字节，超过会自动截断
        safe	        否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "video",
            "agentid" : 1,
            "video" : {
                "media_id" : "MEDIA_ID",
                "title" : "Title",
                "description" : "Description"
            },
            "safe":0
        }
     *
     * 文件消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：file
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        media_id    是	    文件id，可以调用上传临时素材接口获取
        safe	    否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "file",
            "agentid" : 1,
            "file" : {
                "media_id" : "1Yv-zXfHjSjU-7LH-GwtYqDGS-zz6w22KmWAT5COgP7o"
            },
            "safe":0
        }
     *
     * 文本卡片消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：textcard
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        title	    是	    标题，不超过128个字节，超过会自动截断
        description	是	    描述，不超过512个字节，超过会自动截断
        url	        是	    点击后跳转的链接。
        btntxt	    否	    按钮文字。 默认为“详情”， 不超过4个文字，超过自动截断。
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "textcard",
            "agentid" : 1,
            "textcard" : {
                "title" : "领奖通知",
                "description" : "<div class=\"gray\">2016年9月26日</div> <div class=\"normal\">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class=\"highlight\">请于2016年10月10日前联系行政同事领取</div>",
                "url" : "URL",
                "btntxt":"更多"
            }
        }
     * 卡片消息的展现形式非常灵活，支持使用br标签或者空格来进行换行处理，也支持使用div标签来使用不同的字体颜色，目前内置了3种文字颜色：灰色(gray)、高亮(highlight)、默认黑色(normal)，将其作为div标签的class属性即可，具体用法请参考上面的示例。
     *
     * 图文消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中，corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：news
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        articles    	    是	图文消息，一个图文消息支持1到8条图文
        title	    是	    标题，不超过128个字节，超过会自动截断
        description	否	    描述，不超过512个字节，超过会自动截断
        url	        是	    点击后跳转的链接。
        picurl	    否	    图文消息的图片链接，支持JPG、PNG格式，较好的效果为大图 640x320，小图80x80。
        btntxt	    否	    按钮文字，仅在图文数为1条时才生效。 默认为“阅读全文”， 不超过4个文字，超过自动截断。该设置只在企业微信上生效，微工作台（原企业号）上不生效。
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "news",
            "agentid" : 1,
            "news" : {
                "articles" : [
                    {
                        "title" : "中秋节礼品领取",
                        "description" : "今年中秋节公司有豪礼相送",
                        "url" : "URL",
                        "picurl" : "http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png",
                        "btntxt":"更多"
                    }
                ]
            }
        }
     *
     * 图文消息（mpnews），mpnews类型的图文消息，跟普通的图文消息一致，唯一的差异是图文内容存储在企业微信。多次发送mpnews，会被认为是不同的图文，阅读、点赞的统计会被分开计算。
     * @uses IDE跟踪查看详细参数
     *
        参数	              是否必须	说明
        touser	            否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	            否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	            否	    本企业的标签ID列表，最多支持100个。
        toall	            否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	            是	    消息类型，此时固定为：mpnews
        agentid	            是	    企业应用的id，整型。可在应用的设置页面查看
        articles            	    是	图文消息，一个图文消息支持1到8条图文
        title	            是	    标题，不超过128个字节，超过会自动截断
        thumb_media_id	    是	    图文消息缩略图的media_id, 可以通过素材管理接口获得。此处thumb_media_id即上传接口返回的media_id
        author	            否	    图文消息的作者，不超过64个字节
        content_source_url	否	    图文消息点击“阅读原文”之后的页面链接
        content	            是	    图文消息的内容，支持html标签，不超过666 K个字节
        digest	            否	    图文消息的描述，不超过512个字节，超过会自动截断
        safe	            否	    表示是否是保密消息，0表示可对外分享，1表示不能分享且内容显示水印，2表示仅限在企业内分享，默认为0；注意仅mpnews类型的消息支持safe值为2，其他消息类型不支持
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
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
            "safe":0
        }
     *
     * markdown消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        touser	    否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中，corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	    否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	    否	    本企业的标签ID列表，最多支持100个。
        toall	    否	    1表示发送给应用可见范围内的所有人（包括互联企业的成员），默认为0
        msgtype	    是	    消息类型，此时固定为：markdown
        agentid	    是	    企业应用的id，整型。可在应用的设置页面查看
        content	    是	    markdown内容，最长不超过2048个字节，必须是utf8编码
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
            "toall" : 0,
            "msgtype" : "markdown",
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
            }
        }
     *
     * 小程序通知消息
     * @uses IDE跟踪查看详细参数
     *
        参数	              是否必须	说明
        touser	            否	    成员ID列表（消息接收者，最多支持1000个）。每个元素的格式为： corpid/userid，其中， corpid为该互联成员所属的企业，userid为该互联成员所属企业中的帐号。如果是本企业的成员，则直接传userid即可
        toparty	            否	    部门ID列表，最多支持100个。partyid在互联圈子内唯一。每个元素都是字符串类型，格式为：linked_id/party_id，其中linked_id是互联id，party_id是在互联圈子中的部门id。如果是本企业的部门，则直接传party_id即可。
        totag	            否	    本企业的标签ID列表，最多支持100个。
        msgtype	            是	    消息类型，此时固定为：miniprogram_notice
        appid	            是	    小程序appid，必须是与当前小程序应用关联的小程序
        page	            否	    点击消息卡片后的小程序页面，仅限本小程序内的页面。该字段不填则消息点击后不跳转。
        title	            是	    消息标题，长度限制4-12个汉字
        description	        否	    消息描述，长度限制4-12个汉字
        emphasis_first_item	否	    是否放大第一个content_item
        content_item	    否	    消息内容键值对，最多允许10个item
        key	                是	    长度10个汉字以内
        value	            是	    长度30个汉字以内
     *
     * @example IDE跟踪查看案例
     *
        {
            "touser" : ["userid1","userid2","CorpId1/userid1","CorpId2/userid2"],
            "toparty" : ["partyid1","partyid2","LinkedId1/partyid1","LinkedId2/partyid2"],
            "totag" : ["tagid1","tagid2"],
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
            }
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function message_send(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/message/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

}