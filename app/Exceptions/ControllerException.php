<?php

namespace App\Exceptions;

use Exception;
use http\Env\Response;

class ControllerException extends Exception
{
    public function render()
    {
        return redirect()->back()->with([
            'alertType' => 'error',
            'message'   => "Something went wrong!"
        ]);
    }

    public static function error()
    {
        return redirect()->back()->with([
            'alertType' => 'error',
            'message'   => "Something went wrong!"
        ]);
    }

    public static function success($route = null, $msg = null,$slug=null)
    {
        if (is_null($route)) {
            return redirect()->back()->with([
                'alertType' => 'success',
                'message'   => $msg ?? "Successfully created!"
            ]);
        } else {
          if ($slug)
          {
              return redirect()->route($route,['slug'=>$slug])->with([
                  'alertType' => 'success',
                  'message'   => $msg ?? "Successfully created!"
              ]);
          }else{
              return redirect()->route($route)->with([
                  'alertType' => 'success',
                  'message'   => $msg ?? "Successfully created!"
              ]);
          }
        }
    }

    public static function errorWithMsg($msg)
    {
        return redirect()->back()->with([
            'alertType' => 'warning',
            'message'   => $msg
        ]);
    }
}
