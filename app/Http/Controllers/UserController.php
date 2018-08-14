<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function hasUser()
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return view("home");
        }
        return redirect("dashboard");
    }
    public function isUserForDashboard()
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return redirect("/");
        }
        $arr['id'] = session()->get('id');
        $res = User::where('id',$arr['id'])->select('first_name', 'last_name')->get();
        $arr['first_name'] = $res[0]['first_name'];
        $arr['last_name'] = $res[0]['last_name'];
        return view("dashboard", $arr);
    }
    public function isUserForArticles()
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return redirect("/");
        }
        $arr['id'] = session()->get('id');
        $res = User::where('id',$arr['id'])->select('first_name', 'last_name')->get();
        $arr['first_name'] = $res[0]['first_name'];
        $arr['last_name'] = $res[0]['last_name'];
        return view("articles", $arr);
    }
    public function isUserForTrain()
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return redirect("/");
        }
        $arr['id'] = session()->get('id');
        $res = User::where('id',$arr['id'])->select('first_name', 'last_name')->get();
        $arr['first_name'] = $res[0]['first_name'];
        $arr['last_name'] = $res[0]['last_name'];
        return view("train", $arr);
    }
    public function check(Request $req)
    {
        try {
            $email = $req->input('email');
            $password = $req->input('password');
            $arr = User::where('email', $email)->select('id', 'first_name', 'last_name', 'password')->get();
            if (Hash::check($password, $arr[0]['password'])) {
                session(['id' => $arr[0]['id']]);
                return response()->json(['data' => ['code' => '0', 'msg' => 'Signin success']]);
            } else {
                return response()->json(['data' => ['code' => '1', 'msg' => 'Incorrect password']]);
            }
        } catch (\Exception $e) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'User not exist']]);
        }
    }
    public function add(Request $req)
    {
        $arr = $req->only(['first_name', 'last_name', 'email', 'password', 'dob', 'mobile_no']);
        try {
            $count = User::where('email', $arr['email'])->count();
            if ($count == 0) {
                $arr['password'] = Hash::make($arr['password']);
                User::create($arr);
                return response()->json(['data' => ['code' => '0', 'msg' => 'Signup success']]);
            } else {
                return response()->json(['data' => ['code' => '1', 'msg' => 'Account already exist']]);
            }
        } catch (Exception $e) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Incorrect details']]);
        }
    }
    public function clear()
    {
        if (!session()->has('id')) {
            session()->flush();
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        }
        session()->flush();
        return response()->json(['data' => ['code' => '0', 'msg' => 'Signout success']]);
    }
    public function fetch(Request $req){
        $data=[];
        if($req->input('operation')=='select')
        $data['results']=DB::select($req->input('query'));
        else if($req->input('operation')=='update')
        $data['results']=DB::update($req->input('query'));
        else if($req->input('operation')=='insert')
        $data['results']=DB::insert($req->input('query'));
        else if($req->input('operation')=='delete')
        $data['results']=DB::delete($req->input('query'));
        return response()->json(['data' => $data]);
    }
}
