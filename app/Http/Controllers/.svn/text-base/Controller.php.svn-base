<?php

namespace App\Http\Controllers;

use App\Core\Enum\ErrorCodeEnum;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //public function generat
    public function sendResponseSucc($rep, $content='')
    {
        if (!empty($_REQUEST['jsonp'])) {
            $rep->setCallback($_REQUEST['jsonp']);
        }
        return $rep->json(['status'=>200, 'content'=>$content]);
    }

    public function sendResponseErr($errorCode, $msg = '')
    {
        if ($msg == '') {
            $msg = ErrorCodeEnum::nameOf($msg);
        }
        return response()->json(['status'=>$errorCode, 'msg'=>$msg]);
    }
}
