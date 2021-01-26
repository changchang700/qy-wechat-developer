<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/22
 * Time: 18:18
 */

namespace WorkWeChat\Contracts;

/**
 * 用户服务合约
 * Interface UserServiceContracts
 * @package WorkWeChat\Contracts
 */
interface UserServiceContracts
{
    /**
     * 用户信息
     * @return array
     */
    public function userInfo():array;

    /**
     * 不支持给非实名用户打款
     * @return bool
     */
    public function checkId():bool;

    /**
     * 每个用户每天最多可付款10次，可以在商户平台—API安全进行设置
     * @return bool
     */
    public function dayTimesLimits():bool;

    /**
     * 一个商户同一日付款总额限额10W
     * @return bool
     */
    public function dayAmountLimits():bool;

    /**
     * 单笔金额
     * @return bool
     */
    public function perAmount():bool;

    /**
     * 给同一个实名用户付款，单笔单日限额5000/5000
     */
    public function count():bool;

    /**
     * 同一个用户付款时间间隔不得低于15秒
     * @return bool
     */
    public function perTime():bool;
}