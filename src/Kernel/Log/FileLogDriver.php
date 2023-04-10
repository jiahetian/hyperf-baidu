<?php
/**
 * @Author: gan
 * @Description:
 * @File:  FileLogDriver
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:02 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Log;

use Psr\Log\LoggerInterface;

class FileLogDriver implements LoggerInterface
{
    private string $tempDir;
    private string $file;

    public function __construct($tempDir)
    {
        $this->tempDir = $tempDir;
        $this->file    = "{$tempDir}/baidu_aip.log";
    }

    public function emergency($message, array $context = [])
    {
        $this->log("EMERGENCY", $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log("ALERT", $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log("CRITICAL", $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log("ERROR", $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log("WARNING", $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log("NOTICE", $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log("INFO", $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log("DEBUG", $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        $fileData = [
            "time"    => (new \DateTime())->format("Y-m-d H:i:s.u"),
            "level"   => $level,
            "message" => $message,
            "data"    => $context
        ];
        file_put_contents($this->file, json_encode($fileData) . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
