<?php
/**
 * 互联企业
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 互联企业
 * Class Tag
 * @package WeChat
 */
class Agent extends BasicWorkWeChat
{

    /**
     * 获取应用的可见范围
     * 
     * 本接口只返回互联企业中非本企业内的成员和部门的信息，如果要获取本企业的可见范围，请调用“获取应用”接口
     * 
     * @param $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数	说明
        errcode	返回码
        errmsg	对返回码的文本描述内容
        userids	可见的userids，是用 CorpId + ’/‘ + USERID 拼成的字符串
        department_ids	可见的department_ids，是用 linkedid + ’/‘ + department_id 拼成的字符串
     *
     * @example IDE跟踪查看案例
     * 
        {
            "tagname": "UI",
            "tagid": 12
        }
     * 
     * @return array
     */
    public function create(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/agent/get_perm_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取互联企业成员详细信息
     * @param $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        userid          是      该字段用的是互联应用可见范围接口返回的userids参数，用的是 CorpId + ’/‘ + USERID 拼成的字符串
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "userid": "CORPID/USERID"
        }
     * 
     */
    public function get(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/get?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门成员
     * @param $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
        fetch_child     否      是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门，不传默认只获取本部门成员
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID",
            "fetch_child": true
        }
     * 
     */
    public function simplelist(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/simplelist?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门成员详情
     * @param $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
        fetch_child     否      是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门，不传默认只获取本部门成员
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID",
            "fetch_child": true
        }
     * 
     */
    public function list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取互联企业部门列表
     * @param $data 请求参数
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        access_token	是      调用接口凭证
        department_id	是      该字段用的是互联应用可见范围接口返回的department_ids参数，用的是 linkedid + ’/‘ + department_id 拼成的字符串
     * 
     * @example IDE跟踪查看案例
     * 
        {
            "department_id": "LINKEDID/DEPARTMENTID"
        }
     * 
     */
    public function department_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/user/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取指定的应用详情
     * @param $data 应用id
     * @return array
     */
    public function get_agent(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/get?access_token=ACCESS_TOKEN&agentid={$data}";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取access_token对应的应用列表
     * @return array
     */
    public function list_agent():array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 设置应用
     * @param $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
         参数	               必须	    说明
         access_token	        是   	调用接口凭证
         agentid	            是   	企业应用的id
         report_location_flag	否   	企业应用是否打开地理位置上报 0：不上报；1：进入会话上报；
         logo_mediaid	        否   	企业应用头像的mediaid，通过素材管理接口上传图片获得mediaid，上传后会自动裁剪成方形和圆形两个头像
         name	                否   	企业应用名称，长度不超过32个utf8字符
         description	        否   	企业应用详情，长度为4至120个utf8字符
         redirect_domain    	否   	企业应用可信域名。注意：域名需通过所有权校验，否则jssdk功能将受限，此时返回错误码85005
         isreportenter	        否   	是否上报用户进入应用事件。0：不接收；1：接收。
         home_url	            否   	应用主页url。url必须以http或者https开头（为了提高安全性，建议使用https）。
     *
     * @example IDE跟踪查看案例
     *
          {
            "agentid": 1000005,
            "report_location_flag": 0,
            "logo_mediaid": "j5Y8X5yocspvBHcgXMSS6z1Cn9RQKREEJr4ecgLHi4YHOYP-plvom-yD9zNI0vEl",
            "name": "财经助手",
            "description": "内部财经服务平台",
            "redirect_domain": "open.work.weixin.qq.com",
            "isreportenter": 0,
            "home_url": "https://open.work.weixin.qq.com"
          }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function set(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 设置应用在工作台展示的模板
     * @param $data 参数信息
     * @uses IDE跟踪查看详细参数
     *
        参数	                必须	    说明
        access_token	    是	    调用接口凭证
        type	            是	    模版类型，目前支持的自定义类型包括 “keydata”、 “image”、 “list”、 “webview” 。若设置的type为 “normal”,则相当于从自定义模式切换为普通宫格或者列表展示模式
        agentid	            是	    应用id
        keydata	            否	    若type指定为 “keydata”，且需要设置企业级别默认数据，则需要设置关键数据型模版数据,数据结构参考“关键数据型”
        image	            否	    若type指定为 “image”，且需要设置企业级别默认数据，则需要设置图片型模版数据,数据结构参考“图片型”
        list	            否	    若type指定为 “list”，且需要设置企业级别默认数据，则需要设置列表型模版数据,数据结构参考“列表型”
        webview	            否	    若type指定为 “webview”，且需要设置企业级别默认数据，则需要设置webview型模版数据,数据结构参考“webview型”
        replace_user_data	否	    是否覆盖用户工作台的数据。设置为true的时候，会覆盖企业所有用户当前设置的数据。若设置为false,则不会覆盖用户当前设置的所有数据。默认为false
     *
     * @example IDE跟踪查看案例
     *
        {
            "agentid":1000005,
            "type":"image",
            "image":{
                "url":"xxxx",
                "jump_url":"http://www.qq.com",
                "pagepath":"pages/index"
            },
            "replace_user_data":true
        }
     *
     * 关键数据型, type为 “keydata”
     *
        参数	            必须	    说明
        items	        是	    关键数据列表个，不超过4个
        items.key   	否	    关键数据名称，需要设置在模版中
        items.data	    是	    关键数据
        items.jump_url	否	    点击跳转url，若不填且应用设置了主页url，则跳转到主页url，否则跳到应用会话窗口
        items.pagepath	否	    若应用为小程序类型，该字段填小程序pagepath，若未设置，跳到小程序主页
     *
     {
        "items":[
            {
                "key":"待审批",
                "data":"2",
                "jump_url":"http://www.qq.com",
                "pagepath":"pages/index"
            },
            {
                "key":"带批阅作业",
                "data":"4",
                "jump_url":"http://www.qq.com",
                "pagepath":"pages/index"
            },
            {
                "key":"成绩录入",
                "data":"45",
                "jump_url":"http://www.qq.com",
                "pagepath":"pages/index"
            },
            {
                "key":"综合评价",
                "data":"98",
                "jump_url":"http://www.qq.com",
                "pagepath":"pages/index"
            }
        ]
     }
     *
     * 图片型, type为 “image”
     *
        参数	        必须	    说明
        url	        否	    图片url。图片的最佳比例为3.35:1
        jump_url	否	    点击跳转url。若不填且应用设置了主页url，则跳转到主页url，否则跳到应用会话窗口
        pagepath	否	    若应用为小程序类型，该字段填小程序pagepath，若未设置，跳到小程序主页
     *
     *
        {
            "url":"xxxx",
            "jump_url":"http://www.qq.com",
            "pagepath":"pages/index"
        }
     *
     * 列表型, type为 “list”
     *
        参数	            必须	    说明
        items	        是	    关键数据列表个，不超过3个
        items.title	    是	    列表显示文字，不超过128个字节
        items.jump_url	否	    点击跳转url，若不填且应用设置了主页url，则跳转到主页url，否则跳到应用会话窗口
        items.pagepath	否	    若应用为小程序类型，该字段填小程序pagepath，若未设置，跳到小程序主页
     *
        {
            "items":[
                {
                    "title":"智慧校园新版设计的小程序要来啦",
                    "jump_url":"http://www.qq.com",
                    "pagepath":"pages/index"
                },
                {
                    "title":"植物百科，这是什么花",
                    "jump_url":"http://www.qq.com",
                    "pagepath":"pages/index"
                },
                {
                    "title":"周一升旗通知，全体学生必须穿校服",
                    "jump_url":"http://www.qq.com",
                    "pagepath":"pages/index"
                }
            ]
        }
     *
     * webview型, type为 “webview”, webview在工作台的高度固定为170px
     *
        参数	    必须	    说明
        url	    否	    渲染展示的url
        jump_url	否	    点击跳转url。若不填且应用设置了主页url，则跳转到主页url，否则跳到应用会话窗口
        pagepath	否	    若应用为小程序类型，该字段填小程序pagepath，若未设置，跳到小程序主页
     *
        {
            "url":"http://www.qq.com",
            "jump_url":"http://www.qq.com",
            "pagepath":"pages/index"
        }
     * @return array
     */
    public function set_workbench_template(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set_workbench_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取应用在工作台展示的模版
     * @param $data 参数信息
     * @uses IDE跟踪查看详细参数
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        agentid	        是	    应用id
     *
     * @example IDE跟踪查看案例
     *
        {
            "agentid":1000005
        }
     *
     * @return array
     */
    public function get_workbench_template(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/get_workbench_template?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 设置应用在用户工作台展示的数据
     * @param $data 参数信息
     * @uses IDE跟踪查看详细参数
        参数          	必须	    说明
        access_token	是	    调用接口凭证
        agentid	        是	    应用id
        userid	        是	    需要设置的用户的userid
        type	        是	    目前支持 “keydata”、 “image”、 “list” 、”webview”
        keydata	        否	    若type指定为 “keydata”，则需要设置关键数据型模版数据,数据结构参考“关键数据型”
        image	        否	    若type指定为 “image”，则需要设置图片型模版数据，数据结构参考“图片型”
        list	        否	    若type指定为 “list”，则需要设置列表型模版数据，数据结构参考“列表型”
        webview	        否	    若type指定为 “webview”，则需要设置webview型模版数据，数据结构参考“webview数据型”
     *
     * @example IDE跟踪查看案例
     *
        {
            "agentid":1000005,
            "userid":"test",
            "type":"keydata",
            "keydata":{
                "items":[
                    {
                        "key":"待审批",
                        "data":"2",
                        "jump_url":"http://www.qq.com",
                        "pagepath":"pages/index"
                    },
                    {
                        "key":"带批阅作业",
                        "data":"4",
                        "jump_url":"http://www.qq.com",
                        "pagepath":"pages/index"
                    },
                    {
                        "key":"成绩录入",
                        "data":"45",
                        "jump_url":"http://www.qq.com",
                        "pagepath":"pages/index"
                    },
                    {
                        "key":"综合评价",
                        "data":"98",
                        "jump_url":"http://www.qq.com",
                        "pagepath":"pages/index"
                    }
                ]
            }
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function set_workbench_data(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/agent/set_workbench_data?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取应用共享信息
        access_token	是	调用接口凭证，上级企业应用access_token
        agentid	是	上级企业应用agentid
     */
    public function list_app_share_info()
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/corpgroup/corp/list_app_share_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        $data['agentid'] = $this->getConfig()['agentid'];
        return $this->httpPostForJson($url, $data);
    }
}