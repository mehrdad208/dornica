<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProvinceCity;
use Illuminate\Http\Request;

class smallProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $province=ProvinceCity::where('id',$id)->first();
        return view('admin.province.showAddSmallProvince', compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        ProvinceCity::create([
            'title' => $request->small_province,
            'parent' => $id
        ]);
        return redirect()->route('admin.province.index')->with('success','small province created ');
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
        $smallProvince=ProvinceCity::where('id',$id)->first();
        return view('admin.province.showEditSmallProvince', compact('smallProvince'));

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
        $smallProvince=ProvinceCity::where('id',$id)->first();
       $smallProvince->update([
            'title' => $request->small_province
        ]);
        return redirect()->route('admin.province.index')->with('success','small province updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProvinceCity $smallProvince)
    {
        $smallProvince->delete();
        return redirect()->route('admin.province.index')->with('success','small province destroy');
    }

   
}
