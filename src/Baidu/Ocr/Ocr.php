<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Ocr
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Ocr;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Ocr extends BaseClient
{
    /**
     * 通用文字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function generalBasic(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general_basic', $data);
    }


    /**
     * 通用文字识别接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function generalBasicUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general_basic', $data);
    }


    /**
     * 通用文字识别（高精度版）接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function accurateBasic(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/accurate_basic', $data);
    }

    /**
     * 通用文字识别（含位置信息版）接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function general(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general', $data);
    }


    /**
     * 通用文字识别（含位置信息版）接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function generalUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general', $data);
    }


    /**
     * 通用文字识别（含位置高精度版）接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function accurate(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/accurate', $data);
    }


    /**
     * 通用文字识别（含生僻字版）接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function generalEnhanced(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general_enhanced', $data);
    }


    /**
     * 通用文字识别（含生僻字版）接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>- GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语；
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     * @throws HttpException
     */
    public function generalEnhancedUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/general_enhanced', $data);
    }


    /**
     * 网络图片文字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     * @return array
     * @throws HttpException
     */
    public function webImage(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/webimage', $data);
    }

    /**
     * 网络图片文字识别接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     * @return array
     * @throws HttpException
     */
    public function webImageUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/webimage', $data);
    }

    /**
     * 身份证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $idCardSide - front：身份证含照片的一面；back：身份证带国徽的一面
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_risk 是否开启身份证风险类型(身份证复印件、临时身份证、身份证翻拍、修改过的身份证)功能，默认不开启，即：false。可选值:true-开启；false-不开启
     * @return array
     * @throws HttpException
     */
    public function idCard(string $image, string $idCardSide, array $options = [])
    {
        $data                 = [];
        $data['image']        = base64_encode($image);
        $data['id_card_side'] = $idCardSide;
        $data                 = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/idcard', $data);
    }


    /**
     * 银行卡识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function bankCard(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/bankcard', $data);
    }


    /**
     * 驾驶证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     * @throws HttpException
     */
    public function drivingLicense(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/driving_license', $data);
    }


    /**
     * 行驶证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   accuracy normal 使用快速服务，1200ms左右时延；缺省或其它值使用高精度服务，1600ms左右时延
     * @return array
     * @throws HttpException
     */
    public function vehicleLicense(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vehicle_license', $data);
    }


    /**
     * 车牌识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   multi_detect 是否检测多张车牌，默认为false，当置为true的时候可以对一张图片内的多张车牌进行识别
     * @return array
     * @throws HttpException
     */
    public function licensePlate(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/license_plate', $data);
    }

    /**
     * 营业执照识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function businessLicense(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/business_license', $data);
    }


    /**
     * 通用票据识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   probability 是否返回识别结果中每一行的置信度
     *   accuracy normal 使用快速服务，1200ms左右时延；缺省或其它值使用高精度服务，1600ms左右时延
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     * @throws HttpException
     */
    public function receipt(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/receipt', $data);
    }


    /**
     * 火车票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function trainTicket(string $image, array $options = [])
    {
        $data          = array();
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/train_ticket', $data);
    }


    /**
     * 火车票识别接口
     *
     * @param string $url - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function trainTicketUrl(string $url, array $options = [])
    {
        $data        = array();
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/train_ticket', $data);
    }


    /**
     * 出租车票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function taxiReceipt(string $image, array $options = [])
    {
        $data          = array();
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/taxi_receipt', $data);
    }


    /**
     * 出租车票识别接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function taxiReceiptUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/taxi_receipt', $data);
    }

    /**
     * 表格文字识别同步接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function form(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/form', $data);
    }


    /**
     * 表格文字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function tableRecognitionAsync(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/form_ocr/request', $data);
    }


    /**
     * 表格识别结果接口
     *
     * @param string $requestId - 发送表格文字识别请求时返回的request id
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   result_type 期望获取结果的类型，取值为“excel”时返回xls文件的地址，取值为“json”时返回json格式的字符串,默认为”excel”
     * @return array
     * @throws HttpException
     */
    public function getTableRecognitionResult(string $requestId, array $options = array())
    {
        $data               = array();
        $data['request_id'] = $requestId;
        $data               = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/form_ocr/get_request_result', $data);
    }


    /**
     * 增值税发票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vatInvoice(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vat_invoice', $data);
    }

    /**
     * 增值税发票识别接口
     *
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   string type 进行识别的增值税发票类型，默认为 normal，可缺省
     *           - normal：可识别增值税普票、专票、电子发票
     *           - roll：可识别增值税卷票
     * @return array
     * @throws HttpException
     */
    public function vatInvoiceUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vat_invoice', $data);
    }


    /**
     * 增值税发票识别接口
     *
     * @param string $pdfFile - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表
     *   string type 进行识别的增值税发票类型，默认为 normal，可缺省
     *           - normal：可识别增值税普票、专票、电子发票
     *           - roll：可识别增值税卷票
     * @return array
     * @throws HttpException
     */
    public function vatInvoicePdf(string $pdfFile, array $options = [])
    {
        $data             = [];
        $data['pdf_file'] = base64_encode($pdfFile);
        $data             = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vat_invoice', $data);
    }

    /**
     * 二维码识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function qrCode(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/qrcode', $data);
    }


    /**
     * 数字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     * @throws HttpException
     */
    public function numbers(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/numbers', $data);
    }


    /**
     * 彩票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     * @return array
     * @throws HttpException
     */
    public function lottery(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/lottery', $data);
    }


    /**
     * 护照识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function passport(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/passport', $data);
    }


    /**
     * 名片识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function businessCard(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/business_card', $data);
    }


    /**
     * 名片识别接口
     *
     * @param string $url - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function businessCardUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/business_card', $data);
    }


    /**
     * 手写文字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     * @return array
     * @throws HttpException
     */
    public function handwriting(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/handwriting', $data);
    }


    /**
     * 自定义模板文字识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   templateSign 您在自定义文字识别平台制作的模板的ID
     *   classifierId 分类器Id。这个参数和templateSign至少存在一个，优先使用templateSign。存在templateSign时，表示使用指定模板；如果没有templateSign而有classifierId，表示使用分类器去判断使用哪个模板
     * @return array
     * @throws HttpException
     */
    public function custom(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/solution/v1/iocr/recognise', $data);
    }


    /**
     * 同步请求
     *
     * @param string $image 图像读取
     * @param array $options 接口可选参数
     * @param int $timeout
     * @return array
     * @throws HttpException
     */
    public function tableRecognition(string $image, array $options = [], int $timeout = 10000)
    {
        $result = $this->tableRecognitionAsync($image);
        if (isset($result['error_code'])) {
            return $result;
        }
        $requestId = $result['result'][0]['request_id'];
        $count     = ceil($timeout / 1000);
        for ($i = 0; $i < $count; $i++) {
            $result = $this->getTableRecognitionResult($requestId, $options);
            // 完成
            if ($result['result']['ret_code'] == 3) {
                break;
            }
            sleep(1);
        }
        return $result;
    }


    /**
     * VIN码识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vinCode(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vin_code', $data);
    }


    /**
     * VIN码识别接口
     * @param string $url - 图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vinCodeUrl(string $url, array $options = [])
    {
        $data        = [];
        $data['url'] = $url;
        $data        = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vin_code', $data);
    }


    /**
     * 定额发票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function quotaInvoice(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/quota_invoice', $data);
    }


    /**
     * 户口本识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function householdRegister(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/household_register', $data);
    }


    /**
     * 港澳通行证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function HKMacauExitEntryPermit(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/HK_Macau_exitentrypermit', $data);
    }


    /**
     * 台湾通行证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function TWExitEntryPermit(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/taiwan_exitentrypermit', $data);
    }


    /**
     * 出生医学证明识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function birthCertificate(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/birth_certificate', $data);
    }


    /**
     * 机动车销售发票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vehicleInvoice(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vehicle_invoice', $data);
    }


    /**
     * 车辆合格证识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function vehicleCertificate(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/vehicle_certificate', $data);
    }


    /**
     * 税务局通用机打发票识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   location 是否输出位置信息，true：输出位置信息，false：不输出位置信息，默认false
     * @return array
     * @throws HttpException
     */
    public function invoice(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/invoice', $data);
    }


    /**
     * 行程单识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   location 是否输出位置信息，true：输出位置信息，false：不输出位置信息，默认false
     * @return array
     * @throws HttpException
     */
    public function airTicket(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/air_ticket', $data);
    }


    /**
     * 保单识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   rkv_business 是否进行商业逻辑处理，rue：进行商业逻辑处理，false：不进行商业逻辑处理，默认true
     * @return array
     * @throws HttpException
     */
    public function insuranceDocuments(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request('/rest/2.0/ocr/v1/insurance_documents', $data);
    }
}
