<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use App\Models\Admin;


class IndexController extends Controller
{
    public function index()
    {
        //return view('login');
        return View::make('login');
    }

    public function login_process(Request $request)
    { 
        if ($request->has('login')) 
        {
            $tid = $request->input('tid');
            $password = $request->input('password');
            //     //get the user with the email
            // $query = "SELECT * FROM `admin` WHERE `tid` = '$tid' AND password='".md5($password)."'";
            // $result = DB::SELECT($query);
            $query = DB::table('admin as id')
                            ->where('tid', $tid)
                            ->where('password', md5($password))
                            ->count();
            $result = DB::table('admin as id')
                            ->where('tid', $tid)
                            ->Where('password', md5($password))
                            ->get();
            if ($query > 0 )
            {
                $request->session()->put('tid',$tid);
                $request->session()->put('department',$result[0]->department);
                    $id = $request->input('tid');
                    $tid = DB::table('admin as id')
                            ->where('id.tid', $id)
                            ->first();
                    return redirect('admin/')->with(['tid' => $tid]);
            }else
            {
                $request->session()->flush();
                return redirect('/')->with('alert','THE LOGIN YOU HAVE ENTERED IS INCORRECT! ');
            }
        }
    }

    public function redirect_to_login()
    {
        return redirect('/');
    }




}
