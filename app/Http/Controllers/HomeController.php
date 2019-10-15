<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\User;
use App\District;

class HomeController extends Controller
{
    public function searchDistrict($id){
        $idDistrict = District::findOrFail($id);
        // $post = $idDistrict->posts;
        $district = District::all();
        $near= post::orderBy('id','desc')->take(10)->get();
        $nearPost=array();
        foreach ($near as $key => $value) {
            foreach ($value->images as $key => $val) {
                $nearPost[$value->id]=$val->path;
            }
        }
        $post = post::where('id_district',$id)->get();
        return view('User.home',compact('post','district','nearPost'));
    }

    public function search(Request $request){
        $data = $request->get('data');
        $post = post::where('title','like','%'.$data.'%')->orWhere('price','like','%'.$data.'%')->orWhere('address','like','%'.$data.'%')->get();
        $district = District::all();
        $near= post::orderBy('id','desc')->take(10)->get();
        $nearPost=array();
        foreach ($near as $key => $value) {
            foreach ($value->images as $key => $val) {
                $nearPost[$value->id]=$val->path;
            }
        }
        // dd($post->get('title'));
        return view('User.home',compact('post','district','nearPost'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = post::where('status','!=',4)->get();
        $district = District::all();
        $near= post::orderBy('id','desc')->take(10)->get();
        $nearPost=array();
        foreach ($near as $key => $value) {
            foreach ($value->images as $key => $val) {
                $nearPost[$value->id]=$val->path;
            }
        }
        return view('User.home',compact('post','district','nearPost'));
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
        $post = post::findOrFail($id);
        $postUser = $post->userPosts;
        $name='';
        $phone='';
        $address='';
        foreach ($postUser as $key => $value) {
            $name = $value->pivot->name;
            $address = $value->pivot->address;
            $phone = $value->pivot->phone;
        }
        $img="";
        foreach ($post->images as $key => $value) {
            $img = $value->path;
        }
        // kiểm tra user đã chọn chưa
        $check=2;
        if(\Auth::check()){
            $user = \Auth::user();
            $userCheck = User::find($user->id);
            foreach ($userCheck->rentPosts as $key => $value) {
                if($value->pivot->status==1){
                    $check=1;
                }
            }
        }else{
            $check =2;
        }
        // xem thêm

        $postMore = post::orderBy('id','desc')->take(9)->get();
        $district = District::all();
        return view('User.detail',compact('district','post','name','phone','address','img','postMore','check'));
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
