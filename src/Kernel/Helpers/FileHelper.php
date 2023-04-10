<?php

declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Helpers;

class FileHelper
{
    /**
     * 创建目录
     * @param string $dirPath 需要创建的目录
     * @param integer $permissions 目录权限
     * @return bool
     */
    public static function createDirectory(string $dirPath, int $permissions = 0755)
    {
        if (!is_dir($dirPath) && !file_exists($dirPath)) {
            try {
                return mkdir($dirPath, $permissions, true) && chmod($dirPath, $permissions);
            } catch (\Throwable $throwable) {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * 清空一个目录
     * @param string $dirPath 需要创建的目录
     * @param bool $keepStructure 是否保持目录结构
     * @return bool
     */
    public static function cleanDirectory(string $dirPath, bool $keepStructure = false)
    {
        $scanResult = static::scanDirectory($dirPath);
        if (!$scanResult) {
            return false;
        }

        try {
            foreach ($scanResult['files'] as $file) {
                unlink($file);
            }
            if (!$keepStructure) {
                krsort($scanResult['dirs']);
                foreach ($scanResult['dirs'] as $dir) {
                    rmdir($dir);
                }
            }
            return true;
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * 删除一个目录
     * @param string $dirPath
     * @return bool
     */
    public static function deleteDirectory(string $dirPath)
    {
        $dirPath = realpath($dirPath);
        if (!is_dir($dirPath)) {
            return false;
        }
        if (!static::cleanDirectory($dirPath)) {
            return false;
        }
        return rmdir(realpath($dirPath));
    }

    /**
     * 复制目录
     * @param string $source 源位置
     * @param string $target 目标位置
     * @param bool $overwrite 是否覆盖目标文件
     * @return bool
     */
    public static function copyDirectory(string $source, string $target, bool $overwrite = true)
    {
        $scanResult = static::scanDirectory($source);
        if (!$scanResult) {
            return false;
        }
        if (!is_dir($target)) {
            self::createDirectory($target);
        }

        try {
            $sourceRealPath = realpath($source);
            foreach ($scanResult['files'] as $file) {
                $targetRealPath = realpath($target) . '/' . ltrim(substr($file, strlen($sourceRealPath)), '/');
                static::copyFile($file, $targetRealPath, $overwrite);
            }
            return true;
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * 移动目录到另一位置
     * @param string $source 源位置
     * @param string $target 目标位置
     * @param bool $overwrite 是否覆盖目标文件
     * @return bool
     */
    public static function moveDirectory(string $source, string $target, bool $overwrite = true)
    {
        $scanResult = static::scanDirectory($source);
        if (!$scanResult) {
            return false;
        }
        if (!is_dir($target)) {
            self::createDirectory($target);
        }

        try {
            $sourceRealPath = realpath($source);
            foreach ($scanResult['files'] as $file) {
                $targetRealPath = realpath($target) . '/' . ltrim(substr($file, strlen($sourceRealPath)), '/');
                static::moveFile($file, $targetRealPath, $overwrite);
            }
            static::deleteDirectory($sourceRealPath);
            return true;
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * 复制文件
     * @param string $source 源位置
     * @param string $target 目标位置
     * @param bool $overwrite 是否覆盖目标文件
     * @return bool
     */
    public static function copyFile(string $source, string $target, bool $overwrite = true)
    {
        if (!file_exists($source)) {
            return false;
        }
        if (file_exists($target) && $overwrite == false) {
            return false;
        } elseif (file_exists($target) && $overwrite == true) {
            if (!unlink($target)) {
                return false;
            }
        }
        $targetDir = dirname($target);
        if (!self::createDirectory($targetDir)) {
            return false;
        }
        return copy($source, $target);
    }

    /**
     * 创建一个空文件
     * @param $filePath
     * @param $overwrite
     * @return bool
     */
    public static function touchFile(string $filePath, bool $overwrite = true)
    {
        if (file_exists($filePath) && $overwrite == false) {
            return false;
        } elseif (file_exists($filePath) && $overwrite == true) {
            if (!unlink($filePath)) {
                return false;
            }
        }
        $aimDir = dirname($filePath);
        if (self::createDirectory($aimDir)) {
            try {
                return touch($filePath);
            } catch (\Throwable $throwable) {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 创建一个有内容的文件
     * @param      $filePath
     * @param      $content
     * @param bool $overwrite
     * @return bool
     */
    public static function createFile(string $filePath, string $content, bool $overwrite = true)
    {
        if (static::touchFile($filePath, $overwrite)) {
            return (bool)file_put_contents($filePath, $content);
        } else {
            return false;
        }
    }

    /**
     * 移动文件到另一位置
     * @param string $source 源位置
     * @param string $target 目标位置
     * @param bool $overwrite 是否覆盖目标文件
     * @return bool
     */
    public static function moveFile(string $source, string $target, bool $overwrite = true)
    {
        if (!file_exists($source)) {
            return false;
        }
        if (file_exists($target) && $overwrite == false) {
            return false;
        } elseif (file_exists($target) && $overwrite == true) {
            if (!unlink($target)) {
                return false;
            }
        }
        $targetDir = dirname($target);
        if (!self::createDirectory($targetDir)) {
            return false;
        }
        return rename($source, $target);
    }

    /**
     * 遍历目录
     * @param string $dirPath
     * @return array|bool
     */
    public static function scanDirectory(string $dirPath)
    {
        if (!is_dir($dirPath)) {
            return false;
        }
        $dirPath = rtrim($dirPath, '/') . '/';
        $dirs    = array($dirPath);

        $fileContainer = array();
        $dirContainer  = array();

        try {
            do {
                $workDir    = array_pop($dirs);
                $scanResult = scandir($workDir);
                foreach ($scanResult as $files) {
                    if ($files == '.' || $files == '..') {
                        continue;
                    }
                    $realPath = $workDir . $files;
                    if (is_dir($realPath)) {
                        array_push($dirs, $realPath . '/');
                        $dirContainer[] = $realPath;
                    } elseif (is_file($realPath)) {
                        $fileContainer[] = $realPath;
                    }
                }
            } while ($dirs);
        } catch (\Throwable $throwable) {
            return false;
        }
        return ['files' => $fileContainer, 'dirs' => $dirContainer];
    }

    /**
     * @param string $path
     * @return bool
     */
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function missing(string $path): bool
    {
        return !$this->exists($path);
    }

    /**
     * @param string $path
     * @param bool $lock
     * @return false|string
     * @throws \Exception
     */
    public function get(string $path, bool $lock = false)
    {
        if (!$this->isFile($path)) {
            throw new \Exception("File does not exist at path {$path}.");
        }
        return $lock ? $this->sharedGet($path) : file_get_contents($path);
    }

    /**
     * @param string $path
     * @return false|string
     */
    public function sharedGet(string $path)
    {
        $contents = '';
        $handle = fopen($path, 'rb');
        if (!$handle) {
            return $contents;
        }
        try {
            if (!flock($handle, LOCK_SH)) {
                return $contents;
            }
            clearstatcache(true, $path);
            $contents = fread($handle, $this->size($path) ?: 1);
            flock($handle, LOCK_UN);
        } finally {
            fclose($handle);
        }
        return $contents;
    }

    /**
     * @param string $path
     * @return false|string
     */
    public function hash(string $path)
    {
        return md5_file($path);
    }

    /**
     * @param string $path
     * @param string $contents
     * @param bool $lock
     * @return false|int
     */
    public function put(string $path, string $contents, bool $lock = false)
    {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    /**
     * @param string $path
     * @param string $content
     */
    public function replace(string $path, string $content)
    {
        clearstatcache(true, $path);
        $path = realpath($path) ?: $path;
        $tempPath = tempnam(dirname($path), basename($path));
        chmod($tempPath, 0777 - umask());
        file_put_contents($tempPath, $content);
        rename($tempPath, $path);
    }

    /**
     * @param string $path
     * @param string $data
     * @return false|int
     */
    public function prepend(string $path, string $data)
    {
        if ($this->exists($path)) {
            return $this->put($path, $data . $this->get($path));
        }
        return $this->put($path, $data);
    }

    /**
     * @param string $path
     * @param string $data
     * @return false|int
     */
    public function append(string $path, string $data)
    {
        return file_put_contents($path, $data, FILE_APPEND);
    }

    /**
     * @param string $path
     * @param int|null $mode
     * @return bool|string
     */
    public function chmod(string $path, ?int $mode = null)
    {
        if ($mode) {
            return chmod($path, $mode);
        }
        return substr(sprintf('%o', fileperms($path)), -4);
    }

    /**
     * @param string|array $paths
     * @return bool
     */
    public function delete($paths)
    {
        $paths = is_array($paths) ? $paths : func_get_args();
        $ret = true;
        foreach ($paths as $path) {
            try {
                if (!unlink($path)) {
                    $ret = false;
                }
            } catch (\Throwable $throwable) {
                $ret = false;
            }
        }
        return $ret;
    }

    /**
     * @param string $path
     * @param string $target
     * @return bool
     */
    public function move(string $path, string $target)
    {
        return rename($path, $target);
    }

    /**
     * @param string $path
     * @param string $target
     * @return bool
     */
    public function copy(string $path, string $target)
    {
        return copy($path, $target);
    }

    /**
     * @param string $path
     * @return string
     */
    public function name(string $path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * @param string $path
     * @return string
     */
    public function basename(string $path)
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }

    /**
     * @param string $path
     * @return string
     */
    public function dirname(string $path)
    {
        return pathinfo($path, PATHINFO_DIRNAME);
    }

    /**
     * @param string $path
     * @return string
     */
    public function extension(string $path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * @param string $path
     * @return string
     */
    public function type(string $path)
    {
        return filetype($path);
    }

    /**
     * @param string $path
     * @return false|int
     */
    public function size(string $path)
    {
        return filesize($path);
    }

    /**
     * @param string $path
     * @return int
     */
    public function lastModified(string $path)
    {
        return filemtime($path);
    }

    /**
     * @param string $directory
     * @return bool
     */
    public function isDirectory(string $directory)
    {
        return is_dir($directory);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function isReadable(string $path)
    {
        return is_readable($path);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function isWritable(string $path)
    {
        return is_writable($path);
    }

    /**
     * @param string $file
     * @return bool
     */
    public function isFile(string $file)
    {
        return is_file($file);
    }

    /**
     * @param string $pattern
     * @param int $flags
     * @return array|false
     */
    public function glob(string $pattern, int $flags = 0)
    {
        return glob($pattern, $flags);
    }

    /**
     * @param string $path
     * @param int $mode
     * @param bool $recursive
     * @return bool
     */
    public function ensureDirectoryExists(string $path, $mode = 0755, bool $recursive = true)
    {
        if (!$this->isDirectory($path)) {
            return $this->makeDirectory($path, $mode, $recursive);
        }
        return true;
    }

    /**
     * @param string $path
     * @param int $mode
     * @param bool $recursive
     * @param bool $force
     * @return bool
     */
    public function makeDirectory(string $path, $mode = 0755, bool $recursive = false, bool $force = false): bool
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }
        return mkdir($path, $mode, $recursive);
    }
}
