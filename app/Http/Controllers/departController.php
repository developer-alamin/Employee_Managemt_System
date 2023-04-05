<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\departModel;

class departController extends Controller
{
    public function depart($value='')
    {
    	return view('depart');
    }

    public function adddepartment($value='')
    {
       return view('adddepart');
    }

     public function createDepart(Request $req)
    {
    	
        $data = DB::table('depart')->insert([
            'departName' => $req->data,
            'date' => $req->date
        ]);

        if ($data == true) {
            return 1;
        }else{
            return 0;
        }
    }

    public function showDepart(Request $req)
    {
       $departData = departModel::all();
       return $departData;
    }
    public function departUpShow(Request $req)
    {
       $upid = $req->id;
       $upshow = departModel::where('id',$upid)->get();
       return $upshow;
    }
    public function departUpdate(Request $req)
    {


        $update = departModel::where('id',$req->upid)->update([
            'departName'=>$req->updepart,
            'date'=>$req->update
        ]);

       return $update;
    }


    public function departDelete(Request $req)
    {
       $deleteId = $req->deleteid;

       $deleted = departModel::where('id',$deleteId)->delete();
       return $deleted;
    }

}
