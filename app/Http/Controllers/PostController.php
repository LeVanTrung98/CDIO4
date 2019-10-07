<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use App\District;
use App\ward;
use App\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district = District::all();
        $ward = ward::all();
        return view('User.post',compact('district','ward'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'images'=>'required|image|mimes:jpg,png,jpeg',
            'title'=>'required',
            'content'=>'required',
            'area'=>'required|numeric',
            'price'=>'required|numeric',
            'address1'=>'required',
            // 'electric'=>'numeric',
            // 'water'=>'numeric',
            'ward'=>'required',
            'district'=>'required'
        ],[
            'title.required'=>'Title not null!',
            'district.required'=>'District not null!',
            'ward.required'=>'Award not null!',
            'images.required'=>'File Image not null!',
            'images.mimes'=>'Images path is not correct!',
            'content.required'=>'Content not null!',
            'area.required'=>'Area not null!',
            'price.required'=>'Price not null!',
            'price.numeric'=>'Price is number!',
            'area.numeric'=>'Area is number!',
            // 'electric.numeric'=>'Electric is number!',
            // 'water.numeric'=>'Water is number!',
            'address1.required'=>'Address not null!',

        ]);

        // xử lý ảnh
        $img = $request->file('images')->getClientOriginalExtension();
        $nameImage = time().".".$img;

        $data = $request->except('images','address','district','ward','address1','name','phone','_token');
        $address = $request->get('address');
        $name = $request->get('name');
        $phone = $request->get('phone');
        $user = \Auth::user();
        $data['status']=1;
        $data['address']=$request->get('address1');
        $data['id_ward']=$request->get('ward');
        $data['id_district']=$request->get('district');
        if(!empty($address) && !empty($name) && !empty($phone)){
            $insert = post::create($data);
            post::find($insert->id)->userPosts()->attach($user->id,['name'=>$name,'phone'=>$phone,'address'=>$address]);
            Image::create(['path'=>$nameImage,'post_id'=>$insert->id]);
            $request->file('images')->move('upImage',$nameImage);
            return back()->with('success','Đăng bài thành công!');
        }else{
            $insert = post::create($data);
            post::findOrFail($insert->id)->userPosts()->attach($user->id,['name'=>$user->name,'phone'=>$user->phone,'address'=>$user->address]);
            Image::create(['path'=>$nameImage,'post_id'=>$insert->id]);
            $request->file('images')->move('upImage',$nameImage);
            return back()->with('success','Đăng bài thành công!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::findOrFail($id);
        if($post->status==2) return redirect()->back()->with('notification','Trọ đang được giữ');
        if($post->status==3) return redirect()->back()->with('notification','Trọ đã được thuê');    
        if($post->status==1){
            $post['status']=2;
            $post->save();
            return redirect()->back()->with('notification','Bạn đã giữ thành công');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
