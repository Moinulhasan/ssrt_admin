<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Response;

class ResponseFormat
{
    public function successResponse($data,$code)
    {
        $output =[
            'status'=>true,
            'message'=>'success',
            'data'=>$data
        ];
        return Response::json($output,$code);
    }

    public function failResponse($message,$code)
    {
        $output = [
            'status'=>false,
            'message'=>'failed',
            'error'=>$message
        ];
        return Response::json($output,$code);
    }
}
