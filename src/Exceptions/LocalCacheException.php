<?php
namespace WorkWeChat\Exceptions;

/***
 * 本地缓存异常
 * Class LocalCacheException
 * @package WeChat
 */
class LocalCacheException extends \Exception
{

    /**
     * @var array
     */
    public $raw = [];

    /**
     * LocalCacheException constructor.
     * @param string $message
     * @param integer $code
     * @param array $raw
     */
    public function __construct($message, $code = 0, $raw = [])
    {
        parent::__construct($message, intval($code));
        $this->raw = $raw;
    }

}