<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Group
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:39 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Group extends BaseClient
{
    /**
     * 创建用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function add(string $groupId, array $options = [])
    {
        $data             = array();
        $data['group_id'] = $groupId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/group/add', $data);
    }


    /**
     * 删除用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function delete(string $groupId, array $options = [])
    {
        $data             = array();
        $data['group_id'] = $groupId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/group/delete', $data);
    }

    /**
     * 组列表查询接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     * @throws HttpException
     */
    public function list(array $options = [])
    {
        $data = array();
        $data = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/group/getlist', $data);
    }


    /**
     * 获取用户列表接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     * @throws HttpException
     */
    public function users(string $groupId, array $options = [])
    {
        $data             = array();
        $data['group_id'] = $groupId;
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/face/v3/faceset/group/getusers', $data);
    }
}
