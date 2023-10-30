<?php


namespace App\Http\Controllers\Api;

trait ApiResponseTrait{

    public function apiResponse($data=null,$message=null,$stsuts=null){
        $array=[
            'data'=>$data,
            'message'=>$message,
            'stsuts'=>$stsuts,
        ];

        //return response($array,$stsuts);
        return response()->json($array,$stsuts);
    }
}


