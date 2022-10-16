<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories=PostCategory::all();

        return view('admin.post.create',compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->all();
        $inputs['author_id']=Session::get('admin_id');
        if ($file = $request->file('image')) {

            if ($file->getSize() <= 409600) {
                $result = $this->uploadImages($file, 'posts/' .Session::get('admin_id'));
                $inputs['image'] = $result;
                $post=Post::create($inputs);

                return redirect()->route('admin.post.index')->with('sucess','post created');
            } else {
                return redirect()->route('admin.post.create')->with('error','image size not grather 200 kb');
            }
        }
     
    }

    public function uploadImages($file, $path)
    {
        if ($file) {

            $filename = $file->getClientOriginalName();
            $file->move(public_path('Images/' . $path), $filename);
        }
        return 'Images/'.$path.'/'.$filename;
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
        $post=Post::where('id',$id)->first();
        $postCategories=PostCategory::all();
        return view('admin.post.edit',compact('post','postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('admin.post.index')->with('success','post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index')->with('success','post deleted');
    }

   
}
