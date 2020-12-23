<?php
/**
 * 客户联系
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 客户联系
 * Class Tag
 * @package WeChat
 */
class Externalcontact extends BasicWorkWeChat
{
    
    /**
     * 获取配置了客户联系功能的成员列表
     * 
     * 企业和第三方服务商可通过此接口获取配置了客户联系功能的成员列表。
     * 
     * @return array
     */
    public function get_follow_user_list():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_follow_user_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 配置客户联系「联系我」方式
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        type            是      联系方式类型,1-单人, 2-多人
        scene           是      场景，1-在小程序中联系，2-通过二维码联系
        style           否      在小程序中联系时使用的控件样式，详见附表
        remark          否      联系方式的备注信息，用于助记，不超过30个字符
        skip_verify     否      外部客户添加时是否无需验证，默认为true
        state           否      企业自定义的state参数，用于区分不同的添加渠道，在调用“获取外部联系人详情”时会返回该参数值，不超过30个字符
        user            否      使用该联系方式的用户userID列表，在type为1时为必填，且只能有一个
        party           否      使用该联系方式的部门id列表，只在type为2时有效
        is_temp         否      是否临时会话模式，true表示使用临时会话模式，默认为false
        expires_in      否      临时会话二维码有效期，以秒为单位。该参数仅在is_temp为true时有效，默认7天
        chat_expires_in	否      临时会话有效期，以秒为单位。该参数仅在is_temp为true时有效，默认为添加好友后24小时
        unionid         否      可进行临时会话的客户unionid，该参数仅在is_temp为true时有效，如不指定则不进行限制
        conclusions     否      结束语，会话结束时自动发送给客户，可参考“结束语定义”，仅在is_temp为true时有效
     *
     * @example IDE跟踪查看案例
     * 
        {
            "type" :1,
            "scene":1,
            "style":1,
            "remark":"渠道客户",
            "skip_verify":true,
            "state":"teststate",
            "user" : ["zhangsan", "lisi", "wangwu"],
            "party" : [2, 3],
            "is_temp":true,
            "expires_in":86400,
            "chat_expires_in":86400,
            "unionid":"oxTWIuGaIt6gTKsQRLau2M0AAAA",
            "conclusions":
            {
                "text": 
                {
                    "content":"文本消息内容"
                },
                "image": 
                {
                    "media_id": "MEDIA_ID"
                   },
                "link":
                {
                    "title": "消息标题",
                    "picurl": "https://example.pic.com/path",
                    "desc": "消息描述",
                    "url": "https://example.link.com/path"
                },
                "miniprogram":
                {
                    "title": "消息标题",
                    "pic_media_id": "MEDIA_ID",
                    "appid": "wx8bd80126147dfAAA",
                    "page": "/path/index.html"
                }
            }
        }

     * 
     * @return array
     */
    public function add_contact_way(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取企业已配置的「联系我」方式
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        config_id       是      联系方式的配置id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "config_id":"42b34949e138eb6e027c123cba77fad7"
        }

     * 
     * @return array
     */
    public function get_contact_way(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 更新企业已配置的「联系我」方式
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        config_id       是      企业联系方式的配置id
        remark          否      联系方式的备注信息，不超过30个字符，将覆盖之前的备注
        skip_verify     否      外部客户添加时是否无需验证
        style           否      样式，只针对“在小程序中联系”的配置生效
        state           否      企业自定义的state参数，用于区分不同的添加渠道，在调用“获取外部联系人详情”时会返回该参数值
        user            否      使用该联系方式的用户列表，将覆盖原有用户列表
        party           否      使用该联系方式的部门列表，将覆盖原有部门列表，只在配置的type为2时有效
        expires_in      否      临时会话二维码有效期，以秒为单位，该参数仅在临时会话模式下有效
        chat_expires_in	否      临时会话有效期，以秒为单位，该参数仅在临时会话模式下有效
        unionid         否      可进行临时会话的客户unionid，该参数仅在临时会话模式有效，如不指定则不进行限制
        conclusions     否      结束语，会话结束时自动发送给客户，可参考“结束语定义”，仅临时会话模式（is_temp为true）可设置
     *
     * @example IDE跟踪查看案例
     * 
        {
            "config_id":"42b34949e138eb6e027c123cba77fAAA",
            "remark":"渠道客户",
            "skip_verify":true,
            "style":1,
            "state":"teststate",
            "user" : ["zhangsan", "lisi", "wangwu"],
            "party" : [2, 3],
            "expires_in":86400,
            "chat_expires_in":86400,
            "unionid":"oxTWIuGaIt6gTKsQRLau2M0AAAA",
            "conclusions":
            {
                "text":
                {
                    "content":"文本消息内容"
                },
                "image": 
                {
                    "media_id": "MEDIA_ID"
                },
                "link": 
                {
                    "title": "消息标题",
                    "picurl": "https://example.pic.com/path",
                    "desc": "消息描述",
                    "url": "https://example.link.com/path"
                },
                "miniprogram": 
                {
                    "title": "消息标题",
                    "pic_media_id": "MEDIA_ID",
                    "appid": "wx8bd80126147dfAAA",
                    "page": "/path/index"
                }
            }
        }

     * 
     * @return array
     */
    public function update_contact_way(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/update_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 删除企业已配置的「联系我」方式
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        config_id       是      企业联系方式的配置id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "config_id":"42b34949e138eb6e027c123cba77fAAA"
        }
     * 
     * @return array
     */
    public function del_contact_way(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取客户列表
     * @param string $userid 企业成员的userid
     * @example IDE跟踪查看案例
     * @return array
     */
    public function list(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/list?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取客户详情
     * @param string $external_userid 外部联系人的userid，注意不是企业成员的帐号
     * @example IDE跟踪查看案例
     * @return array
     */
    public function get(string $external_userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get?access_token=ACCESS_TOKEN&external_userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 批量获取客户详情
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        userid          是      企业成员的userid，字符串类型
        cursor          否      用于分页查询的游标，字符串类型，由上一次调用返回，首次调用可不填
        limit           否      返回的最大记录数，整型，最大值100，默认值50，超过最大值时取最大值
     *
     * @example IDE跟踪查看案例
     * 
        {
            "userid":"rocky",
            "cursor":"",
            "limit":100
        }
     * 
     * @return array
     */
    public function get_by_user(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_contact_way?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 修改客户备注信息
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证
        userid              是      企业成员的userid
        external_userid     是      外部联系人userid
        remark              否      此用户对外部联系人的备注，最多20个字符
        description         否      此用户对外部联系人的描述，最多150个字符
        remark_company      否      此用户对外部联系人备注的所属公司名称，最多20个字符
        remark_mobiles      否      此用户对外部联系人备注的手机号
        remark_pic_mediaid	否      备注图片的mediaid，
     *
     * @example IDE跟踪查看案例
     * 
        {
            "userid":"rocky",
            "cursor":"",
            "limit":100
        }
     * 
     * @return array
     */
    public function remark(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/remark?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 管理企业标签
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        tag_id          否      要查询的标签id，如果不填则获取该企业的所有客户标签，目前暂不支持标签组id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "tag_id": [
                "etXXXXXXXXXX",
                "etYYYYYYYYYY"
            ]
        }
     * 
     * @return array
     */
    public function get_corp_tag_list(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_corp_tag_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 管理企业标签
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        userid          是      添加外部联系人的userid
        external_userid	是      外部联系人userid
        add_tag         否      要标记的标签列表
        remove_tag      否      要移除的标签列表
     *
     * @example IDE跟踪查看案例
     * 
        {
            "userid":"zhangsan",
            "external_userid":"woAJ2GCAAAd1NPGHKSD4wKmE8Aabj9AAA",
            "add_tag":["TAGID1","TAGID2"],
            "remove_tag":["TAGID3","TAGID4"]
        }
     * 
     * @return array
     */
    public function mark_tag(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/mark_tag?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取客户群列表
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                        必须	说明
        access_token                是	调用接口凭证
        status_filter               否	群状态过滤。0 - 所有列表 1 - 离职待继承 2 - 离职继承中 3 - 离职继承完成 默认为0
        owner_filter                否	群主过滤。如果不填，表示获取全部群主的数据
        owner_filter.userid_list	否	用户ID列表。最多100个
        offset                      否	分页，偏移量。默认为0
        limit                       是	分页，预期请求的数据量，取值范围 1 ~ 1000
     *
     * @example IDE跟踪查看案例
     * 
        {
            "status_filter": 0,
            "owner_filter": {
                "userid_list": ["abel"]
            },
            "offset": 0,
            "limit": 100
        }
     * 
     * @return array
     */
    public function groupchat_list(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取客户群详情
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        chat_id         是      客户群ID
     *
     * @example IDE跟踪查看案例
     * 
        {
            "chat_id":"wrOgQhDgAAMYQiS5ol9G7gK9JVAAAA"
        }
     * 
     * @return array
     */
    public function groupchat_get(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 添加企业群发消息任务
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                        必须        说明
        access_token                是      调用接口凭证
        chat_type                   否      群发任务的类型，默认为single，表示发送给客户，group表示发送给客户群
        external_userid             否      客户的外部联系人id列表，仅在chat_type为single时有效，不可与sender同时为空，最多可传入1万个客户
        sender                      否      发送企业群发消息的成员userid，当类型为发送给客户群时必填
        text.content                否      消息文本内容，最多4000个字节
        image.media_id              否      图片的media_id，可以通过素材管理接口获得
        image.pic_url               否      图片的链接，仅可使用上传图片接口得到的链接
        link.title                  是      图文消息标题
        link.picurl                 否      图文消息封面的url
        link.desc                   否      图文消息的描述，最多512个字节
        link.url                    是      图文消息的链接
        miniprogram.title           是      小程序消息标题，最多64个字节
        miniprogram.pic_media_id	是      小程序消息封面的mediaid，封面图建议尺寸为520*416
        miniprogram.appid           是      小程序appid，必须是关联到企业的小程序应用
        miniprogram.page            是      小程序page路径
     *
     * @example IDE跟踪查看案例
     * 
        {
            "chat_type":"single",
            "external_userid": [
                "woAJ2GCAAAXtWyujaWJHDDGi0mACAAAA",
                "wmqfasd1e1927831123109rBAAAA"
            ],
            "sender":"zhangsan",
            "text": {
                "content":"文本消息内容"
            },
            "image": {
                "media_id": "MEDIA_ID",
                "pic_url":"http://p.qpic.cn/pic_wework/3474110808/7a6344sdadfwehe42060/0"
            },
            "link": {
                "title": "消息标题",
                "picurl": "https://example.pic.com/path",
                "desc": "消息描述",
                "url": "https://example.link.com/path"
            },
            "miniprogram": {
                "title": "消息标题",
                "pic_media_id": "MEDIA_ID",
                "appid": "wx8bd80126147dfAAA",
                "page": "/path/index.html"
            }
        }
     * 
     * @return array
     */
    public function add_msg_template(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_msg_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取企业群发消息发送结果
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        msgid           是      群发消息的id，通过添加企业群发消息模板接口返回  
     *
     * @example IDE跟踪查看案例
     * 
        {
            "msgid": "msgGCAAAXtWyujaWJHDDGi0mACAAAA"
        }
     * 
     * @return array
     */
    public function get_group_msg_result(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_group_msg_result?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 发送新客户欢迎语
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                        必须        说明
        access_token                是      调用接口凭证
        welcome_code                是      通过添加外部联系人事件推送给企业的发送欢迎语的凭证，有效期为20秒
        text.content                否      消息文本内容,最长为4000字节
        image.media_id              否      图片的media_id，可以通过素材管理接口获得
        image.pic_url               否      图片的链接，仅可使用上传图片接口得到的链接
        link.title                  是      图文消息标题，最长为128字节
        link.picurl                 否      图文消息封面的url
        link.desc                   否      图文消息的描述，最长为512字节
        link.url                    是      图文消息的链接
        miniprogram.title           是      小程序消息标题，最长为64字节
        miniprogram.pic_media_id	是      小程序消息封面的mediaid，封面图建议尺寸为520*416
        miniprogram.appid           是      小程序appid，必须是关联到企业的小程序应用
        miniprogram.page            是      小程序page路径
     *
     * @example IDE跟踪查看案例
     * 
        {
            "welcome_code":"CALLBACK_CODE",
            "text": {
                "content":"文本消息内容"
            },
            "image": {
                "media_id": "MEDIA_ID",
                "pic_url":"http://p.qpic.cn/pic_wework/3474110808/7a6344sdadfwehe42060/0"
            },
            "link": {
                "title": "消息标题",
                "picurl": "https://example.pic.com/path",
                "desc": "消息描述",
                "url": "https://example.link.com/path"
            },
            "miniprogram": {
                "title": "消息标题",
                "pic_media_id": "MEDIA_ID",
                "appid": "wx8bd80126147dfAAA",
                "page": "/path/index.html"
            }
        }
     * 
     * @return array
     */
    public function send_welcome_msg(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/send_welcome_msg?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 添加群欢迎语素材
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                        必须        说明
        access_token                是      调用接口凭证
        text.content                否      消息文本内容,最长为3000字节
        image.media_id              否      图片的media_id，可以通过素材管理接口获得
        image.pic_url               否      图片的链接，仅可使用上传图片接口得到的链接
        link.title                  是      图文消息标题，最长为128字节
        link.picurl                 否      图文消息封面的url
        link.desc                   否      图文消息的描述，最长为512字节
        link.url                    是      图文消息的链接
        miniprogram.title           是      小程序消息标题，最长为64字节
        miniprogram.pic_media_id	是      小程序消息封面的mediaid，封面图建议尺寸为520*416
        miniprogram.appid           是      小程序appid，必须是关联到企业的小程序应用
        miniprogram.page            是      小程序page路径
     *
     * @example IDE跟踪查看案例
     * 
        {
            "text": {
                "content":"亲爱的%NICKNAME%用户，你好"
            },
            "image": {
                "media_id": "MEDIA_ID",
                "pic_url":"http://p.qpic.cn/pic_wework/3474110808/7a6344sdadfwehe42060/0"
            },
            "link": {
                "title": "消息标题",
                "picurl": "https://example.pic.com/path",
                "desc": "消息描述",
                "url": "https://example.link.com/path"
            },
            "miniprogram": {
                "title": "消息标题",
                "pic_media_id": "MEDIA_ID",
                "appid": "wx8bd80126147dfAAA",
                "page": "/path/index"
            }
        }
     * 
     * @return array
     */
    public function group_welcome_template_add(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 编辑群欢迎语素材
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                        必须        说明
        access_token                是      调用接口凭证
        template_id                 是      欢迎语素材id
        text.content                否      消息文本内容,最长为4000字节
        image.media_id              否      图片的media_id，可以通过素材管理接口获得
        image.pic_url               否      图片的链接，仅可使用上传图片接口得到的链接
        link.title                  是      图文消息标题，最长为128字节
        link.picurl                 否      图文消息封面的url
        link.desc                   否      图文消息的描述，最长为512字节
        link.url                    是      图文消息的链接
        miniprogram.title           是      小程序消息标题，最长为64字节
        miniprogram.pic_media_id	是      小程序消息封面的mediaid，封面图建议尺寸为520*416
        miniprogram.appid           是      小程序appid，必须是关联到企业的小程序应用
        miniprogram.page            是      小程序page路径
     *
     * @example IDE跟踪查看案例
     * 
        {
            "template_id":"msgXXXXXXX",
            "text": {
                "content":"文本消息内容"
            },
            "image": {
                "media_id": "MEDIA_ID",
                "pic_url":"http://p.qpic.cn/pic_wework/3474110808/7a6344sdadfwehe42060/0"
            },
            "link": {
                "title": "消息标题",
                "picurl": "https://example.pic.com/path",
                "desc": "消息描述",
                "url": "https://example.link.com/path"
            },
            "miniprogram": {
                "title": "消息标题",
                "pic_media_id": "MEDIA_ID",
                "appid": "wx8bd80126147df384",
                "page": "/path/index"
            }
        }
     * 
     * @return array
     */
    public function group_welcome_template_edit(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 获取群欢迎语素材
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        template_id     是      群欢迎语的素材id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "template_id":"msgXXXXXXX"
        }
     * 
     * @return array
     */
    public function group_welcome_template_get(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }
    
    /**
     * 删除群欢迎语素材
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        template_id 	是      群欢迎语的素材id
     *
     * @example IDE跟踪查看案例
     * 
        {
            "template_id":"msgXXXXXXX"
        }
     * 
     * @return array
     */
    public function group_welcome_template_del(string $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/group_welcome_template/edit?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取离职成员的客户列表
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数	             必须	     说明
        access_token     是	        调用接口凭证
        page_id        	 否         分页查询，要查询页号，从0开始
        page_size	     否	        每次返回的最大记录数，默认为1000，最大值为1000
        cursor	         否	        分页查询游标，字符串类型，适用于数据量较大的情况，如果使用该参数则无需填写page_id，该参数由上一次调用返回
     *
     * @example IDE跟踪查看案例
     *
        {
             "page_id":0
             "cursor":"",
             "page_size":100
        }
     * 注意:当page_id为1，page_size为100时，表示取第101到第200条记录。由于每个成员的客户数不超过5万，故page_id*page_size 必须小于5万。
     *
     * @return array
     */
    public function get_unassigned_list(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_unassigned_list?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 分配成员的客户
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数                    必须	        说明
        access_token	        是	        调用接口凭证
        external_userid	        是	        外部联系人的userid，注意不是企业成员的帐号
        handover_userid	        是	        原跟进成员的userid
        takeover_userid	        是	        接替成员的userid
        transfer_success_msg	否	        转移成功后发给客户的消息，最多200个字符，不填则使用默认文案，目前只对在职成员分配客户的情况生效
     *
     * @example IDE跟踪查看案例
     *
         {
             "external_userid": "woAJ2GCAAAXtWyujaWJHDDGi0mACAAAA",
             "handover_userid": "zhangsan",
             "takeover_userid": "lisi",
             "transfer_success_msg":"您好，您的服务已升级，后续将由我的同事张三@腾讯接替我的工作，继续为您服务。"
         }
     *
     * @return array
     */
    public function transfer_client(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/transfer?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 查询客户接替结果
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数	                必须	    说明
        access_token	    是	    调用接口凭证
        external_userid	    是	    客户的userid，注意不是企业成员的帐号
        handover_userid	    是	    原添加成员的userid
        takeover_userid	    是	    接替成员的userid
     *
     * @example IDE跟踪查看案例
     *
         {
            "external_userid": "woAJ2GCAAAXtWyujaWJHDDGi0mACAAAA",
            "handover_userid": "zhangsan",
            "takeover_userid": "lisi"
         }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function get_transfer_result(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_transfer_result?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 离职成员的群再分配
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        chat_id_list	是	    需要转群主的客户群ID列表。取值范围： 1 ~ 100
        new_owner	    是	    新群主ID
     *
     * @example IDE跟踪查看案例
     *
        {
            "chat_id_list" : ["wrOgQhDgAAcwMTB7YmDkbeBsgT_AAAA", "wrOgQhDgAAMYQiS5ol9G7gK9JVQUAAAA"],
            "new_owner" : "zhangsan"
        }
     *
        注意：
        群主离职了的客户群，才可继承
        继承给的新群主，必须是配置了客户联系功能的成员
        继承给的新群主，必须有设置实名
        继承给的新群主，必须有激活企业微信
        同一个人的群，限制每天最多分配300个给新群主
     * @return array
     */
    public function dimission_flock_transfer(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/transfer?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));

    }

    /**
     * 获取联系客户统计数据
     * @param string $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
          参数	          必须	    说明
          access_token	  是	    调用接口凭证
          userid	      否	    成员ID列表，最多100个
          partyid	      否	    部门ID列表，最多100个
          start_time	  是	    数据起始时间
          end_time	      是	    数据结束时间
     *
     * @example IDE跟踪查看案例
     *
         {
             "userid": [
                 "zhangsan",
                 "lisi"
             ],
             "partyid":
             [
                  1001,
                  1002
             ],
             "start_time":1536508800,
             "end_time":1536595200
         }
     *
     * @return array
     */
    public function get_user_behavior_data(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_user_behavior_data?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取客户群统计数据（按群主聚合方式）
     * @param string $data 参数信息
     *
        参数                      	必须	    说明
        access_token	            是	    调用接口凭证
        day_begin_time	            是	    起始日期的时间戳，填当天的0时0分0秒（否则系统自动处理为当天的0分0秒）。取值范围：昨天至前180天。
        day_end_time	            否	    结束日期的时间戳，填当天的0时0分0秒（否则系统自动处理为当天的0分0秒）。取值范围：昨天至前180天。如果不填，默认同 day_begin_time（即默认取一天的数据）
        owner_filter	            否	    群主过滤，如果不填，表示获取全部群主的数据
        owner_filter.userid_list	否	    群主ID列表。最多100个
        order_by	                否	    排序方式。1 - 新增群的数量； 2 - 群总数； 3 - 新增群人数； 4 - 群总人数。默认为1
        order_asc	                否	    是否升序。0-否；1-是。默认降序
        offset	                    否	    分页，偏移量, 默认为0
        limit	                    否	    分页，预期请求的数据量，默认为500，取值范围 1 ~ 1000
     *
     * @example IDE跟踪查看案例
     *
         {
            "day_begin_time": 1600272000,
            "day_end_time": 1600444800,
            "owner_filter": {
                "userid_list": ["zhangsan"]
            },
            "order_by": 2,
            "order_asc": 0,
            "offset" : 0,
            "limit" : 1000
         }
     *
     * @return array
     */
    public function groupchat_statistic(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/statistic?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }

    /**
     * 获取客户群统计数据（按自然日聚合方式）
     * @param string $data 参数信息
     *
        参数          	            必须	    说明
        access_token	            是	    调用接口凭证
        day_begin_time	            是	    起始日期的时间戳，填当天的0时0分0秒（否则系统自动处理为当天的0分0秒）。取值范围：昨天至前180天。
        day_end_time	            否	    结束日期的时间戳，填当天的0时0分0秒（否则系统自动处理为当天的0分0秒）。取值范围：昨天至前180天。如果不填，默认同 day_begin_time（即默认取一天的数据）
        owner_filter	            否	    群主过滤，如果不填，表示获取全部群主的数据
        owner_filter.userid_list	否	    群主ID列表。最多100个
     *
     * @example IDE跟踪查看案例
     *
          {
              "day_begin_time": 1600272000,
              "day_end_time": 1600358400,
              "owner_filter": {
                  "userid_list": ["zhangsan"]
              }
          }
     *
     * @return array
     */
    public function groupchat_by_day(string $data):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/externalcontact/groupchat/statistic_group_by_day?access_token=ACCESS_TOKEN';
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, json_decode($data,true));
    }


}

