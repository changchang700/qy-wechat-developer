<?php
/**
 * 异步批量接口
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;

/**
 * 异步批量接口
 * Class Tag
 * @package WeChat
 */
class Batch extends BasicWorkWeChat
{

    /**
     * 增量更新成员
     * 
     * 本接口以userid（帐号）为主键，增量更新企业微信通讯录成员。请先下载CSV模板(下载增量更新成员模版)，根据需求填写文件内容。
     * 
     * @param array $data 增量更新成员
     * @info IDE跟踪查看使用说明
     * 
        注意事项：
        模板中的部门需填写部门ID，多个部门用分号分隔，部门ID必须为数字，根部门的部门id默认为1
        文件中存在、通讯录中也存在的成员，更新成员在文件中指定的字段值
        文件中存在、通讯录中不存在的成员，执行添加操作
        通讯录中存在、文件中不存在的成员，保持不变
        成员字段更新规则：可自行添加扩展字段。文件中有指定的字段，以指定的字段值为准；文件中没指定的字段，不更新
     * 
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        media_id        是      上传的csv文件的media_id
        to_invite       否      是否邀请新建的成员使用企业微信（将通过微信服务通知或短信或邮件下发邀请，每天自动下发一次，最多持续3个工作日），默认值为true。
        callback        否      回调信息。如填写该项则任务完成后，通过callback推送事件给企业。具体请参考应用回调模式中的相应选项
        url             否      企业应用接收企业微信推送请求的访问协议和地址，支持http或https协议
        token           否      用于生成签名
        encodingaeskey	否      用于消息体的加密，是AES密钥的Base64编码
     *
     * @example IDE跟踪查看案例
     * 
        {
            "media_id":"xxxxxx",
            "to_invite": true,
            "callback":
            {
                 "url": "xxx",
                 "token": "xxx",
                 "encodingaeskey": "xxx"
            }
        }
     * 
     * @return array
     */
    public function syncuser(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/syncuser?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 全量覆盖成员
     * 
     * 本接口以userid为主键，全量覆盖企业的通讯录成员，任务完成后企业的通讯录成员与提交的文件完全保持一致。请先下载CSV文件(下载全量覆盖成员模版)，根据需求填写文件内容。
     * 
     * @param array $data 全量覆盖成员
     * @info IDE跟踪查看使用说明
     * 
        注意事项：
        模板中的部门需填写部门ID，多个部门用分号分隔，部门ID必须为数字，根部门的部门id默认为1
        文件中存在、通讯录中也存在的成员，完全以文件为准
        文件中存在、通讯录中不存在的成员，执行添加操作
        通讯录中存在、文件中不存在的成员，执行删除操作。出于安全考虑，下面两种情形系统将中止导入并返回相应的错误码。
            需要删除的成员多于50人，且多于现有人数的20%以上
            需要删除的成员少于50人，且多于现有人数的80%以上
        成员字段更新规则：可自行添加扩展字段。文件中有指定的字段，以指定的字段值为准；文件中没指定的字段，不更新
     * 
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        media_id        是      上传的csv文件的media_id
        to_invite       否      是否邀请新建的成员使用企业微信（将通过微信服务通知或短信或邮件下发邀请，每天自动下发一次，最多持续3个工作日），默认值为true。
        callback        否      回调信息。如填写该项则任务完成后，通过callback推送事件给企业。具体请参考应用回调模式中的相应选项
        url             否      企业应用接收企业微信推送请求的访问协议和地址，支持http或https协议
        token           否      用于生成签名
        encodingaeskey	否      用于消息体的加密，是AES密钥的Base64编码
     *
     * @example IDE跟踪查看案例
     * 
        {
            "media_id":"xxxxxx",
            "to_invite": true,
            "callback":
            {
                "url": "xxx",
                "token": "xxx",
                "encodingaeskey": "xxx"
            }
        }
     * 
     * @return array
     */
    public function replaceuser(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/replaceuser?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 全量覆盖部门
     * 
     * 本接口以partyid为键，全量覆盖企业的通讯录组织架构，任务完成后企业的通讯录组织架构与提交的文件完全保持一致。请先下载CSV文件(下载全量覆盖部门模版)，根据需求填写文件内容。
     * 
     * @param array $data 全量覆盖部门
     * @info IDE跟踪查看使用说明
     * 
        注意事项：
        文件中存在、通讯录中也存在的部门，执行修改操作
        文件中存在、通讯录中不存在的部门，执行添加操作
        文件中不存在、通讯录中存在的部门，当部门下没有任何成员或子部门时，执行删除操作
        文件中不存在、通讯录中存在的部门，当部门下仍有成员或子部门时，暂时不会删除，当下次导入成员把人从部门移出后自动删除
        CSV文件中，部门名称、部门ID、父部门ID为必填字段，部门ID必须为数字，根部门的部门id默认为1；排序为可选字段，置空或填0不修改排序, order值大的排序靠前。
     * 
     * @uses IDE跟踪查看详细参数
     * 
        参数            必须        说明
        media_id        是      上传的csv文件的media_id
        callback        否      回调信息。如填写该项则任务完成后，通过callback推送事件给企业。具体请参考应用回调模式中的相应选项
        url             否      企业应用接收企业微信推送请求的访问协议和地址，支持http或https协议
        token           否      用于生成签名
        encodingaeskey	否      用于消息体的加密，是AES密钥的Base64编码
     *
     * @example IDE跟踪查看案例
     * 
        {
            "media_id":"xxxxxx",
            "callback":
            {
                "url": "xxx",
                "token": "xxx",
                "encodingaeskey": "xxx"
            }
        }
     * 
     * @return array
     */
    public function replaceparty(array $data): array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/replaceparty?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }
    
    /**
     * 获取异步任务结果
     * @param string $jobid 任务ID
     * @return array
     */
    public function getresult(string $jobid):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/batch/getresult?access_token=ACCESS_TOKEN&jobid={$jobid}";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }
}