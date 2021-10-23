<?php


namespace App\Mixins;


class ResponseMixin {

public function successJson(){

    return function($data=null, $msg=null){
        return [
            'success' => true,
            'data' => $data,
            'msg' => $msg
        ];
    };
}

public function errorJson(){

    return function($code, $msg){
        return [
            'success' => false,
            'data' => [],
            'code' => $code,
            'msg' => $msg
        ];
    };
}


}
