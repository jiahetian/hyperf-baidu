<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Config
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:58 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel;

use Jiahetian\HyperfBaidu\Kernel\Traits\HasAttributes;

class Config
{
    use HasAttributes;

    public function __construct(array $data = [])
    {
        $this->setAttributes($data);
    }

    /**
     * @param string|null $path
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $path = null, $default = null)
    {
        $array = $this->all();

        if (is_null($path)) {
            return $array;
        }

        foreach (explode('.', $path) as $segment) {
            if (array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }
}
