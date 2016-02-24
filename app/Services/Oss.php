<?php

namespace App\Services;

use OSS\OssClient;
use OSS\Core\OssException;

class Oss{

    public function __construct()
    {
        $accessKeyId = env('ALIYUN_ID');
        $accessKeySecret = env('ALIYUN_SECRET');
        $endpoint = "oss-cn-beijing.aliyuncs.com";
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
        } catch (OssException $e) {
            print $e->getMessage();
        }
        $this->ossClient = $ossClient;
    }

    public function upload($path,$realpath)
    {
        $this->ossClient->uploadFile('devsrc',$path, $realpath);
    }

    public function delete($path)
    {
        $accessKeyId = env('ALIYUN_ID');
        $accessKeySecret = env('ALIYUN_SECRET');
        $endpoint = "oss-cn-beijing.aliyuncs.com";
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
        } catch (OssException $e) {
            print $e->getMessage();
        }
        $ossClient->putObject('devsrc',$path, __FILE__);

    }
}