<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Classify
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Image;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Classify extends BaseClient
{
    /**
     * 通用物体识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function advancedGeneral(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request("/rest/2.0/image-classify/v2/advanced_general", $data);
    }


    /**
     * 菜品识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   filter_threshold 默认0.95，可以通过该参数调节识别效果，降低非菜识别率.
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function dishDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request("/rest/2.0/image-classify/v2/dish", $data);
    }

    /**
     * 车辆识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function carDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request("/rest/2.0/image-classify/v1/car", $data);
    }

    /**
     * 车辆检测接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   show 是否返回结果图（含统计值和跟踪框）。选true时返回渲染后的图片(base64)，其它无效值或为空则默认false。
     *   area 只统计该区域内的车辆数，缺省时为全图统计。<br>逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合多边形区域。<br>服务会做范围（顶点左边需在图像范围内）及个数校验（数组长度必须为偶数，且大于3个顶点）。只支持单个多边形区域，建议设置矩形框，即4个顶点。**坐标取值不能超过图像宽度和高度，比如1280的宽度，坐标值最大到1279**。
     * @return array
     * @throws HttpException
     */
    public function vehicleDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request("/rest/2.0/image-classify/v1/vehicle_detect", $data);
    }

    /**
     * 车辆外观损伤识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vehicleDamage(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/vehicle_damage', $data);
    }

    /**
     * logo商标识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   custom_lib 是否只使用自定义logo库的结果，默认false：返回自定义库+默认库的识别结果
     * @return array
     * @throws HttpException
     */
    public function logoSearch(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v2/logo', $data);
    }

    /**
     * logo商标识别—添加接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief - brief，检索时带回。此处要传对应的name与code字段，name长度小于100B，code长度小于150B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function logoAdd(string $image, string $brief, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/realtime_search/v1/logo/add', $data);
    }

    /**
     * logo商标识别—删除接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function logoDeleteByImage(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request("/rest/2.0/realtime_search/v1/logo/delete", $data);
    }

    /**
     * logo商标识别—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function logoDeleteBySign(string $contSign, array $options = [])
    {
        $data              = [];
        $data['cont_sign'] = $contSign;
        $data              = array_merge($data, $options);
        return $this->request('/rest/2.0/realtime_search/v1/logo/delete', $data);
    }

    /**
     * 动物识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为6
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function animalDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/animal', $data);
    }

    /**
     * 植物识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function plantDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/plant', $data);
    }

    /**
     * 图像主体检测接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   with_face 如果检测主体是人，主体区域是否带上人脸部分，0-不带人脸区域，其他-带人脸区域，裁剪类需求推荐带人脸，检索/识别类需求推荐不带人脸。默认取1，带人脸。
     * @return array
     * @throws HttpException
     */
    public function objectDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/object_detect', $data);
    }

    /**
     * 地标识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function landmark(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/landmark', $data);
    }

    /**
     * 花卉识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function flower(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/flower', $data);
    }

    /**
     * 食材识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回预测得分top结果数，如果为空或小于等于0默认为5；如果大于20默认20
     * @return array
     * @throws HttpException
     */
    public function ingredient(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/classify/ingredient', $data);
    }

    /**
     * 红酒识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function redWine(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/redwine', $data);
    }

    /**
     * 货币识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function currency(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/currency', $data);
    }

    /**
     * 自定义菜品识别—入库
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param $brief
     * @param array $options - 可选参数对象，key: value都为string类型
     * @return array
     * @description options列表:
     * @throws HttpException
     */
    public function customDishesAddImage(string $image, string $brief, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/realtime_search/dish/add', $data);
    }


    /**
     * 自定义菜品识别—检索
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function customDishesSearch(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/realtime_search/dish/search', $data);
    }

    /**
     * 自定义菜品识别—删除
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function customDishesDeleteImage(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/realtime_search/dish/delete', $data);
    }


    /**
     * 自定义菜品识别—删除
     *
     * @param string $contSign
     * @param array $options - 可选参数对象，key: value都为string类型
     * @return array
     * @description options列表:
     * @throws HttpException
     */
    public function customDishesDeleteContSign(string $contSign, $options = [])
    {
        $data              = [];
        $data['cont_sign'] = $contSign;
        $data              = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/realtime_search/dish/delete', $data);
    }


    /**
     * 图像多主体检测
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function multiObjectDetect(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/image-classify/v1/multi_object_detect', $data);
    }


    /**
     * 组合接口-image
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param $scenes
     * @param array $options - 可选参数对象，key: value都为string类型
     * @return array
     * @description options列表:
     * @throws HttpException
     */
    public function combinationByImage(string $image, string $scenes, array $options = [])
    {
        $data           = [];
        $data['image']  = base64_encode($image);
        $data['scenes'] = $scenes;
        $data           = array_merge($data, $options);
        return $this->request('/api/v1/solution/direct/imagerecognition/combination', $data);
    }


    /**
     * 组合接口-imageUrl
     *
     * @param string $imageUrl
     * @param string $scenes
     * @param array $options - 可选参数对象，key: value都为string类型
     * @return array
     * @description options列表:
     * @throws HttpException
     */
    public function combinationByImageUrl(string $imageUrl, string $scenes, array $options = [])
    {
        $data           = [];
        $data['imgUrl'] = $imageUrl;
        $data['scenes'] = $scenes;
        $data           = array_merge($data, $options);
        return $this->request('/api/v1/solution/direct/imagerecognition/combination', $data);
    }


    /**
     * 车辆属性识别
     * 传入单帧图像，检测图片中所有车辆，返回每辆车的类型和坐标位置，可识别小汽车、卡车、巴士、摩托车、三轮车、自行车6大类车辆，
     *
     * @param string $image 二进制图像数据
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type 是否选定某些属性输出对应的信息，可从12种输出属性中任选若干，用英文逗号分隔（例如vehicle_type,roof_rack,skylight）。默认输出全部属性
     * @return array
     * @throws HttpException
     */
    public function vehicleAttr(string $image, array $options = [])
    {
        $data          = [];
        $data          = array_merge($data, $options);
        $data['image'] = base64_encode($image);
        return $this->request('/rest/2.0/image-classify/v1/vehicle_attr', $data);
    }


    /**
     * 车辆属性识别
     * 传入单帧图像，检测图片中所有车辆，返回每辆车的类型和坐标位置，可识别小汽车、卡车、巴士、摩托车、三轮车、自行车6大类车辆，
     *
     * @param string $url 图片完整URL
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type 是否选定某些属性输出对应的信息，可从12种输出属性中任选若干，用英文逗号分隔（例如vehicle_type,roof_rack,skylight）。默认输出全部属性
     * @return array
     * @throws HttpException
     */
    public function vehicleAttrUrl(string $url, array $options = [])
    {
        $data        = [];
        $data        = array_merge($data, $options);
        $data['url'] = $url;
        return $this->request('/rest/2.0/image-classify/v1/vehicle_attr', $data);
    }


    /**
     * 车辆检测-高空版
     * 面向高空拍摄视角（30米以上），传入单帧图像，检测图片中所有车辆，返回每辆车的坐标位置（不区分车辆类型），并进行车辆计数，支持指定矩形区域的车辆检测与数量统计。
     *
     * @param string $image 二进制图像数据
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   area 只统计该矩形区域内的车辆数，缺省时为全图统计。逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合矩形区域。
     * @return array
     * @throws HttpException
     */
    public function vehicleDetectHigh(string $image, array $options = [])
    {
        $data          = [];
        $data          = array_merge($data, $options);
        $data['image'] = base64_encode($image);
        return $this->request('/rest/2.0/image-classify/v1/vehicle_detect_high', $data);
    }


    /**
     * 车辆检测-高空版
     * 面向高空拍摄视角（30米以上），传入单帧图像，检测图片中所有车辆，返回每辆车的坐标位置（不区分车辆类型），并进行车辆计数，支持指定矩形区域的车辆检测与数量统计。
     *
     * @param string $url 图片完整URL
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   area 只统计该矩形区域内的车辆数，缺省时为全图统计。逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合矩形区域。
     * @return array
     * @throws HttpException
     */
    public function vehicleDetectHighUrl(string $url, array $options = [])
    {
        $data        = [];
        $data        = array_merge($data, $options);
        $data['url'] = $url;
        return $this->request('/rest/2.0/image-classify/v1/vehicle_detect_high', $data);
    }


    /**
     * 车型识别
     * 识别图片中车辆的具体车型，可识别常见的3000+款车型（小汽车为主），输出车辆的品牌型号、颜色、年份、位置信息；支持返回对应识别结果的百度百科词条信息，包含词条名称、百科页面链接、百科图片链接、百科内容简介。
     *
     * @param string $url 图片完整URL
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回结果top n，默认5。e
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     * @throws HttpException
     */
    public function carDetectUrl(string $url, array $options = [])
    {
        $data        = [];
        $data        = array_merge($data, $options);
        $data['url'] = $url;
        return $this->request('/rest/2.0/image-classify/v1/car', $data);
    }


    /**
     * 车辆检测
     * 入单帧图像，检测图片中所有机动车辆，返回每辆车的类型和坐标位置，可识别小汽车、卡车、巴士、摩托车、三轮车5类车辆，并对每类车辆分别计数，同时可定位小汽车、卡车、巴士的车牌位置，支持指定矩形区域的车辆检测与数量统计
     *
     * @param string $url 图片完整URL
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   area 只统计该矩形区域内的车辆数，缺省时为全图统计。逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合矩形区域。
     * @return array
     * @throws HttpException
     */
    public function vehicleDetectUrl(string $url, array $options = [])
    {
        $data        = [];
        $data        = array_merge($data, $options);
        $data['url'] = $url;
        return $this->request("/rest/2.0/image-classify/v1/vehicle_detect", $data);
    }


    /**
     * 车辆分割
     * 传入单帧图像，检测图像中的车辆，以小汽车为主，识别车辆的轮廓范围，与背景进行分离，返回分割后的二值图、灰度图，支持多个车辆、车门打开、后备箱打开、机盖打开、正面、侧面、背面等各种拍摄场景。
     *
     * @param string $image 二进制图像数据
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type 可以通过设置type参数，自主设置返回哪些结果图，避免造成带宽的浪费。1）可选值说明：labelmap - 二值图像，需二次处理方能查看分割效果scoremap - 车辆前景灰度图2）type 参数值可以是可选值的组合，用逗号分隔；如果无此参数默认输出全部3类结果图
     * @return array
     * @throws HttpException
     */
    public function vehicleSeg(string $image, array $options = [])
    {
        $data          = [];
        $data          = array_merge($data, $options);
        $data['image'] = base64_encode($image);
        return $this->request('/rest/2.0/image-classify/v1/vehicle_seg', $data);
    }


    /**
     * 车流统计
     * 根据传入的连续视频图片序列，进行车辆检测和追踪，返回每个车辆的坐标位置、车辆类型（包括小汽车、卡车、巴士、摩托车、三轮车5类）。在原图中指定区域，根据车辆轨迹判断驶入/驶出区域的行为，统计各类车辆的区域进出车流量，可返回含统计值和跟踪框的渲染图。
     *
     * @param string $url 图像地址
     * @param int $caseId 任务ID（通过case_id区分不同视频流，自拟，不同序列间不可重复）
     * @param bool $caseInit 每个case的初始化信号，为true时对该case下的跟踪算法进行初始化，为false时重载该case的跟踪状态。当为false且读取不到相应case的信息时，直接重新初始化
     * @param string $area 只统计进出该区域的车辆。逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合多边形区域。
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   show 是否返回结果图（含统计值和跟踪框）。选true时返回渲染后的图片(base64)，其它无效值或为空则默认false。
     * @return array
     * @throws HttpException
     */
    public function trafficFlow(string $url, int $caseId, bool $caseInit, string $area, array $options = [])
    {
        $data              = [];
        $data              = array_merge($data, $options);
        $data['url']       = $url;
        $data['case_id']   = $caseId;
        $data['case_init'] = $caseInit;
        $data['area']      = $area;
        return $this->request('/rest/2.0/image-classify/v1/traffic_flow', $data);
    }


    /**
     * 车流统计
     * 根据传入的连续视频图片序列，进行车辆检测和追踪，返回每个车辆的坐标位置、车辆类型（包括小汽车、卡车、巴士、摩托车、三轮车5类）。在原图中指定区域，根据车辆轨迹判断驶入/驶出区域的行为，统计各类车辆的区域进出车流量，可返回含统计值和跟踪框的渲染图。
     *
     * @param string $url 图片完整URL
     * @param int $caseId 任务ID（通过case_id区分不同视频流，自拟，不同序列间不可重复）
     * @param bool $caseInit 每个case的初始化信号，为true时对该case下的跟踪算法进行初始化，为false时重载该case的跟踪状态。当为false且读取不到相应case的信息时，直接重新初始化
     * @param string $area 只统计进出该区域的车辆。逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合多边形区域。
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   show 是否返回结果图（含统计值和跟踪框）。选true时返回渲染后的图片(base64)，其它无效值或为空则默认false。
     * @return array
     * @throws HttpException
     */
    public function trafficFlowUrl(string $url, int $caseId, bool $caseInit, string $area, array $options = [])
    {
        $data              = [];
        $data              = array_merge($data, $options);
        $data['url']       = $url;
        $data['case_id']   = $caseId;
        $data['case_init'] = $caseInit;
        $data['area']      = $area;
        return $this->request('/rest/2.0/image-classify/v1/traffic_flow', $data);
    }
}
