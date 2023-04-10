<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Face
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:39 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Face extends BaseClient
{
    /**
     * 人脸检测接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   face_field 包括**age,beauty,expression,face_shape,gender,glasses,landmark,landmark72，landmark150，race,quality,eye_status,emotion,face_type信息**  <br> 逗号分隔. 默认只返回face_token、人脸框、概率和旋转角度
     *   max_face_num 最多处理人脸的数目，默认值为1，仅检测图片中面积最大的那个人脸；**最大值10**，检测图片中面积最大的几张人脸。
     *   face_type 人脸的类型 **LIVE**表示生活照：通常为手机、相机拍摄的人像图片、或从网络获取的人像图片等**IDCARD**表示身份证芯片照：二代身份证内置芯片中的人像照片 **WATERMARK**表示带水印证件照：一般为带水印的小图，如公安网小图 **CERT**表示证件照片：如拍摄的身份证、工卡、护照、学生证等证件图片 默认**LIVE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     * @return array
     * @throws HttpException
     */
    public function detect(string $image, string $imageType, array $options = [])
    {
        $data               = array();
        $data['image']      = $image;
        $data['image_type'] = $imageType;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/detect', $data);
    }


    /**
     * 人脸特征抽取同步接口
     * @param string $image 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function feature(string $image, string $imageType, array $options = [])
    {
        $data               = array();
        $data['image']      = $image;
        $data['image_type'] = $imageType;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v1/feature', $data);
    }


    /**
     * 人脸搜索接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupIdList - 从指定的group中进行查找 用逗号分隔，**上限20个**
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   max_face_num 最多处理人脸的数目<br>**默认值为1(仅检测图片中面积最大的那个人脸)** **最大值10**
     *   match_threshold 匹配阈值（设置阈值后，score低于此阈值的用户信息将不会返回） 最大100 最小0 默认80 <br>**此阈值设置得越高，检索速度将会越快，推荐使用默认阈值`80`**
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   user_id 当需要对特定用户进行比对时，指定user_id进行比对。即人脸认证功能。
     *   max_user_num 查找后返回的用户数量。返回相似度最高的几个用户，默认为1，最多返回50个。
     * @return array
     * @throws HttpException
     */
    public function search(string $image, string $imageType, string $groupIdList, array $options = [])
    {
        $data                  = array();
        $data['image']         = $image;
        $data['image_type']    = $imageType;
        $data['group_id_list'] = $groupIdList;
        $data                  = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/search', $data);
    }


    /**
     * 人脸搜索 M:N 识别接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupIdList - 从指定的group中进行查找 用逗号分隔，**上限20个**
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   max_face_num 最多处理人脸的数目<br>**默认值为1(仅检测图片中面积最大的那个人脸)** **最大值10**
     *   match_threshold 匹配阈值（设置阈值后，score低于此阈值的用户信息将不会返回） 最大100 最小0 默认80 <br>**此阈值设置得越高，检索速度将会越快，推荐使用默认阈值`80`**
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   max_user_num 查找后返回的用户数量。返回相似度最高的几个用户，默认为1，最多返回50个。
     * @return array
     * @throws HttpException
     */
    public function multiSearch(string $image, string $imageType, string $groupIdList, array $options = [])
    {
        $data                  = array();
        $data['image']         = $image;
        $data['image_type']    = $imageType;
        $data['group_id_list'] = $groupIdList;
        $data                  = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/multi-search', $data);
    }

    /**
     * 在线活体检测
     * @param array $data
     * @return array
     * @throws HttpException
     */
    public function faceVerify(array $data)
    {
        return $this->request('/face/v3/faceverify', $data);
    }


    /**
     * 人脸比对
     * @param array $data
     * @return array
     * @throws HttpException
     */
    public function match(array $data)
    {
        return $this->request('/rest/2.0/face/v3/match', $data);
    }
}
