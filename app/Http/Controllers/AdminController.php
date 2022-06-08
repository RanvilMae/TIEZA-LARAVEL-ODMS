<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use View;
use DB;
use mysqli;
use App\Models\Admin;
use App\Models\Files;
use App\Models\Department;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Status;
use App\Models\Remarks;
use App\Models\Subfiles;
use Carbon;
use PDF;
use Redirect;
use File;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
        $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString(); 
       return View::make('Admin-side/admin')->with(['tid' => $tid, 'month' => $month, 'date' => $date, 'department' => $department]);
    }

    public function home_admin(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $tiezaid = $tid->tid;
            $department = $tid->department;
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->count();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            return view('Admin-side/home_admin')->with(['tid' => $tid, 'files' => $archive, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date, 'tags' => $tags]);
    }

     public function upload(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $ttid = $tid->tid;
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->count();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $ttid)
                    ->count();
            $primary_id =  DB::table('files as id')
                    ->orderBy('id', 'DESC')
                    ->count();
            $primaryid =  DB::table('files as id')
                    ->orderBy('id', 'DESC')
                    ->first();
            $iid = 1;
            if($primary_id == 0){
                $add_id = $iid ;
            }else{
                $add_id = $primaryid->id + $iid ;
            }
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            $depts = Department::orderBy('department')->get();
            $category = Category::orderBy('category')->get();
            return View::make('Admin-side/upload')->with(['tid' => $tid, 'files' => $archive, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date, 'mytime' => $mytime, 'month' => $month, 'date' => $date, 'depts' => $depts, 'category' => $category, 'tags' => $tags, 'primary_id' => $primary_id, 'add_id' => $add_id]);
    }

    public function uploadprocess(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }

         if ($request->has('submit')) 
         {
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $ttid = $tid->tid;
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            $mydate = date('Ymd');
            $depts = Department::orderBy('department')->get();
            $category = Category::orderBy('category')->get();
            $id = $request->session()->get('department');
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->count();
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
                    $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $ttid)
                    ->count();
            $department = $tid->department;
            $newdocu_id = $request->input('docu_id') ;
            $newdepartment = $request->input('department') ;

            $newtid = $request->input('tid');
            $newrestriction = $request->input('restriction');
            $newclassification = $request->input('classification');
            $newdate = $request->input('date');
            $newforw = $request->input('forw');
            $newfromw = $request->input('fromw');
            $newcategory = $request->input('category');
            $newpages = $request->input('pages');
            $newsubject = $request->input('subject');
            $newmyfile = $request->file('myfile')->storeAs('public/my_uploads/'.$department.'/',$request->file('myfile')->getClientOriginalName());

            $name = $request->file('myfile')->getClientOriginalName();
            $filename = DB::table('files as f')
                    ->where('f.name', $name)
                    ->count();
            if($filename > 0){
                $message = "FILE ALREADY EXISTS! ";
                return View::make('Admin-side/upload', compact('message'))
                    ->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'newdocu_id' => $newdocu_id, 'newsubject' => $newsubject, 'add_id' =>'0']);
            }


            $newproject = new Files;
            $newproject->id  = NULL;
            $newproject->docu_id = $newdepartment.''.$mydate.'-'.$newdocu_id ;
            $newproject->department = $newdepartment;
            if ($newrestriction == NULL) {
                $newproject->restriction = "OUTGOING";
            }else{
                $newproject->restriction = $newrestriction;
            }
            $newproject->classification = $newclassification;
            $newproject->date = $newdate;
            $newproject->forw = $newforw;
            $newproject->fromw = $newfromw;
            $newproject->category = $newcategory;
            $newproject->pages = $newpages;
            $newproject->subject = $newsubject;
            $newproject->name = $request->file('myfile')->getClientOriginalName();
            $newproject->save() or die('ERROR ADDING NEW PROJECT!');

            $tagging = DB::table('admin as id')
                            ->where('position', 'Secretary')
                            ->get();
            
        
            $message='FILE SUCCESSFULLY UPLOADED! \n\nPLEASE SELECT EMPLOYEE TO BE TAGGED! ';
            return View::make('Admin-side/tagging',compact('message'))->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'newsubject' => $newsubject, 'newdocu_id' => $newdocu_id, 'newrecord_id' => $newdepartment.''.$mydate.'-'.$newdocu_id, 'tagging' => $tagging]);


         }
         else{
                $message = "ERROR UPLOADING FILE/S!";
               return View::make('Admin-side/upload',compact('message'))->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'qrCode' => $qrCode]);
         }
    }

    public function save_tag(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
        if ($request->has('save')) 
         {
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $ttid = $tid->tid;
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            $mydate = date('Ymd');
            $depts = Department::orderBy('department')->get();
            $category = Category::orderBy('category')->get();
            $status = Status::orderBy('status')->get();
            $id = $request->session()->get('department');
            $files = DB::table('files as id')
                    ->where('department', $department)
                    ->count();
            $tid = DB::table('admin as id')
                    ->where('department', $id)
                    ->first();
            $archive = DB::table('archive as id')
                    ->where('department', $department)
                    ->count();
                    $admin = DB::table('admin as id')
                    ->where('department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('tag', $ttid)
                    ->count();
            $department = $tid->department;
            $newsubject = $request->input('subject') ;
            $newid = $request->input('id') ;
            $newdocu_id = $request->input('docu_id') ;
            $newtid = $request->input('tid');
            $newdate = $request->input('date');
            $newtags = $request->input(['selector']);

            $newaction = $request->input(['action']);
                $error  = 0;
                $N = count($newtags);

                
                for($i=0; $i < $N; $i++)

                {
                    $check  = DB::table('tags as id')
                            ->where('tag', $newid )
                            ->orWhere('tag', $newtags[$i])
                            ->count();

                    if($check > 0)
                    {
                       $message = 'TAGGING EXIST!';
                        return View::make('Admin-side/remarks',compact('message'))->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'status' => $status, 'newdocu_id' => $newdocu_id, 'newsubject' => $newsubject, 'newid' => $newid]);
                        
                    }
                    else
                    {
                        $newtag = new Tags;
                        $newtag->primary_id  = NULL;
                        $newtag->id = $newid ;
                        $newtag->tag = $newtags[$i];
                        $newtag->date = $mytime;
                        $newtag->action = $newaction;
                        $newtag->docu_id = $newdocu_id;
                        $result = $newtag->save() or die('ERROR ADDING NEW PROJECT!');
                          if(!$result)
                            {
                                $error++;
                            }
                            
                    }
                }
                if($error == 0)
                    {
                        $message = 'TAGGING SUCCESSFULLY UPLOADED! \n\nPLEASE ADD DOCUMENT STATUS!';
                        return View::make('Admin-side/remarks',compact('message'))->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'status' => $status, 'newdocu_id' => $newdocu_id, 'newsubject' => $newsubject, 'newid' => $newid]);
                    }
                    
                }
  }

 public function pdfqr(){
        return view('view_qr_code');
    }


  public function save_addremarks(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
        if ($request->has('save')) 
         {
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $ttid = $tid->tid;
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            $mydate = date('Ymd');
            $depts = Department::orderBy('department')->get();
            $category = Category::orderBy('category')->get();
            $status = Status::orderBy('status')->get();
            $id = $request->session()->get('department');
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->count();
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
                    $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $ttid)
                    ->count();
            $newdepartment = $tid->department;
            $newsubject = $request->input('subject') ;
            $newid = $request->input('id') ;
            $qrCode = $request->input('qr_Code') ;
            $newtid = $request->input('tid');
            $newdate = $request->input('date');
            $newstatus = $request->input('status');
            $newremarks = $request->input('remarks');

            $newaction = $request->input(['action']);

               
                        $newtag = new Remarks;
                        $newtag->primary_id  = NULL;
                        $newtag->id = $newid ;
                        $newtag->remarks = $newremarks;
                        $newtag->date = $mytime;
                        $newtag->action = $newaction;
                        $newtag->status = $newstatus;
                        $newtag->tid = $newtid;
                        $newtag->department= $newdepartment;
                        $result = $newtag->save() or die('ERROR ADDING NEW PROJECT!');
                       
                        $message = 'STATUS SUCCESSFULLY SAVED!';
                        $user = Files::find($qrCode);
                        
                        return View::make('Admin-side/addremarks', compact('message'))
                            ->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'mytime' => $mytime, 'tags' => $tags, 'id' => $id, 'newdocu_id' => $id, 'id' => $id, 'status' => $status, 'newsubject' => $newsubject, 'month' => $month, 'date' => $date, 'newid' => $newid]);
                    
                        
                }
    }



    public function save_sub(Request $request){

        if($request->session()->get('department')==null){
        return redirect('/');
        }

        if ($request->has('submit')) 
         {

            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();

                $newsubject = $request->input('subject');
                $newdocu_id = $request->input('docu_id');
                $newdepartment = $request->input('department');
                $newsub_docu = $request->input('sub_docu');
                $newremarks = $request->input('remarks');
                $newpages   = $request->input('pages');
                $newmyfile = $request->file('myfile')->storeAs('public/subfiles/'.$newdepartment.'/',$request->file('myfile')->getClientOriginalName());
                $newaction  = $request->input('action');
                $newdate = $request->input('date');
                $mytime = Carbon\Carbon::now();

                $name = $request->file('myfile')->getClientOriginalName();
                if($name > 0)
                {
                    $message = "FILE ALREADY EXISTS! ";
                }

                $newproject = new Subfiles;
                $newproject->primary_id  = NULL;
                $newproject->id  = $newdocu_id;
                $newproject->name  = $request->file('myfile')->getClientOriginalName();
                $newproject->sub_docu  = $newsub_docu;
                $newproject->date  = $mytime;
                $newproject->remarks  = $newremarks;
                $newproject->department  = $newdepartment;
                $newproject->pages  = $newpages;
                $newproject->action  = $newaction;
                $newproject->subject  = $newsubject;
                $newproject->track  = '0';
                $newproject->viewed  = NULL;
                $newproject->save() or die('ERROR ADDING NEW PROJECT!');
            
            $tiezaid = $request->input('tid');
            $department = $request->input('department');
            $newid = $request->input('docu_id');
            $record_id = $request->input('record_id');

            $files = DB::table('files as id')
                    ->where('docu_id', $record_id)
                    ->orderBy('date', 'DESC')
                    ->first(); 

            $status = DB::table('status as id')
                    ->orderBy('status')
                    ->get();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();

            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();

                $message='SUBFILE SUCCESSFULLY UPLOADED!  ';
                return View::make('Admin-side/subfile',compact('message'))->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'mytime' => $mytime, 'tags' => $tags, 'id' => $id, 'newdocu_id' => $id, 'id' => $id, 'status' => $status, 'newsubject' => $newsubject, 'month' => $month, 'date' => $date, 'newid' => $newid, 'record_id' => $record_id]);
         }
    }



    public function save_remarks(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
        if ($request->has('save')) 
         {
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $department = $tid->department;
            $ttid = $tid->tid;
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            $mydate = date('Ymd');
            $depts = Department::orderBy('department')->get();
            $category = Category::orderBy('category')->get();
            $status = Status::orderBy('status')->get();
            $id = $request->session()->get('department');
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->count();
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
                    $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $ttid)
                    ->count();
            $newdepartment = $tid->department;
            $newsubject = $request->input('subject') ;
            $newid = $request->input('id') ;
            $qrCode = $request->input('qr_Code') ;
            $newtid = $request->input('tid');
            $newdate = $request->input('date');
            $newstatus = $request->input('status');
            $newremarks = $request->input('remarks');
            $newaction = $request->input(['action']);
                $newtag = new Remarks;
                $newtag->primary_id  = NULL;
                $newtag->id = $newid ;
                $newtag->remarks = $newremarks;
                $newtag->date = $mytime;
                $newtag->action = $newaction;
                $newtag->status = $newstatus;
                $newtag->tid = $newtid;
                $newtag->department= $newdepartment;
                $result = $newtag->save() or die('ERROR ADDING NEW PROJECT!');
                       
                $message = 'STATUS SUCCESSFULLY SAVED!';
                    
                $pdf = PDF::loadView('Admin-side/pdfqr', compact('newdepartment', 'qrCode' , 'files', 'newid'))->setPaper('a4', 'portrait');
            
                $url =  $pdf->stream("qrCode.pdf",array("Attachment" => false));
                        
                }
  }



    public function redirect_to_login(){
        return redirect('/');
    }

    public function viewdata(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $tiezaid = $tid->tid;
            $department = $tid->department;
            $files = DB::table('files as id')
                    ->where('id.department', $department)
                    ->orderBy('id', 'DESC')
                    ->limit(50)
                    ->get();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();
            
            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            return View::make('Admin-side/viewdata')->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date, 'tags' => $tags]);
    }

    public function remarks(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $tiezaid = $tid->tid;
            $department = $tid->department;
            $record_id = $request->input('record_id');
            $files = DB::table('files as id')
                    ->where('docu_id', $record_id)
                    ->orderBy('date', 'DESC')
                    ->first();

            $newsubject = $files->docu_id;
            $newid = $files->id;

            $status = DB::table('status as id')
                    ->orderBy('status')
                    ->get();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();

            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            return View::make('Admin-side/remarks')->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'mytime' => $mytime, 'tags' => $tags, 'id' => $id, 'newdocu_id' => $id, 'id' => $id, 'status' => $status, 'newsubject' => $newsubject, 'month' => $month, 'date' => $date, 'newid' => $newid]);
    }


    public function tagging(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }

        $id = $request->session()->get('department');
        $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
        $department = $tid->department;
        $ttid = $tid->tid;
        $mytime = Carbon\Carbon::now();
        $month = $mytime->toFormattedDateString();
        $date = $mytime->toTimeString();
        $mydate = date('Ymd');
        $depts = Department::orderBy('department')->get();
        $category = Category::orderBy('category')->get();
        $id = $request->session()->get('department');
        $files = DB::table('files as id')
            ->where('id.department', $department)
            ->count();
        $tid = DB::table('admin as id')
            ->where('id.department', $id)
            ->first();
        $archive = DB::table('archive as id')
            ->where('id.department', $department)
            ->count();
        $admin = DB::table('admin as id')
            ->where('id.department', $department)
            ->count();
        $users = DB::table('users as id')
            ->where('id.department', $department)
                    ->count();
        $tags = DB::table('tags as id')
            ->where('id.tag', $ttid)
            ->count();
        $tagging = Admin::all();

        $newdocu_id = $request->input('id');
        $get_files = DB::table('files as id')
            ->where('id', $newdocu_id)
            ->first();
        $get_tags = DB::table('tags as id')
            ->where('id', $newdocu_id)
            ->get();
        $newsubject = $get_files->subject;
        $newrecord_id = $get_files->docu_id;
        $record_id = $request->input('id');
        return View::make('Admin-side/tagging')->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'month' => $month, 'date' => $date,  'tags' => $tags, 'mytime' => $mytime, 'depts' => $depts, 'category' => $category, 'newdocu_id' => $newdocu_id,  'newrecord_id' => $newrecord_id, 'newsubject' => $newsubject, 'tagging' => $tagging ,'add_id' =>'0', 'get_tags' => $get_tags]);

    }


    public function subfile(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $tiezaid = $tid->tid;
            $department = $tid->department;
            $record_id = $request->input('record_id');
            $files = DB::table('files as id')
                    ->where('docu_id', $record_id)
                    ->orderBy('date', 'DESC')
                    ->first();

            $newsubject = $files->docu_id;
            $newid = $files->id;

            $status = DB::table('status as id')
                    ->orderBy('status')
                    ->get();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();

            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            return View::make('Admin-side/subfile')->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'mytime' => $mytime, 'tags' => $tags, 'id' => $id, 'newdocu_id' => $id, 'id' => $id, 'status' => $status, 'newsubject' => $newsubject, 'month' => $month, 'date' => $date, 'newid' => $newid, 'record_id' => $record_id]);
    }



    public function addremarks(Request $request)
    {
        if($request->session()->get('department')==null){
        return redirect('/');
        }
            $id = $request->session()->get('department');
            $tid = DB::table('admin as id')
                    ->where('id.department', $id)
                    ->first();
            $tiezaid = $tid->tid;
            $department = $tid->department;
            $record_id = $request->input('record_id');
            $files = DB::table('files as id')
                    ->where('docu_id', $record_id)
                    ->orderBy('date', 'DESC')
                    ->first();

            $newsubject = $files->docu_id;
            $newid = $files->id;

            $status = DB::table('status as id')
                    ->orderBy('status')
                    ->get();
            $archive = DB::table('archive as id')
                    ->where('id.department', $department)
                    ->count();
            $admin = DB::table('admin as id')
                    ->where('id.department', $department)
                    ->count();
            $users = DB::table('users as id')
                    ->where('id.department', $department)
                    ->count();
            $tags = DB::table('tags as id')
                    ->where('id.tag', $tiezaid)
                    ->orWhere('id.track', 0)
                    ->count();

            $mytime = Carbon\Carbon::now();
            $month = $mytime->toFormattedDateString();
            $date = $mytime->toTimeString();
            return View::make('Admin-side/addremarks')->with(['tid' => $tid, 'files' => $files, 'archive' => $archive, 'admin' => $admin, 'users' => $users, 'department' => $department, 'mytime' => $mytime, 'tags' => $tags, 'id' => $id, 'newdocu_id' => $id, 'id' => $id, 'status' => $status, 'newsubject' => $newsubject, 'month' => $month, 'date' => $date, 'newid' => $newid]);
    }


  public function generatePDF( Request $request)
    {

        $id = $request->input('id');
        $remarks = DB::table('remarks as id')
                    ->where('id', $id)
                    ->get();
        $files = DB::table('files as id')
                    ->where('id', $id)
                    ->first();

        $pdf = PDF::loadView('Admin-side/pdf_status', compact('remarks' , 'files'))->setPaper('a4', 'landscape');
            
        return $pdf->stream("invoice.pdf",array("Attachment" => false));
          
    
    }

    public function generatePDF_subfile( Request $request)
    {

        $id = $request->input('id');
        $subfiles = DB::table('subfiles as id')
                    ->where('id', $id)
                    ->get();
        $files = DB::table('files as id')
                    ->where('id', $id)
                    ->first();

        $pdf = PDF::loadView('Admin-side/pdf_subfile', compact('subfiles' , 'files'))->setPaper('a4', 'landscape');
            
        return $pdf->stream("invoice.pdf",array("Attachment" => false));
          
    
    }

    public function viewfile( Request $request)
    {

        $name = $request->input('name');
        $pdf = PDF::loadView('Admin-side/viewfile', compact('name' ))->setPaper('a4', 'portrait');
        return $pdf->stream($name,array("Attachment" => false));
          
    
    }


    public function update_file( Request $request)
    {

        if($request->session()->get('department')==null){
        return redirect('/');
        }

        if ($request->has('submit')) 
        {
            $id = $request->id;
            $department = $request->department;
            $newmyfile = $request->file('myfile');
            
            if ($newmyfile == NULL) {
               dd('NONE');
            }else
            {
                $newmyfile = $request->file('myfile')->getClientOriginalName();
                $files = DB::table('files as id')
                    ->where('name', $newmyfile)
                    ->orWhere('id', $id)
                    ->count();
                if ($files > 0) 
                {

                    $filename  = $newmyfile;
                    $destination = 'public/my_uploads/'.$department.'/'.$filename;

                    $path = storage_path().'/app/public/my_uploads/'.$department.'/'.$filename;
                      if(File::exists($path)){
                          unlink($path);
                      }

                   $newmyfile = $request->file('myfile')->storeAs('public/my_uploads/'.$department.'/',$request->file('myfile')->getClientOriginalName());

                          echo"FILE UPLOADED";

                }
            }
            
        }
          
    
    }






    public function logout(Request $request)
        {
            $request->session()->flush();
            return redirect('/');
        }
    
}
