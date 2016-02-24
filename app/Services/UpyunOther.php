<?php

namespace App\Services;


use Clockos\UpYun;



class UpyunOther{


    public function deleteDir($path)
    {
        $upYun = new UpYun('clockos', env('UPYUN_ID'),  env('UPYUN_SECRET'));
        if (strncasecmp('/', $path, 1) !== 0) {
            $path = '/' . $path;
        }
        //dd($path);
        $this->removeDirR($path, $upYun); //调用删除方法.

    }

    private function removeDirR($path, UpYun $upYun)
    {

        //dd($path);
        try {
            $list = $upYun->getList($path); //获取目录列表信息.
        }
        catch(\Exception $e) {
            $code = $e->getCode();     //检查目录是否存在
        }


        if(is_null(@$code)){
            if ($list) {
                foreach ($list as $item) {
                    if (strrpos($path, '/') == strlen($path) - 1) {//判断路径是否以/结束，由于开始路径可能是以/结束的，所以这里需要排除一下
                        $file = $path . $item['name'];
                    } else {
                        $file = $path . '/' . $item['name'];
                    }
                    if ($item['type'] == 'folder') {//是文件夹，递归删除子文件夹文件.
                        $this->removeDirR($file, $upYun);
                    } else {//普通文件，直接删除
                        $upYun->deleteFile($file);
                    }
                }
            }
            $upYun->rmDir($path);
        }
    }

}