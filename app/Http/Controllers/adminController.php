<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loginModel;
use App\Models\departModel;
use App\Models\employeeModel;
use carbon\carbon;



class adminController extends Controller
{
    public function admin($value='')
    {
      $departCount = departModel::count();
      $empCount = employeeModel::count();
      $userCount = loginModel::count();


      $departdateData = departModel::select('id','date')->get()->groupBy(function($data)
       {
         return carbon::parse($data->date)->format('M');
       });

       $departmounts = [];
       $departmountCount = [];
       foreach ($departdateData as $departDateKey => $departdatevalue) {
           $departmounts[]=$departDateKey;
           $departmountCount[]=count($departdatevalue);
       }

      $employeedateData = employeeModel::select('id','created_at')->get()->groupBy(function($data)
       {
         return carbon::parse($data->created_at)->format('M');
       });

       $empmounts = [];
       $empmountCount = [];
       foreach ($employeedateData as $empDateKey => $empdatevalue) {
           $empmounts[]=$empDateKey;
           $empmountCount[]=count($empdatevalue);
       }




    	return view('home',[
        'departCount'=> $departCount,
        "emploCount"=>$empCount,
        "userCooutn"=> $userCount,
        "departMounts"=> $departmounts,
        "departMountCount"=>$departmountCount,
        'empmounts'=>$empmounts,
        'empmountCount'=>$empmountCount
      ]);
    }

    public function login($value='')
    {
    	return view('login');
    }

      public function userlogin(Request $req){

          $user = $req->UserId;
          $pass = $req->userPass;

          $data = loginModel::where('userId',$user)->where('password',$pass)->count();
          if ($data == 1) {
          $req->session()->put('userKey',$user);
           return 1;
          } else {
            return 0;
          }
          
      }

      public function logout(Request $req)
      {
        $req->session()->flush();
        return view('login');
      }
}
