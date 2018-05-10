<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-06
 * Time: 23:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock(Request $request)
    {
        return view('admin.stock');
    }
}