<?php
/**
 * @Author: gan
 * @Description:内容审核
 * @File:  Censor
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Image;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Censor extends BaseClient
{
    /**
     * 图像审核
     * @param string $image 图像
     * @return array
     * @throws HttpException
     */
    public function imageCensorUserDefined(string $image)
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        return $this->request('/rest/2.0/solution/v1/img_censor/v2/user_defined', $data);
    }

    /**
     * 图像地址审核
     * @param string $url 图像地址
     * @return array
     * @throws HttpException
     */
    public function imageUrlCensorUserDefined(string $url)
    {
        $data           = [];
        $data['imgUrl'] = $url;
        return $this->request('/rest/2.0/solution/v1/img_censor/v2/user_defined', $data);
    }

    /**
     * 文本审核
     * @param string $text
     * @return array
     * @throws HttpException
     */
    public function textCensorUserDefined(string $text)
    {
        $data         = [];
        $data['text'] = $text;
        return $this->request('/rest/2.0/solution/v1/text_censor/v2/user_defined', $data);
    }

    /**
     * 语音审核
     * @param string $voice
     * @param string $rate
     * @param string $fmt
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function voiceCensorUserDefined(string $voice, string $rate, string $fmt, array $options = [])
    {
        $data           = [];
        $data['base64'] = base64_encode($voice);
        $data['fmt']    = $fmt;
        $data['rate']   = $rate;
        $data           = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/voice_censor/v3/user_defined', $data);
    }

    /**
     * 语音地址审核
     * @param string $url
     * @param string $rate
     * @param string $fmt
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function voiceUrlCensorUserDefined(string $url, string $rate, string $fmt, array $options = [])
    {
        $data         = [];
        $data['url']  = $url;
        $data['fmt']  = $fmt;
        $data['rate'] = $rate;
        $data         = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/voice_censor/v3/user_defined', $data);
    }

    /**
     * 视频审核
     * @param string $name
     * @param string $videoUrl
     * @param string $extId
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function videoCensorUserDefined(string $name, string $videoUrl, string $extId, array $options = [])
    {
        $data             = [];
        $data['name']     = $name;
        $data['videoUrl'] = $videoUrl;
        $data['extId']    = $extId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/video_censor/v2/user_defined', $data);
    }
}
