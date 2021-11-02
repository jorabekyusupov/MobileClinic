<?php


namespace App\Mixins;


class ResponseMixin {

public function successJson(){

    return function($data=null,  $code= null,$msg=null  ){
        return [
            'success' => true,
            'data' => $data,
            'code' => $code,
            'msg' => $msg,
        ];
    };
}

public function errorJson(){

    return function($code, $msg=null){
        return [
            'success' => false,
            'data' => [],
            'code' => $code,
            'msg' => $msg
        ];
    };
}


}
