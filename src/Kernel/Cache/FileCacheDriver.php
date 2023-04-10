<?php
/**
 * @Author: gan
 * @Description:文件缓存
 * @File:  FileCacheDriver
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:48 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Cache;

use Jiahetian\HyperfBaidu\Kernel\Helpers\FileHelper;
use Psr\SimpleCache\CacheInterface;

class FileCacheDriver implements CacheInterface
{
    protected string     $dir;
    protected FileHelper $fileSystem;
    protected string     $prefix = "baidu_aip_";

    public function __construct($dir, $prefix)
    {
        $this->dir        = $dir ?: sys_get_temp_dir();
        $this->prefix     = $prefix ?? $this->prefix;
        $this->fileSystem = new FileHelper();
        FileHelper::createDirectory($this->dir);
    }

    /**
     * @return string
     */
    protected function getPrefix(): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $this->prefix;
    }

    /**
     * 获取缓存的 key
     * @param string $key
     * @return string
     */
    public function getCacheKey(string $key)
    {
        return $this->getPrefix() . $key . '.cache';
    }

    /**
     * 设置缓存
     * @param string $key
     * @param mixed $value
     * @param null $ttl
     * @return bool
     */
    public function set($key, $value, $ttl = null)
    {
        $file = $this->getCacheKey($key);
        $data = serialize($value);
        $this->fileSystem->put($file, $data);
        if ($ttl < time()) {
            $ttl = $this->getTtlTime($ttl);
        }
        return touch($file, $ttl);
    }

    /**
     * 获取缓存
     * @param string $key
     * @param null $default
     * @return mixed|null
     * @throws \Exception
     */
    public function get($key, $default = null)
    {
        $file = $this->getCacheKey($key);
        if ($this->fileSystem->missing($file)) {
            return $default;
        }
        if ($this->fileSystem->lastModified($file) < time()) {
            return $default;
        }
        return unserialize($this->fileSystem->get($file));
    }

    /**
     * 获取缓存过期时间
     * @param null $ttl
     * @return float|int|null
     */
    public function getTtlTime($ttl = null)
    {
        // 如果不设置时间 默认 100 年
        if (is_null($ttl)) {
            $ttl = 3600 * 24 * 30 * 12 * 100;
        }
        $ttl = $ttl + time();
        return $ttl;
    }

    /**
     * 删除缓存
     * @param string $key
     * @return bool
     */
    public function delete($key)
    {
        $file = $this->getCacheKey($key);
        return $this->fileSystem->delete($file);
    }

    /**
     * 清空缓存
     * @return bool|void
     */
    public function clear()
    {
        $files = glob($this->getPrefix() . '*');
        foreach ($files as $file) {
            if (is_dir($file)) {
                continue;
            }
            unlink($file);
        }
    }

    /**
     * 批量读取缓存
     * @param iterable $keys
     * @param null $default
     * @return array|iterable
     * @throws \Exception
     */
    public function getMultiple($keys, $default = null)
    {
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        $result = [];
        foreach ($keys as $i => $key) {
            $result[$key] = $this->get($key, $default);
        }
        return $result;
    }

    /**
     * 批量设置缓存
     * @param iterable $values
     * @param null $ttl
     * @return bool>
     */
    public function setMultiple($values, $ttl = null)
    {
        if (!is_array($values)) {
            $values = [$values];
        }

        $ttl = $this->getTtlTime($ttl);
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }
        return true;
    }

    /**
     * 批量删除缓存
     * @param iterable $keys
     * @return bool
     */
    public function deleteMultiple($keys)
    {
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        foreach ($keys as $index => $key) {
            $this->delete($key);
        }
        return true;
    }

    /**
     * 缓存是否存在
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        $file = $this->getCacheKey($key);
        return file_exists($file);
    }
}
