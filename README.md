# hyperf-baidu
a baidu open platform component for hyperf

## 依赖环境

- PHP >= 7.1 (推荐使用 PHP >= 7.2)
- [composer](https://getcomposer.org/)
- [swoole](https://github.com/swoole/swoole-src) 扩展 >= 4.4.19 (推荐使用 Swoole >= 4.4.23)
- openssl 扩展

## 安装

```shell
$ composer require jiahetian/hyperf-baidu
```

## 介绍
百度ai相关API封装 (https://ai.baidu.com/ai-doc)


> censor
[图像审核服务](https://ai.baidu.com/ai-doc/ANTIPORN/)，对应百度AI开放平台中视觉技术的 图像审核 API

> classify
[图像识别服务](https://ai.baidu.com/ai-doc/IMAGERECOGNITION/)，对应百度AI开放平台中视觉技术的 图像识别 API

> process
[图像效果增强服务](https://ai.baidu.com/ai-doc/IMAGEPROCESS/)，对应百度AI开放平台中视觉技术的 图像效果增强 API

> body
[人体分析服务](https://ai.baidu.com/ai-doc/BODY/)，对应百度AI开放平台中视觉技术的 人体分析 API

> face
[人脸识别服务](https://ai.baidu.com/ai-doc/FACE/)，对应百度AI开放平台中视觉技术的 人脸识别 API

> ocr
[文字识别服务](https://ai.baidu.com/ai-doc/OCR/)，对应百度AI开放平台中视觉技术的 文字识别 API

> nlp
[自然语言处理服务](https://ai.baidu.com/ai-doc/NLP/)，对应百度AI开放平台中的 自然语言 API

> speech
[自然语言处理服务](https://ai.baidu.com/ai-doc/SPEECH/)，对应百度AI开放平台中的 百度语音 API


## 使用

### swoole协程版
```php
<?php
declare(strict_types=1);
include_once __DIR__ . "/vendor/autoload.php";

go(function () {
    $config = [
        'client_id'     => 'client_id',  // 应用ID
        'client_secret' => 'client_secret', // 应用密钥
        "debug"         => true, // http调用异常会记录文件
        "log"           => [     
            'tempDir' => __DIR__ // 日志存放路径
        ],
        "cache"         => [
            'tempDir' => __DIR__, // access_token存放路径
        ],
        "request"       => [
            "timeout"          => 5 // 请求超时时间
        ]
    ];
    try {
        $ocr = \Jiahetian\HyperfBaidu\Factory::ocr($config);
        // cache rebind ，默认：文件存储
        $ocr->rebind(\Jiahetian\HyperfBaidu\Kernel\ServiceProviders::Cache, new \Jiahetian\HyperfBaidu\AccessTokenCache());
        var_dump($ocr->ocr->businessCardUrl("https://xxxxx"));
    } catch (\Exception $e) {
        var_dump($e->getMessage(), $e->getCode());
    }
});
```

### curl版

```php
<?php
declare(strict_types=1);
include_once __DIR__ . "/vendor/autoload.php";

$config = [
    'client_id'     => 'client_id',  // 应用ID
    'client_secret' => 'client_secret', // 应用密钥
    "debug"         => true, // http调用异常会记录文件
    "log"           => [     
        'tempDir' => __DIR__ // 日志存放路径
    ],
    "cache"         => [
        'tempDir' => __DIR__, // access_token存放路径
    ],
    "request"       => [
        "httpClientDriver" => \Jiahetian\HyperfBaidu\Kernel\HttpClient\CurlClientDriver::class,
        "timeout"          => 5 // 请求超时时间
    ]
];
try {
    $ocr = \Jiahetian\HyperfBaidu\Factory::ocr($config);
    // cache rebind ，默认：文件存储
    $ocr->rebind(\Jiahetian\HyperfBaidu\Kernel\ServiceProviders::Cache, new \Jiahetian\HyperfBaidu\AccessTokenCache());
    var_dump($ocr->ocr->businessCardUrl("https://xxxxx"));
} catch (\Exception $e) {
    var_dump($e->getMessage(), $e->getCode());
}

```


AccessTokenCache.php
```php
<?php

declare(strict_types=1);

namespace Jiahetian\HyperfBaidu;

use Psr\SimpleCache\CacheInterface;

class AccessTokenCache implements CacheInterface
{
    public function get($key, $default = null)
    {
        // $redis client
        return $redis->get($key);
    }

    public function set($key, $value, $ttl = null)
    {
        // $redis client
        return $redis->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        // $redis client
        return $redis->del($key);
    }

    public function clear()
    {
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function has($key)
    {
        // $redis client
        return $redis->exists($key);
    }
}

```


## 人脸识别

### 人脸
```php
$config = [];
$face = \Jiahetian\HyperfBaidu\Factory::face($config);
//人脸检测
$face->face->detect();
//在线活体检测
$face->face->faceVerify();
//人脸特征抽取同步接口
$face->face->feature();
//人脸比对
$face->face->match();
//人脸搜索 M:N 识别接口
$face->face->multiSearch();
//人脸搜索接口
$face->face->search();
```

### 组
```php
$config = [];
$face = \Jiahetian\HyperfBaidu\Factory::face($config);
//添加
$face->group->add();
//删除
$face->group->delete();
//列表
$face->group->list();
//组用户 
$face->group->users();
```

### 用户
```php
$config = [];
$face = \Jiahetian\HyperfBaidu\Factory::face($config);
//添加
$face->user->add();
//更新
$face->user->update();
//删除
$face->user->delete();
//拷贝
$face->user->copy();
//获取用户
$face->user->get();
//脸列表
$face->user->faceList();
//脸删除
$face->user->faceDelete();
```

### 其他
```php
$config = [];
$face = \Jiahetian\HyperfBaidu\Factory::face($config);
//身份验证接口
$face->other->personVerify();
//语音校验码接口
$face->other->videoSessionCode();
```

## ImageClassify

```php
$config = [];
$image = \Jiahetian\HyperfBaidu\Factory::image($config);
//通用物体识别接口
$image->classify->advancedGeneral();
//菜品识别接口
$image->classify->dishDetect();
//车辆识别接口
$image->classify->carDetect();
//车辆检测接口
$image->classify->vehicleDetect();

// 具体查看现实类中的方法...
```

## 内容审核

```php
$config = [];
$image = \Jiahetian\HyperfBaidu\Factory::image($config);
//图像审核
$image->censor->imageCensorUserDefined();
//图像地址审核
$image->censor->imageUrlCensorUserDefined();
//文本审核
$image->censor->textCensorUserDefined();
//语音审核
$image->censor->voiceCensorUserDefined();
//语音地址审核
$image->censor->voiceUrlCensorUserDefined();
//视频审核
$image->censor->videoCensorUserDefined();
```

## OCR

```php
$config = [];
$ocr = \Jiahetian\HyperfBaidu\Factory::ocr($config);
//通用文字识别接口
$ocr->ocr->generalBasic();
//通用文字识别（含位置高精度版）接口
$ocr->ocr->accurate();
//通用文字识别（高精度版）接口
$ocr->ocr->accurateBasic();

// 具体查看现实类中的方法...
```

## 语音识别

```php
$config = [];
$speech = \Jiahetian\HyperfBaidu\Factory::speech($config);
//语音识别
$speech->speech->asr();
```

## 人体分析

```php
$config = [];
$body = \Jiahetian\HyperfBaidu\Factory::body($config);
//人体关键点识别接口
$body->body->bodyAnalysis();
//人体检测与属性识别接口
$body->body->bodyAttr();
//人流量统计接口
$body->body->bodyNum();
//手势识别接口
$body->body->gesture();
//人像分割接口
$body->body->bodySeg();
//驾驶行为分析接口
$body->body->driverBehavior();
//人流量统计-动态版接口
$body->body->bodyTracking();
//手部关键点识别接口
$body->body->handAnalysis();
```

## Kg

```php
$config = [];
$kg = \Jiahetian\HyperfBaidu\Factory::kg($config);
//创建任务接口
$kg->kg->createTask();
//更新任务接口
$kg->kg->updateTask();
//获取任务详情接口
$kg->kg->getTaskInfo();
//以分页的方式查询当前用户所有的任务信息接口
$kg->kg->getUserTasks();
//启动任务接口
$kg->kg->startTask();
//查询任务状态接口
$kg->kg->getTaskStatus();
```

## process
```php
$config = [];
$image = \Jiahetian\HyperfBaidu\Factory::image($config);
// 图像无损放大接口
$image->process->imageQualityEnhance();
// 图像去雾接口
$image->process->dehaze();
// 图像对比度增强接口
$image->process->contrastEnhance();
// 拉伸图像恢复接口
$image->process->stretchRestore();
// 人像动漫化
$image->process->selfieAnime();
// 图像清晰度增强
$image->process->imageDefinitionEnhance();
// 图像风格转换
$image->process->styleTrans();
// 天空分割
$image->process->skySeg();
// 图像修复
$image->process->inPaintingByMask();
```