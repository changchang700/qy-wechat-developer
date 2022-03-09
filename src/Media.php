<?php
namespace WorkWeChat;

use WorkWeChat\Contracts\Tools;
use WorkWeChat\Contracts\BasicWorkWeChat;
use WorkWeChat\Exceptions\InvalidArgumentException;

/**
 * 素材管理
 * 
 * Class Media
 * @package WorkWeChat
 */
class Media extends BasicWorkWeChat
{
    /**
     * 上传临时素材
     *
     * @param string $filename 上传文件
     * @param string $type
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90253
     * @return array
     */
    public function upload(string $filename, string $type = 'image'):array
    {
        if (!in_array($type, ['image', 'voice', 'video', 'thumb'])) {
            throw new InvalidArgumentException('Invalid Media Type.', '0');
        }
        $url = "https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type={$type}";
        $this->registerApi($url, __FUNCTION__, func_get_args());

        return $this->httpPostForJson($url, ['media' => Tools::createCurlFile($filename)], false);
    }

    /**
     * 上传图片
     *
     * @param string $filename 图片路径
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90256
     * @return array
     */
    public function uploadImg(string $filename):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/media/uploadimg?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, ['media' => Tools::createCurlFile($filename)], false);
    }

    /**
     * 获取临时素材
     * 
     * @param string $media_id 媒体文件id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90254
     * @return array
     */
    public function list(string $media_id):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID';
        $url = str_replace("MEDIA_ID", $media_id, $url);
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 获取高清语音素材
     * 
     * @param string $media_id 通过JSSDK的uploadVoice接口上传的语音文件id
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/90255
     * @return array
     */
    public function get_jssdk(string $media_id):array
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=ACCESS_TOKEN&media_id=MEDIA_ID';
        $url = str_replace("MEDIA_ID", $media_id, $url);
        $this->registerApi($url, __FUNCTION__,func_get_args());
        return $this->httpGetForJson($url);
    }
}