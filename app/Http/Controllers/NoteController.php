<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function notes(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code'] = '0';
        $res = Note::where('user_id', session()->get('id'));
        if ($res) {
            $data['notes'] = $res->select('id', 'title', 'description', 'updated_at')->get();
            $data['msg'] = 'Notes Retrival success';
        }
        return response()->json(['data' => $data]);
    }
    public function add(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        try {
            $arr = $req->only(['title', 'description']);
            $arr['user_id'] = session()->get('id');
            Note::create($arr);
            return response()->json(['data' => ['code' => '0', 'msg' => 'Note added']]);
        } catch (\Exception $e) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Incorrect details']]);
        }
    }
}
