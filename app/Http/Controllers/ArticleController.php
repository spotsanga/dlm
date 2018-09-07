<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleToCategoryMapping;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function feeds(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $page = $req->input('page') - 1;
        $data['code'] = '0';
        $data['articles'] = Article::join('article_to_category_mapping as A', 'A.article_id', '=', 'articles.id')
            ->join('categories as C', 'A.category_id', '=', 'C.id')
            ->orderBy('publishedAt', 'desc')
            ->offset($page * 21)->limit(12)
            ->select('source', 'author', 'title', 'description', 'url', 'urlToImage', 'publishedAt','category')->get();
        return response()->json(['data' => $data]);
    }
    public function datasets(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code'] = '0';
        $data['articles'] = Article::whereNotIn('id', ArticleToCategoryMapping::select('article_id')->get())->orderBy('publishedAt', 'desc')->offset(0)->limit(10)->select('id', 'title', 'description', 'url')->get();
        $data['categories'] = Category::select('category')->get();
        return response()->json(['data' => $data]);
    }
    public function categorize(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data['code'] = 0;
        $data['message'] = 'success';
        $data['id'] = $article_id = $req->input('article_id');
        foreach ($req->input('categorized_list') as $category) {
            try {
                $category_id = Category::firstOrCreate(['category' => $category['category']])['id'];
                ArticleToCategoryMapping::create(['article_id' => $article_id, 'category_id' => $category_id]);
            } catch (\Exception $e) {
                $data['code'] = 1;
                $data['message'] = $e;
                break;
            }
        }
        return response()->json(['data' => $data]);
    }
}
