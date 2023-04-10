<?php
/**
 * @Author: gan
 * @Description:内容审核
 * @File:  Process
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:34 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Image;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;

class Process extends BaseClient
{
    /**
     * 图像无损放大
     * @var string
     */
    private string $imageQualityEnhanceUrl = '/rest/2.0/image-process/v1/image_quality_enhance';

    /**
     * 图像去雾
     * @var string
     */
    private string $dehazeUrl = '/rest/2.0/image-process/v1/dehaze';

    /**
     * 图像对比度增强
     * @var string
     */
    private string $contrastEnhanceUrl = '/rest/2.0/image-process/v1/contrast_enhance';

    /**
     * 黑白图像上色
     * @var string
     */
    private string $colourizeUrl = '/rest/2.0/image-process/v1/colourize';

    /**
     * 拉伸图像恢复
     * @var string
     */
    private string $stretchRestoreUrl = '/rest/2.0/image-process/v1/stretch_restore';

    /**
     * 风格转换
     * @var string
     */
    private string $styleTransUrl = "/rest/2.0/image-process/v1/style_trans";

    /**
     * 图像修复
     * @var string
     */
    private string $inPaintingUrl = "/rest/2.0/image-process/v1/inpainting";

    /**
     * 图像清晰度增强
     * @var string
     */
    private string $imageDefinitionEnhanceUrl = "/rest/2.0/image-process/v1/image_definition_enhance";

    /**
     *人像动漫化
     * @var string
     */
    private string $selfieAnimeUrl = "/rest/2.0/image-process/v1/selfie_anime";

    /**
     * 天空分割
     * @var string
     */
    private string $skySegUrl = "/rest/2.0/image-process/v1/sky_seg";


    /**
     * 图像无损放大接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function imageQualityEnhance(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->imageQualityEnhanceUrl, $data);
    }

    /**
     * 图像去雾接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function dehaze(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->dehazeUrl, $data);
    }

    /**
     * 图像对比度增强接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function contrastEnhance(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->contrastEnhanceUrl, $data);
    }

    /**
     * 黑白图像上色接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function colourize(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->colourizeUrl, $data);
    }

    /**
     * 拉伸图像恢复接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function stretchRestore(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->stretchRestoreUrl, $data);
    }


    /**
     * 人像动漫化
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function selfieAnime(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->selfieAnimeUrl, $data);
    }


    /**
     * 图像清晰度增强
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function imageDefinitionEnhance(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->imageDefinitionEnhanceUrl, $data);
    }


    /**
     * 图像风格转换
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function styleTrans(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->styleTransUrl, $data);
    }


    /**
     * 天空分割
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function skySeg(string $image, array $options = [])
    {
        $data          = [];
        $data['image'] = base64_encode($image);
        $data          = array_merge($data, $options);
        return $this->request($this->skySegUrl, $data);
    }


    /**
     * 图像修复
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $rectangle - 要去除的位置为规则矩形时，给出坐标信息，每个元素包含left, top, width, height，int 类型。如： [{'width': 92, 'top': 25, 'height': 36, 'left': 543}] 注意：上传宽高、位置坐标参数要比图片实际宽高小
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     * @throws HttpException
     */
    public function inPaintingByMask(string $image, array $rectangle, array $options = [])
    {
        $data              = [];
        $data['image']     = base64_encode($image);
        $data['rectangle'] = $rectangle;
        $data              = array_merge($data, $options);
        return $this->request($this->inPaintingUrl, $data);
    }
}
