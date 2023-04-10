<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Kg
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Kg;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Kg extends BaseClient
{
    /**
     * 创建任务 create_task api url
     * @var string
     */
    private string $createTaskUrl = '/rest/2.0/kg/v1/pie/task_create';

    /**
     * 更新任务 update_task api url
     * @var string
     */
    private string  $updateTaskUrl = '/rest/2.0/kg/v1/pie/task_update';

    /**
     * 获取任务详情 task_info api url
     * @var string
     */
    private string $taskInfoUrl = '/rest/2.0/kg/v1/pie/task_info';

    /**
     * 以分页的方式查询当前用户所有的任务信息 task_query api url
     * @var string
     */
    private string $taskQueryUrl = '/rest/2.0/kg/v1/pie/task_query';

    /**
     * 启动任务 task_start api url
     * @var string
     */
    private string $taskStartUrl = '/rest/2.0/kg/v1/pie/task_start';

    /**
     * 查询任务状态 task_status api url
     * @var string
     */
    private string $taskStatusUrl = '/rest/2.0/kg/v1/pie/task_status';


    /**
     * 创建任务接口
     *
     * @param string $name - 任务名字
     * @param string $templateContent - json string 解析模板内容
     * @param string $inputMappingFile - 抓取结果映射文件的路径
     * @param string $outputFile - 输出文件名字
     * @param string $urlPattern - url pattern
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   limit_count 限制解析数量limit_count为0时进行全量任务，limit_count&gt;0时只解析limit_count数量的页面
     * @return array
     * @throws HttpException
     */
    public function createTask(string $name, string $templateContent, string $inputMappingFile, string $outputFile, string $urlPattern, array $options = [])
    {
        $data                       = [];
        $data['name']               = $name;
        $data['template_content']   = $templateContent;
        $data['input_mapping_file'] = $inputMappingFile;
        $data['output_file']        = $outputFile;
        $data['url_pattern']        = $urlPattern;
        $data                       = array_merge($data, $options);
        return $this->request($this->createTaskUrl, $data);
    }

    /**
     * 更新任务接口
     *
     * @param integer $id - 任务ID
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   name 任务名字
     *   template_content json string 解析模板内容
     *   input_mapping_file 抓取结果映射文件的路径
     *   url_pattern url pattern
     *   output_file 输出文件名字
     * @return array
     * @throws HttpException
     */
    public function updateTask(int $id, array $options = [])
    {
        $data       = [];
        $data['id'] = $id;
        $data       = array_merge($data, $options);
        return $this->request($this->updateTaskUrl, $data);
    }

    /**
     * 获取任务详情接口
     *
     * @param integer $id - 任务ID
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function getTaskInfo(int $id, array $options = [])
    {
        $data       = [];
        $data['id'] = $id;
        $data       = array_merge($data, $options);
        return $this->request($this->taskInfoUrl, $data);
    }

    /**
     * 以分页的方式查询当前用户所有的任务信息接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   id 任务ID，精确匹配
     *   name 中缀模糊匹配,abc可以匹配abc,aaabc,abcde等
     *   status 要筛选的任务状态
     *   page 页码
     *   per_page 页码
     * @return array
     * @throws HttpException
     */
    public function getUserTasks(array $options = [])
    {
        $data = [];
        $data = array_merge($data, $options);
        return $this->request($this->taskQueryUrl, $data);
    }

    /**
     * 启动任务接口
     *
     * @param integer $id - 任务ID
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function startTask(int $id, array $options = [])
    {
        $data       = [];
        $data['id'] = $id;
        $data       = array_merge($data, $options);
        return $this->request($this->taskStartUrl, $data);
    }

    /**
     * 查询任务状态接口
     *
     * @param integer $id - 任务ID
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function getTaskStatus(int $id, array $options = [])
    {
        $data       = [];
        $data['id'] = $id;
        $data       = array_merge($data, $options);
        return $this->request($this->taskStatusUrl, $data);
    }
}
