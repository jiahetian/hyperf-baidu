<?php
/**
 * @Author: gan
 * @Description:
 * @File:  User
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:40 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class User extends BaseClient
{
    /**
     * 人脸注册接口
     *
     * @param string $image - 图片信息(总数据大小应小于10M)，图片上传方式根据image_type来判断。注：组内每个uid下的人脸图片数目上限为20张
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   action_type 操作方式  APPEND: 当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE : 当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     * @throws HttpException
     */
    public function add(string $image, string $imageType, string $groupId, string $userId, array $options = [])
    {
        $data               = [];
        $data['image']      = $image;
        $data['image_type'] = $imageType;
        $data['group_id']   = $groupId;
        $data['user_id']    = $userId;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/user/add', $data);
    }


    /**
     * 人脸更新接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupId - 更新指定groupid下uid对应的信息
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   action_type 操作方式  APPEND: 当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE : 当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     * @throws HttpException
     */
    public function update(string $image, string $imageType, string $groupId, string $userId, array $options = [])
    {
        $data               = [];
        $data['image']      = $image;
        $data['image_type'] = $imageType;
        $data['group_id']   = $groupId;
        $data['user_id']    = $userId;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/user/update', $data);
    }


    /**
     * 用户信息查询接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function get(string $userId, string $groupId, array $options = [])
    {
        $data             = [];
        $data['user_id']  = $userId;
        $data['group_id'] = $groupId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/user/get', $data);
    }


    /**
     * 复制用户接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   src_group_id 从指定组里复制信息
     *   dst_group_id 需要添加用户的组id
     * @return array
     * @throws HttpException
     */
    public function copy(string $userId, array $options = [])
    {
        $data            = [];
        $data['user_id'] = $userId;
        $data            = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/user/copy', $data);
    }


    /**
     * 删除用户接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function delete(string $groupId, string $userId, array $options = [])
    {
        $data             = [];
        $data['group_id'] = $groupId;
        $data['user_id']  = $userId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/user/delete', $data);
    }

    /**
     * 人脸删除接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $faceToken - 需要删除的人脸图片token，（由数字、字母、下划线组成）长度限制64B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function faceDelete(string $userId, string $groupId, string $faceToken, array $options = [])
    {
        $data               = [];
        $data['user_id']    = $userId;
        $data['group_id']   = $groupId;
        $data['face_token'] = $faceToken;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/face/delete', $data);
    }


    /**
     * 获取用户人脸列表接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function faceList(string $userId, string $groupId, array $options = [])
    {
        $data             = [];
        $data['user_id']  = $userId;
        $data['group_id'] = $groupId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/face/getlist', $data);
    }
}
