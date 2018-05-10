<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-08
 * Time: 7:34
 */

namespace App\Http\Controllers\Admin;


use App\Core\Dao\Front\Machine;
use Illuminate\Http\Request;

class MachineController
{

    public function mlist()
    {
        $machines = Machine::getAll();
        return view('admin.machine', ['machines' => $machines]);
    }

    public function submit(Request $request)
    {
        $location = $request['location'];
        $id = $request['id'];
        if (empty($location))
            return response()->json(['status'=>4000, 'msg'=>'位置为空'])->setCallback($request['jsonp']);
        if (!empty($id)) {
            $machine = Machine::getById($id);
            if (empty($machine))
                return response()->json(['status'=>4000, 'msg'=>'没有此机器'])->setCallback($request['jsonp']);
            $machine->location = $location;
            $machine->save();
        } else {
            Machine::createBiz($location);
        }
        return response()->json(['status'=>200])->setCallback($request['jsonp']);
    }
}