<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Other
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Other extends BaseClient
{
    /**
     * 身份验证接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $idCardNumber - 身份证号（真实身份证号号码）
     * @param string $name - utf8，姓名（真实姓名，和身份证号匹配）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     * @return array
     * @throws HttpException
     */
    public function personVerify(string $image, string $imageType, string $idCardNumber, string $name, array $options = [])
    {
        $data                   = array();
        $data['image']          = $image;
        $data['image_type']     = $imageType;
        $data['id_card_number'] = $idCardNumber;
        $data['name']           = $name;
        $data                   = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/person/verify', $data);
    }

    /**
     * 语音校验码接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   appid 百度云创建应用时的唯一标识ID
     * @return array
     * @throws HttpException
     */
    public function videoSessionCode(array $options = [])
    {
        $data = array();
        $data = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v1/faceliveness/sessioncode', $data);
    }
}
