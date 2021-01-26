<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/1/25
 * Time: 14:50
 */

namespace WorkWeChat;


use WorkWeChat\Contracts\BasicWorkWeChat;
use WorkWeChat\Contracts\Tools;

/**
 * 素材
 * Class Media
 * @package WorkWeChat
 */
class Media extends BasicWorkWeChat
{
    /**
     * 上传素材
     * @param $filename
     * @param string $type
     * @param array $description
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function addMaterial($filename, $type = 'image', $description = [])
    {
        if (!in_array($type, ['image', 'voice', 'video', 'thumb'])) {
            throw new InvalidResponseException('Invalid Media Type.', '0');
        }
        $url = "https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type={$type}";
        $this->registerApi($url, __FUNCTION__, func_get_args());

        return $this->httpPostForJson($url, ['media' => $this->getCurlFile($filename), 'description' => Tools::arr2json($description)], false);
    }

    /**
     * 获取素材链接
     * @param string $media_id
     * @return string
     */
    public function getMaterial(string $media_id)
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID';
        return str_replace(['ACCESS_TOKEN','MEDIA_ID'], [$this->getAccessToken(), $media_id], $url);
    }
}