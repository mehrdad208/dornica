<?php

namespace App\Http\Controllers;

use App\Models\ProvinceCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Arr;

use Charts;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('admin.province.show', compact('provinces'));

    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProvinceCity::create($request->all());
        return redirect()->route('admin.province.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = ProvinceCity::where('id', $id)->first();
        $smallProvinces = ProvinceCity::where('parent', $id)->get();
        return view('admin.province.showSmallProvince', compact('smallProvinces', 'province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province=ProvinceCity::where('id',$id)->first();
        return view('admin.province.edit', compact('province'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {       
        $province=ProvinceCity::where('id',$id)->first();
        $province->update([
            'title' => $request->title
        ]);
        return redirect()->route('admin.province.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $province=ProvinceCity::where('id',$id)->first();
        $province->delete();

        return redirect()->route('admin.province.index');
    }

    public function barCharts($id){
        $province=ProvinceCity::where('id',$id)->first();
        $users=User::where('user_type',0)->where('province',$province->id)->get();
        $smallProvinces=ProvinceCity::where('parent',$id)->get();

       $arrays=[];
                foreach($smallProvinces as $smallProvince){
                    $count=User::where('small_province',$smallProvince->id)->count();
                    array_push($arrays,[$smallProvince->title,$count]);
                    }
               
                    foreach($arrays as $key => $value){
                        $values[]=$value;
 
                     }
                    foreach($values as $value){
                        $keys[]=$value[0];
                        $results[]=$value[1];

                    }
                    
                    return  view('admin.province.barCharts',compact('keys','results','province'));
                   
                }
              
       
    
}
