<?php

namespace App\Http\Controllers;

use App\Decision;
use App\Invest;
use App\Services\UpyunOther;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;



class TestController extends Controller
{
    public function index()
    {
        return Invest::invested();
    }



    public function test($config = [])
    {
        $formApiKey = "cLgJ6oKxhxeGq5Ej0jVsjDpZsOU=";
        $sign =  Signature($formApiKey);
        $upload = new Upload($sign);
        $upload->setBucketName('your_bucket_name');//�ϴ��Ŀռ�
        try {
            //���������μ��ĵ�: http://docs.upyun.com/api/form_api/#Policy�������
            $options = array(
                'path' => $config['path'],                   // �ļ��ڷ����������·��,����
            );
            $file = new File($config['file']);

            $result = $upload->upload($file, $options);

        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

}
