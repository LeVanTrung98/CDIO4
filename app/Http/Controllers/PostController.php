<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use App\District;
use App\ward;
use App\Image;
use App\User;
use App\Infringe;
use App\Jobs\changeStatus;
class PostController extends Controller
{
    public function userUpdatePost(Request $request){
        $idPost = $request->get('idPost');
        $request->validate([
            // 'images'=>'required|image|mimes:jpg,png,jpeg',
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
            'content.required'=>'Content not null!',
            'area.required'=>'Area not null!',
            'price.required'=>'Price not null!',
            'price.numeric'=>'Price is number!',
            'area.numeric'=>'Area is number!',
            'address1.required'=>'Address not null!',

        ]);
        $data = $request->except('_token','idPost','name','phone','address');

        $post =post::findOrFail($idPost);
        $user = \Auth::user();
        $address = $request->get('address');
        $name = $request->get('name');
        $phone = $request->get('phone');

        if($post->status == 4 ){
            $post->update($data);
            // $post->Images();
            // dd($)
            // Image::update(['path'=>$nameImage,'post_id'=>$insert->id]);
            $post->userPosts()->updateExistingPivot($user->id,['name'=>$name,'phone'=>$phone,'address'=>$address]);
            // $request->file('images')->move('upImage',$nameImage);
            return back()->with('success','Update bài thành công!');
        }
        if($post->status == 1){
            $data['status']=4;
            $post->update($data);
            $post->userPosts()->updateExistingPivot($user->id,['name'=>$name,'phone'=>$phone,'address'=>$address]);
            return back()->with('success','Update bài thành công!');
        }


    }

    public function formUpdate($id){
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

        return view('User.userUpdatePost',compact('post','district','ward','userPost','idDistrict','idWard','id'));
    }
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
        $data['status']=4;
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

    // giữ trọ
    public function edit($id)
    {   $user = \Auth::user();
        $post = post::findOrFail($id);
        if($post->status==2) return $notification='Trọ đang được giữ';
        if($post->status==3) return $notification='Trọ đã được thuê';    
        if($post->status==1){
            $dem=0;
            $users = User::findOrFail($user->id);
            foreach ($users->rentPosts as $key => $value) {
                $now = now();
                $diff = $now->diff($value->pivot->created_at);
                if($diff->d <= 30){// kiểm tra trong 1 tháng infringe quá 3 lần ko
                    if($value->pivot->status==3){
                        $dem++;
                    }
                }
            }
            if($dem == 3){
                $data['user_id']=$user->id;
                $data['status']=2;
                Infringe::create($data);
                $district=District::all();
                $ward = ward::all();
                return redirect('logout')->with('errorK','Tài khoản của bạn đã bị khóa');
            }
            if($dem == 2){
                $data['user_id']=$user->id;
                $data['status']=1;
                Infringe::create($data);
            }
            $post->status=2;
            $post->save();
            $post->userRents()->attach($user->id,['status'=>1]);
            $new = (new changeStatus($id,$user->id))->delay(now()->addMinutes(1));
            dispatch($new);
            return back();
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
        $check = post::find($id);
        if($check==1){
            $check['status']=2;
            $check->save();
        }
        dd($check);
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
