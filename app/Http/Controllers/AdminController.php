<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\post;
use App\Ward;
use App\Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = post::paginate(7);
        $district=District::all();
        $ward = Ward::all();
        return Posts::show($post,$district,$ward);
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
        $check = Posts::updateStatusPost($request->get('id'));
        return Response()->json('Đăng bài thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::findOrFail($id);
        $district = District::all();
        $ward = ward::all();
        $userPost= array();
        $districtWard= array();
        $idDistrict = $post->district->id;
        $idWard = $post->ward->id;
        foreach ($post->userPosts as $key => $value) {
            $userPost[$key] = $value->pivot->name;
            $userPost[$key+1] = $value->pivot->phone;
            $userPost[$key+2] = $value->pivot->address;
        }
        return view('Admin.updatePost',compact('post','district','ward','userPost','idDistrict','idWard','id'));
    }

    public function updatePost(Request $request){
        $user = \Auth::user();
        $data = $request->except('_token','name','phone','address');
        $post = post::findOrFail($request->get('id'));
        $data['status']=4;
        $post->update($data);
        $post->userPosts()->updateExistingPivot($user->id,['name'=>$request->get('name'),'phone'=>$request->get('phone'),'address'=>$request->get('address')]);
        return back()->with('success','Cập nhật bài viết thành công!');

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();        
        return Response()->json('Xóa thành công!');
    }
}


class Posts{

    public static function show($post,$district,$ward){
        return view('Admin.post',compact('district','post','ward'));
    }

    public static function updateStatusPost($id){
        $post = post::findOrFail($id);
        $post->status=1;
        $post->save();
    }


}

