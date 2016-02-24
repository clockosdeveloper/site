<?php

namespace App\Services;



use Crocodile\Signature;
use Crocodile\File;
use Crocodile\Upload;

class UpyunUpload{

    public function uploadImage($config)
    {

            $formApiKey = env('UPYUN_KEY');

            $sign = new Signature($formApiKey);

            $upload = new Upload($sign);

            $upload->setBucketName('clockos');


            $options = array(
                'path' => $config['path'],                   // �ļ��ڷ����������·��,����
                'x-gmkerl-crop' => $config['w'].'x'.$config['h'].'a'.$config['x'].'a'.$config['y']
            );
            $file = new File($config['file']);

            $up = $upload->upload($file, $options);

            return $up;

    }

}