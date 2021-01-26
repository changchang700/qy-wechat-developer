<?php
/**
 * 电子发票管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 电子发票管理
 * Class card
 * @package WorkWeChat
 */
class Card extends BasicWorkWeChat
{
    /**
     * 查询电子发票
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        card_id	        是	    发票id
        encrypt_code	是	    加密code
     *
     * @example IDE跟踪查看案例
     *
        {
            "card_id":"CARDID" ,
            "encrypt_code":"ENCRYPTCODE"
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function invoice_reimburse_getinvoiceinfo(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/getinvoiceinfo?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 更新发票状态
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	                必须	    说明
        access_token	    是	    调用接口凭证
        card_id	            是	    发票id
        encrypt_code	    是	    加密code
        reimburse_status	是	    发报销状态 INVOICE_REIMBURSE_INIT：发票初始状态，未锁定；INVOICE_REIMBURSE_LOCK：发票已锁定，无法重复提交报销;INVOICE_REIMBURSE_CLOSURE:发票已核销，从用户卡包中移除
     *
     * @example IDE跟踪查看案例
     *
        {
            "card_id":"CARDID" ,
            "encrypt_code":"ENCRYPTCODE",
            "reimburse_status":"INVOICE_REIMBURSE_INIT"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function invoice_reimburse_updateinvoicestatus(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/updateinvoicestatus?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 批量更新发票状态
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	                必须	    说明
        access_token	    是	    调用接口凭证
        openid	            是	    用户openid，可用“userid与openid互换接口”获取
        reimburse_status    是	    发票报销状态 INVOICE_REIMBURSE_INIT：发票初始状态，未锁定；INVOICE_REIMBURSE_LOCK：发票已锁定，无法重复提交报销;INVOICE_REIMBURSE_CLOSURE:发票已核销，从用户卡包中移除
        invoice_list	    是	    发票列表，必须全部属于同一个openid
        card_id	            是	    发票卡券的card_id
        encrypt_code	    是	    发票卡券的加密code，和card_id共同构成一张发票卡券的唯一标识
     *
     * @example IDE跟踪查看案例
     *
        {
            "openid":"OPENID" ,
            "reimburse_status":"INVOICE_REIMBURSE_INIT",
            "invoice_list":
            [
                {"card_id":"cardid_1","encrypt_code":"encrypt_code_1"},
                {"card_id":"cardid_2","encrypt_code":"encrypt_code_2"}
            ]
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function invoice_reimburse_updatestatusbatch(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/updatestatusbatch?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 批量查询电子发票
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	            必须	    说明
        access_token	是	    调用接口凭证
        item_list	    是	    发票列表
        card_id	        是	    发票id
        encrypt_code	是	    加密code
     *
     * @example IDE跟踪查看案例
     *
        {
            "item_list": [
                {
                    "card_id":"CARDID1" ,
                    "encrypt_code":"ENCRYPTCODE1"
                },
                {
                    "card_id":"CARDID2" ,
                    "encrypt_code":"ENCRYPTCODE2"
                }
            ]
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function invoice_reimburse_getinvoiceinfobatch(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/getinvoiceinfobatch?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

}