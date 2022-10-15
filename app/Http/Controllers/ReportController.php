<?php

namespace App\Http\Controllers;

use App\Models\ProvinceCity;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;




class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::where('id',Session::get('admin_id'))->first();
        
        if($user->user_type==1){
            
            return redirect()->back();
        }
        $provinces= ProvinceCity::where('parent', 0)->get();
        return view('admin.report.user.index',compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        
        $results=User::where('province',$request->province)->where('small_province',$request->small_province)->where('sexuality',$request->sexuality)->get();
        if($request->typeOfReport==0){
            return view('admin.report.user.show',compact('results'));
    
        }
        

        if($request->typeOfReport==1){
            // $pdf = Pdf::loadView('admin.report.users-pdf',['results'=>$results]);
            // return $pdf->download('users-pdf.pdf');
            return view('admin.report.user.show',compact('results'));

        }
        if($request->typeOfReport==2){

            return (new UsersExport)-> forProvince($request->province)->forSmallProvince($request->small_province)->forSexuality($request->sexuality)->download('invoices.xlsx');
           
           
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function export($data) 
    {
        return Excel::download(new UsersExport($data), 'users.xlsx');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
