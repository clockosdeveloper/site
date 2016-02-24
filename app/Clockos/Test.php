<?php

namespace Clockos;

class Test{
    static public function cdn($file)
    {
        $cdn = env('CDN_URL');

        if(!$cdn)
        {
            $split = explode("!", $file);
            $file = $split[0];
        }
        return $cdn . $file;
    }

}