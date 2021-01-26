<?php
/**
 * 成员管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 成员管理
 * Class User
 * @package WeChat
 */
class User extends BasicWorkWeChat
{

    /**
     * 创建成员
     * @param array $data 成员信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须            说明
        access_token        是          调用接口凭证。获取方法查看“获取access_token”
        userid              是          成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节。只能由数字、字母和“_-@.”四种字符组成，且第一个字符必须是数字或字母。
        name                是          成员名称。长度为1~64个utf8字符
        alias               否          成员别名。长度1~32个utf8字符
        mobile              否          手机号码。企业内必须唯一，mobile/email二者不能同时为空
        department          否          成员所属部门id列表,不超过100个
        order               否          部门内的排序值，默认为0，成员次序以创建时间从小到大排列。个数必须和参数department的个数一致，数值越大排序越前面。有效的值范围是[0, 2^32)
        position            否          职务信息。长度为0~128个字符
        gender              否          性别。1表示男性，2表示女性
        email               否          邮箱。长度6~64个字节，且为有效的email格式。企业内必须唯一，mobile/email二者不能同时为空
        telephone           否          座机。32字节以内，由纯数字或’-‘号组成。
        is_leader_in_dept	否          个数必须和参数department的个数一致，表示在所在的部门内是否为上级。1表示为上级，0表示非上级。在审批等应用里可以用来标识上级审批人
        avatar_mediaid      否          成员头像的mediaid，通过素材管理接口上传图片获得的mediaid
        enable              否          启用/禁用成员。1表示启用成员，0表示禁用成员
        extattr             否          自定义字段。自定义字段需要先在WEB管理端添加，见扩展属性添加方法，否则忽略未知属性的赋值。与对外属性一致，不过只支持type=0的文本和type=1的网页类型，详细描述查看对外属性
        to_invite           否          是否邀请该成员使用企业微信（将通过微信服务通知或短信或邮件下发邀请，每天自动下发一次，最多持续3个工作日），默认值为true。
        external_profile	否          成员对外属性，字段详情见对外属性
        external_position	否          对外职务，如果设置了该值，则以此作为对外展示的职务，否则以position来展示。长度12个汉字内
        address             否          地址。长度最大128个字符
        main_department     否          主部门
     *
     * @example IDE跟踪查看案例
     * 
        {
            "userid": "zhangsan",
            "name": "张三",
            "alias": "jackzhang",
            "mobile": "+86 13800000000",
            "department": [1, 2],
            "order":[10,40],
            "position": "产品经理",
            "gender": "1",
            "email": "zhangsan@gzdev.com",
            "is_leader_in_dept": [1, 0],
            "enable":1,
            "avatar_mediaid": "2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0",
            "telephone": "020-123456",
            "address": "广州市海珠区新港中路",
            "main_department": 1,
            "extattr": {
                "attrs": [
                    {
                        "type": 0,
                        "name": "文本名称",
                        "text": {
                            "value": "文本"
                        }
                    },
                    {
                        "type": 1,
                        "name": "网页名称",
                        "web": {
                            "url": "http://www.test.com",
                            "title": "标题"
                        }
                    }
                ]
            },
            "to_invite": true,
            "external_position": "高级产品经理",
            "external_profile": {
                "external_corp_name": "企业简称",
                "external_attr": [
                    {
                        "type": 0,
                        "name": "文本名称",
                        "text": {
                            "value": "文本"
                        }
                    },
                    {
                        "type": 1,
                        "name": "网页名称",
                        "web": {
                            "url": "http://www.test.com",
                            "title": "标题"
                        }
                    },
                    {
                        "type": 2,
                        "name": "测试app",
                        "miniprogram": {
                            "appid": "wx8bd8012614784fake",
                            "pagepath": "/index",
                            "title": "my miniprogram"
                        }
                    }
                ]
            }
        }
     * 
     * @return array
     */
    public function create(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 读取成员
     * @param string $userid 成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
     * @return array
     */
    public function get(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 更新成员
     * @param type $data 用户信息
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证
        userid              是      成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
        name                否      成员名称。长度为1~64个utf8字符
        alias               否      别名。长度为1-32个utf8字符
        mobile              否      手机号码。企业内必须唯一。若成员已激活企业微信，则需成员自行修改（此情况下该参数被忽略，但不会报错）
        department          否      成员所属部门id列表，不超过100个
        order               否      部门内的排序值，默认为0。当有传入department时有效。数量必须和department一致，数值越大排序越前面。有效的值范围是[0, 2^32)
        position            否      职务信息。长度为0~128个字符
        gender              否      性别。1表示男性，2表示女性
        email               否      邮箱。长度不超过64个字节，且为有效的email格式。企业内必须唯一。若是绑定了腾讯企业邮箱的企业微信，则需要在腾讯企业邮箱中修改邮箱（此情况下该参数被忽略，但不会报错）
        telephone           否      座机。由1-32位的纯数字或’-‘号组成
        is_leader_in_dept	否      上级字段，个数必须和department一致，表示在所在的部门内是否为上级。
        avatar_mediaid      否      成员头像的mediaid，通过素材管理接口上传图片获得的mediaid
        enable              否      启用/禁用成员。1表示启用成员，0表示禁用成员
        extattr             否      自定义字段。自定义字段需要先在WEB管理端添加，见扩展属性添加方法，否则忽略未知属性的赋值。与对外属性一致，不过只支持type=0的文本和type=1的网页类型，详细描述查看对外属性
        external_profile	否      成员对外属性，字段详情见对外属性
        external_position	否      对外职务，如果设置了该值，则以此作为对外展示的职务，否则以position来展示。不超过12个汉字
        address             否      地址。长度最大128个字符
        main_department   	否      主部门
     * 
     * @example IDE跟踪查看案例
        {
            "userid": "zhangsan",
            "name": "张三",
            "alias": "jackzhang",
            "mobile": "+86 13800000000",
            "department": [1, 2],
            "order":[10,40],
            "position": "产品经理",
            "gender": "1",
            "email": "zhangsan@gzdev.com",
            "is_leader_in_dept": [1, 0],
            "enable":1,
            "avatar_mediaid": "2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0",
            "telephone": "020-123456",
            "address": "广州市海珠区新港中路",
            "main_department": 1,
            "extattr": {
                "attrs": [
                    {
                        "type": 0,
                        "name": "文本名称",
                        "text": {
                            "value": "文本"
                        }
                    },
                    {
                        "type": 1,
                        "name": "网页名称",
                        "web": {
                            "url": "http://www.test.com",
                            "title": "标题"
                        }
                    }
                ]
            },
            "to_invite": true,
            "external_position": "高级产品经理",
            "external_profile": {
                "external_corp_name": "企业简称",
                "external_attr": [
                    {
                        "type": 0,
                        "name": "文本名称",
                        "text": {
                            "value": "文本"
                        }
                    },
                    {
                        "type": 1,
                        "name": "网页名称",
                        "web": {
                            "url": "http://www.test.com",
                            "title": "标题"
                        }
                    },
                    {
                        "type": 2,
                        "name": "测试app",
                        "miniprogram": {
                            "appid": "wx8bd8012614784fake",
                            "pagepath": "/index",
                            "title": "my miniprogram"
                        }
                    }
                ]
            }
        }
     */
    public function update(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 删除成员
     * 
     * @param string $userid 成员UserID。对应管理端的帐号
     * @return array
     */
    public function delete(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 批量删除成员
     * 
     * @param array $data 成员UserID列表。对应管理端的帐号。最多支持200个。若存在无效UserID，直接返回错误
     * @example IDE跟踪查看案例
        {
            "userid1",
            "userid2",
            "userid3"
        }
     * @return array
     */
    public function batchdelete(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/batchdelete?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取部门成员
     * @param int $department_id 获取的部门id
     * @param bool $fetch_child 是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门
     * @return array
     */
    public function simplelist(int $department_id,bool $fetch_child=false):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token=ACCESS_TOKEN&department_id={$department_id}&fetch_child={$fetch_child}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取部门成员详情
     * 
     * @param int $department_id 获取的部门id
     * @param bool $fetch_child 1/0：是否递归获取子部门下面的成员
     * @return array
     */
    public function list(int $department_id,bool $fetch_child=false):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=ACCESS_TOKEN&department_id={$department_id}&fetch_child={$fetch_child}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * userid与openid互换
     * @param array $data 企业内的成员id
     * @expample 
        {
           "userid": "zhangsan"
        }
     * 
     * @example IDE跟踪查看案例
     * 
        {
           "userid": "zhangsan"
        }
     * 
     * @return array
     */
    public function convert_to_openid(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_openid?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 二次验证
     * @param string $userid 成员UserID。对应管理端的帐号
     * @return array
     */
    public function authsucc(string $userid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/authsucc?access_token=ACCESS_TOKEN&userid={$userid}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 邀请成员
     * @param type $data 参数
     * @uses IDE跟踪查看详细参数
     * 
        参数                是否必须        说明
        access_token        是          调用接口凭证
        user                否          成员ID列表, 最多支持1000个。
        party               否          部门ID列表，最多支持100个。
        tag                 否          标签ID列表，最多支持100个。
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "errcode" : 0,
            "errmsg" : "ok",
            "invaliduser" : ["UserID1", "UserID2"],
            "invalidparty" : [PartyID1, PartyID2],
            "invalidtag": [TagID1, TagID2]
        }
     * 
     * @return array
     */
    public function invite($data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/invite?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取加入企业二维码
     * @param string $size_type qrcode尺寸类型，1: 171 x 171; 2: 399 x 399; 3: 741 x 741; 4: 2052 x 2052
     * @return array
     */
    public function get_join_qrcode(string $size_type):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corp/get_join_qrcode?access_token=ACCESS_TOKEN&size_type={$size_type}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
    
    /**
     * 获取企业活跃成员数
     * @param array $data
     * @uses IDE跟踪查看详细参数
     * 
        参数                必须        说明
        access_token        是      调用接口凭证。获取方法查看“获取access_token”
        date                是      具体某天的活跃人数，最长支持获取30天前数据
     * @example IDE跟踪查看案例
     * 
        {
            "date": "2020-03-27"
        }
     * 
     * @return array
     */
    public function get_active_stat(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/get_active_stat?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取访问用户身份（网页授权登录）
     * @param string $code 通过成员授权获取到的code，最大为512字节。每次成员授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
     * @return array
     */
    public function getuserinfo_by_web(string $code):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN&code={$code}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取访问用户身份（扫码授权登录）
     * @param string $code 通过成员授权获取到的code，最大为512字节。每次成员授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
     * @return array
     */
    public function getuserinfo_by_qr($code):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN&code={$code}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

}