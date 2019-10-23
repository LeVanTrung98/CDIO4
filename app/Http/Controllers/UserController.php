<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\post;
use App\District;
use Mail;
use App\Mail\sendRegisterUser;
class UserController extends Controller
{   
    public function noAccept(Request $request){
        $post = $request->get('post');
        $user = $request->get('user');
        post::find($post)->userRents()->updateExistingPivot($user,['status'=>5]);
        $updatePost = post::find($post);
        $updatePost->status=1;
        $updatePost->save();
        return Response()->json('Đã hủy chấp nhận thành công!');
    }
    public function accept(Request $request){
            $post = $request->get('post');
            $user = $request->get('user');
            $updatePost = post::find($post);
            if($updatePost->status!=3){
                $updatePost->userRents()->updateExistingPivot($user,['status'=>4]);
                $updatePost->status=3;
                $updatePost->save();
                return Response()->json('Cho thuê thành công!');
            }
            else return Response()->json(['failer'=>'Trọ đã được cho thuê!']);
        }
    public function Come(Request $request){
        $post = $request->get('post');
        $user = $request->get('user');
        post::find($post)->userRents()->updateExistingPivot($user,['status'=>2]);
        $updatePost = post::find($post);
        $updatePost->status=1;
        $updatePost->save();
        return Response()->json('Thao tác thành công!');
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('formLogin');
    }
    public function showFormLogin(){
        $district = District::all();
        return view('User.login',compact('district'));
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ],
        [
            'email.required'=>'Email not null!',
            'password.required'=>'Password not null!',
            'password.min'=>'Password than 6 character!',
            'emai.emai'=>'Email is not correctly!'
        ]
        );
        // dd($request->all());
        if(User::where('email','=',$request->get('email'))->first()){
            if(\Auth::attempt(['email'=>$request->get('email'),'password'=>$request->get('password')])){
                $user = User::findOrFail(\Auth::user()->id);
                $check=1;
                foreach ($user->infringes as $key => $value) {
                    if($value->status==2){
                        $check = 2;
                        break;
                    }
                }
                if($check==1){
                    if(\Auth::user()->role == 1){
                        return redirect('http://cdio4.com/'.$request->get('path'));
                    }
                    if(\Auth::user()->role == 2){
                        return view('Admin.home');
                    }
                }else{
                    return redirect()->route('formLogin')->with('errorK','Tài khoản của bạn đã bị khóa vì đã vi phạm quy định!'); 
                }
            }
            else{
                return back()->with('errorP','Password is not correct!');
            }
        }else{
            return back()->with('error','Email is not exists!');
        }
    }
    // return view checkout auth
    public function registerUser(){
        return view('User.checkout');
    }

    public function checkRegisterUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ],
        [
            'email.required'=>'Email not null!',
            'password.required'=>'Password not null!',
            'password.min'=>'Password than 6 character!',
            'emai.emai'=>'Email is not correctly!'
        ]
        );
        if(User::where('email','=',$request->get('email'))->first()){
            $pass = User::where('email','=',$request->get('email'))->first('password');
            if(\Hash::check($request->get('password'),$pass->password)){
                User::where('email','=',$request->get('email'))->update(['status'=>2]);
                return redirect()->route('formLogin')->with('success','Tài khoản bạn đã được kích hoạt');
            }else{
                return back()->with('errorP','Password is not correct with Password old!');
            }
        }else{
            return back()->with('error','Email is not exists!');
        }
    }

    public function showUser(){
        $userid = \Auth::user();
        $user = User::find($userid->id);
        $date=array();
        $idPost = array();
        foreach ($user->rentPosts as $key => $value){
            // if($value->pivot->status==4 || $value->pivot->status==5){
                $date[$key]=$value->pivot->created_at;
                $idPost[$key]=$value;
            // }
            
        }
        $house=array();
        foreach ($user->postUsers as $key => $value) {
                $house[$value->id]=$value;
        }
        $justRent = array_combine($date,$idPost);
        // dd($house);
        $district =District::all();

        return view('User.userRents',compact('justRent','house','district'));
    }

    public function showDetail($id){
        $post = post::find($id);
        $rent=array();
        $district=District::all();
        foreach ($post->userRents as $key => $value) {
            $rent[$key]=$value;
        }
        // dd($rent);
        return view('User.detailUser',compact('rent','district'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.register');
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
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required|numeric',
            'password'=>'required|min:6'

        ],
        [
            'name.required'=>'Name not null!',
            'email.required'=>'Email not null!',
            'password.required'=>'Password not null!',
            'password.min'=>'Password than 6 character!',
            'address.required'=>'Address not null!',
            'phone.required'=>'Phone not null!',
            'phone.numeric'=>'Phone is number!',
            'phone.min'=>'Phone than more 9 number!',
            'phone.max'=>'Phone less 11 number!',
            'email.email'=>'Email is not correctly!'
        ]);
        $data = $request->all();
        $data['status'] = 1;
        $data['password']=bcrypt($request->get('password'));
        if(User::where('email','=',$request->get('email'))->first()==null){
            User::create($data);
            // $time= getDate();
            // dd($time['minutes']+30);
            Mail::to($request->get('email'))->send(new sendRegisterUser($request->get('name')));
            return back()->with('notificationS','Vui lòng kiểm tra Email để tiếp tục!');
        }else{
            return back()->with('notificationF','Tài khoản đã tồn tại!');
        }
        
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
        
        $post = post::findOrFail($id);
        $post->status=1;
        $post->save();
        $post->userRents()->updateExistingPivot(\Auth::user()->id,['status'=>6]);
        return Response()->json('Bạn đã hủy giữ trọ thành công!');
    }
}
