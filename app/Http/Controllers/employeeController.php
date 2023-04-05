<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\departModel;
use App\Models\employeeModel;

class employeeController extends Controller
{
    public function addemployee($value='')
    {

        $data = departModel::orderBy('id','desc')->get();
    	return view('addemployee',['dataKey'=>$data]);
    }


    public function viewemployee($value='')
    {
        $data = departModel::orderBy('id','desc')->get();
        return view('viewemployee',['dataKey'=>$data]);
    }


    public function createEmployee(Request $req)
    {
        $http = $_SERVER['HTTP_HOST'];
        $addimg = "http://".$http."/storage/img/";

        $file = $req->file('image');
        $addFileName = $addimg.time().'.'.$file->getClientOriginalExtension();
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/img',$fileName);

    	$create = employeeModel::insert([
            'name' => $req->name,
            'Department' => $req->depart,
            'selfid' => $req->selfid,
            'Phone' => $req->phone,
            'Email' => $req->email,
            'Office' => $req->office,
            'Road' => $req->road,
            'Status' => $req->status,
            'img' => $addFileName
        ]);

        if ($create == true) {
           return 1;
        }else{
            return 0;
        }
    }

 	public function showEmployee(Request $req)
    {
    	$show = employeeModel::all();
        return $show;
    }

    public function employeeUpShow(Request $req)
    {
    	$id = $req->id;

        $emupshow =  employeeModel::where('id',$id)->get();
        return $emupshow;
    }

 	public function employeeUpdate(Request $req)
    {

    	 if ($req->hasFile('emupimage')) {

            $file = $req->file('emupimage');

            $http = $_SERVER['HTTP_HOST'];
            $addimg = "http://".$http."/storage/img/";

            $UpaddFileName = $addimg.time().'.'.$file->getClientOriginalExtension();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/img',$fileName);

            $updatePreImg = $req->emuppreImg;
            $updateExplode = explode('/', $updatePreImg);
            $updateEnd = end($updateExplode);
            Storage::delete('public/img/'.$updateEnd);
           

            $update = employeeModel::where('id',$req->emupid)->update([
                'name'=>$req->upname,
                'Department'=>$req->updepart,
                'selfid'=>$req->upselfid,
                'Phone'=>$req->upphone,
                'Email'=>$req->upemail,
                'Office'=>$req->upoffice,
                'Road'=>$req->uproad,
                'Status'=>$req->upstatus,
                'img'=>$UpaddFileName
            ]);

        }else{
            $update = employeeModel::where('id',$req->emupid)->update([
                'name'=>$req->upname,
                'Department'=>$req->updepart,
                'selfid'=>$req->upselfid,
                'Phone'=>$req->upphone,
                'Email'=>$req->upemail,
                'Office'=>$req->upoffice,
                'Road'=>$req->uproad,
                'Status'=>$req->upstatus
            ]);
        }

        return $update;
    }

    
	public function employeeDelete(Request $req)
    {

            $deleteId = $req->deleteid;
           $delete = employeeModel::find($deleteId);
           $deleteImg = $delete->img;

           $explode = explode('/',$deleteImg);
           $deleteimgEnd = end($explode);

          if (Storage::delete('public/img/'.$deleteimgEnd)) {
            $dataDelete = employeeModel::destroy($deleteId);
          }
          return $dataDelete;



    }


}
