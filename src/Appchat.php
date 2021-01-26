<?php
/**
 * 群聊管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 群聊管理
 * Class Appchat
 * @package WorkWeChat
 */
class Appchat extends BasicWorkWeChat
{

    /**
     * 创建群聊会话
     * @param string $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            是否必须	    说明
        access_token	是	        调用接口凭证
        name	        否	        群聊名，最多50个utf8字符，超过将截断
        owner	        否	        指定群主的id。如果不指定，系统会随机从userlist中选一人作为群主
        userlist	    是	        群成员id列表。至少2人，至多2000人
        chatid	        否	        群聊的唯一标志，不能与已有的群重复；字符串类型，最长32个字符。只允许字符0-9及字母a-zA-Z。如果不填，系统会随机生成群id
     *
     * @example IDE跟踪查看案例
     *
        {
            "name" : "NAME",
            "owner" : "userid1",
            "userlist" : ["userid1", "userid2", "userid3"],
            "chatid" : "CHATID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function create(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改群聊会话
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数          	是否必须	    说明
        access_token	是	        调用接口凭证
        chatid	        是	        群聊id
        name	        否	        新的群聊名。若不需更新，请忽略此参数。最多50个utf8字符，超过将截断
        owner	        否	        新群主的id。若不需更新，请忽略此参数
        add_user_list	否	        添加成员的id列表
        del_user_list	否	        踢出成员的id列表
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid" : "CHATID",
            "name" : "NAME",
            "owner" : "userid2",
            "add_user_list" : ["userid1", "userid2", "userid3"],
            "del_user_list" : ["userid3", "userid4"]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取群聊会话
     * @param string $chatID 群聊ID
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get( $chatID):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/get?access_token=ACCESS_TOKEN&chatid={$chatID}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 应用推送消息
     * @param array $data 请求参数
     *
     * 文本消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	    说明
        chatid	    是	        群聊id
        msgtype	    是	        消息类型，此时固定为：text
        content	    是	        消息内容，最长不超过2048个字节
        safe	    否	        表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid": "CHATID",
            "msgtype":"text",
            "text":{
                "content" : "你的快递已到\n请携带工卡前往邮件中心领取"
            },
            "safe":0
        }
     * 其中text参数的content字段可以支持换行，换行符请用转义过的’\n’。
     *
     * 图片消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        chatid	    是	    群聊id
        msgtype	    是	    消息类型，此时固定为：image
        media_id    是	    图片媒体文件id，可以调用上传临时素材接口获取
        safe	    否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid": "CHATID",
            "msgtype":"image",
            "image":{
                "media_id": "MEDIAID"
            },
            "safe":0
        }
     *
     * 语音消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        chatid	    是	    群聊id
        msgtype	    是	    消息类型，此时固定为：voice
        media_id	是	    语音文件id，可以调用上传临时素材接口获取
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid" : "CHATID",
            "msgtype" : "voice",
            "voice" : {
                "media_id" : "MEDIA_ID"
            }
        }
     *
     * 视频消息
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        chatid	        是	    群聊id
        msgtype	        是	    消息类型，此时固定为：video
        media_id	    是	    视频媒体文件id，可以调用上传临时素材接口获取
        title	        否	    视频消息的标题，不超过128个字节，超过会自动截断
        description	    否	    视频消息的描述，不超过512个字节，超过会自动截断
        safe	        否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid" : "CHATID",
            "msgtype" : "video",
            "video" : {
                "media_id" : "MEDIA_ID",
                "description" : "Description",
                "title": "Title"
            },
            "safe":0
        }
     *
     * 文件消息
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        chatid	    是	    群聊id
        msgtype	    是	    消息类型，此时固定为：file
        media_id    是	    文件id，可以调用上传临时素材接口获取
        safe	    否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid" : "CHATID",
            "msgtype" : "file",
            "file" : {
                "media_id" : "1Yv-zXfHjSjU-7LH-GwtYqDGS-zz6w22KmWAT5COgP7o"
            },
            "safe":0
        }
     *
     * 文本卡片消息
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        chatid	        是	    群聊id
        msgtype	        是	    消息类型，此时固定为：textcard
        title	        是	    标题，不超过128个字节，超过会自动截断
        description	    是	    描述，不超过512个字节，超过会自动截断
        url	            是	    点击后跳转的链接。
        btntxt	        否	    按钮文字。 默认为“详情”， 不超过4个文字，超过自动截断。
     *
     * @example IDE跟踪查看案例
     *
         {
            "chatid": "CHATID",
            "msgtype":"textcard",
            "textcard":{
                "title" : "领奖通知",
                "description" : "<div class=\"gray\">2016年9月26日</div> <div class=\"normal\"> 恭喜你抽中iPhone 7一台，领奖码:520258</div><div class=\"highlight\">请于2016年10月10日前联系行 政同事领取</div>",
                "url":"https://work.weixin.qq.com/",
                "btntxt":"更多"
            },
            "safe":0
         }
     *
     * 图文消息
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        chatid	        是	    群聊id
        msgtype	        是	    消息类型，此时固定为：news
        articles        是	    图文消息，一个图文消息支持1到8条图文
        title	        是	    标题，不超过128个字节，超过会自动截断
        description	    否	    描述，不超过512个字节，超过会自动截断
        url	            是	    点击后跳转的链接。
        picurl	        否	    图文消息的图片链接，支持JPG、PNG格式，较好的效果为大图1068*455，小图150*150。
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid": "CHATID",
            "msgtype":"news",
            "news":{
                "articles" :
                [
                    {
                        "title" : "中秋节礼品领取",
                        "description" : "今年中秋节公司有豪礼相送",
                        "url":"https://work.weixin.qq.com/",
                        "picurl":"http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png"
                    }
                ]
            },
            "safe":0
        }
     *
     * 图文消息（mpnews），mpnews类型的图文消息，跟普通的图文消息一致，唯一的差异是图文内容存储在企业微信。多次发送mpnews，会被认为是不同的图文，阅读、点赞的统计会被分开计算。
     * @uses IDE跟踪查看详细参数
     *
        参数	              是否必须	说明
        chatid	            是	    群聊id
        msgtype	            是	    消息类型，此时固定为：mpnews
        articles            	    是	图文消息，一个图文消息支持1到8条图文
        title	            是	    标题，不超过128个字节，超过会自动截断
        thumb_media_id	    是	    图文消息缩略图的media_id, 可以通过素材管理接口获得。此处thumb_media_id即上传接口返回的media_id
        author	            否	    图文消息的作者，不超过64个字节
        content_source_url	否	    图文消息点击“阅读原文”之后的页面链接
        content	            是	    图文消息的内容，支持html标签，不超过666 K个字节
        digest	            否	    图文消息的描述，不超过512个字节，超过会自动截断
        safe	            否	    表示是否是保密消息，0表示否，1表示是，默认0
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid": "CHATID",
            "msgtype":"mpnews",
            "mpnews":{
                "articles":[
                    {
                        "title": "地球一小时",
                        "thumb_media_id": "biz_get(image)",
                        "author": "Author",
                        "content_source_url": "https://work.weixin.qq.com",
                        "content": "3月24日20:30-21:30 \n办公区将关闭照明一小时，请各部门同事相互转告",
                        "digest": "3月24日20:30-21:30 \n办公区将关闭照明一小时"
                    }
                ]
            },
            "safe":0
        }
     *
     * markdown消息
     * @uses IDE跟踪查看详细参数
     *
        参数	     是否必须	说明
        chatid	   是	    群聊id
        msgtype	   是	    消息类型，此时固定为：markdown
        content	   是	    markdown内容，最长不超过2048个字节，必须是utf8编码
     *
     * @example IDE跟踪查看案例
     *
        {
            "chatid": "CHATID",
            "msgtype":"markdown",
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
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function send(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/appchat/send?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }




}