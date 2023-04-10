<?php
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu;

use Jiahetian\HyperfBaidu\Baidu\Face\Application as FaceApplication;
use Jiahetian\HyperfBaidu\Baidu\Ocr\Application as OcrApplication;
use Jiahetian\HyperfBaidu\Baidu\Speech\Application as SpeechApplication;
use Jiahetian\HyperfBaidu\Baidu\BodyAnalysis\Application as BodyApplication;
use Jiahetian\HyperfBaidu\Baidu\Kg\Application as KgApplication;
use Jiahetian\HyperfBaidu\Baidu\Nlp\Application as NlpApplication;
use Jiahetian\HyperfBaidu\Baidu\Image\Application as ImageApplication;

class Factory
{
    /**
     * @param mixed ...$arguments
     * @return FaceApplication
     */
    public static function face(...$arguments)
    {
        return new FaceApplication(...$arguments);
    }

    /**
     * @param mixed ...$arguments
     * @return OcrApplication
     */
    public static function ocr(...$arguments)
    {
        return new OcrApplication(...$arguments);
    }

    /**
     * @param mixed ...$arguments
     * @return SpeechApplication
     */
    public static function speech(...$arguments)
    {
        return new SpeechApplication(...$arguments);
    }

    /**
     * @param mixed ...$arguments
     * @return ImageApplication
     */
    public static function image(...$arguments)
    {
        return new ImageApplication(...$arguments);
    }

    /**
     * @param mixed ...$arguments
     * @return BodyApplication
     */
    public static function body(...$arguments)
    {
        return new BodyApplication(...$arguments);
    }

    /**
     * @param mixed ...$arguments
     * @return KgApplication
     */
    public static function kg(...$arguments)
    {
        return new KgApplication(...$arguments);
    }


    /**
     * @param mixed ...$arguments
     * @return NlpApplication
     */
    public static function nlp(...$arguments)
    {
        return new NlpApplication(...$arguments);
    }
}
