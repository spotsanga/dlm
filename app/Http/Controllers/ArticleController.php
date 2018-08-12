<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\ArticleToCategoryMapping;
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
        $data['articles']=Article::offset(0)->limit(30)->select('name','author','title','description','url','urlToImage','publishedAt')->get();
        return response()->json(['data' => $data]);
    }
    public function datasets(Request $req){
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code'] = '0';
        $data['articles']=Article::whereNotIn('id',ArticleToCategoryMapping::select('article_id')->get())->offset(0)->limit(10)->select('articles.id as id','title','description','url')->get();
        $data['categories']=Category::select('id','category')->get();
        return response()->json(['data' => $data]);
    }
    public function categorize(Request $req){
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code']=0;
        $data['message']='success';
        $data['id']=$req->input('categories')[0]['article_id'];
        foreach($req->input('categories') as $category){
            try{
                ArticleToCategoryMapping::create($category);
            }catch(\Exception $e){}
        }
        return response()->json(['data'=>$data]);
    }
}
