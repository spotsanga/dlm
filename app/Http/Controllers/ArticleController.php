<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function feeds(Request $req){
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code'] = '0';
        $data['articles']=Article::sortBy('created_at')->offset(0)->limit(30)->select('name','author','title','description','url','urlToImage','publishedAt')->get();
        return response()->json(['data' => $data]);
    }
}
