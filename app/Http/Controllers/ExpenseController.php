<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expenses(Request $req)
    {
        if (!session()->has('id') || !User::find(session()->get('id'))) {
            return response()->json(['data' => ['code' => '1', 'msg' => 'User not exist']]);
        } else if (session()->get('id') != $req->input('id')) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Session Expired']]);
        }
        $data = [];
        $data['code'] = '0';
        $res = Expense::where('user_id', session()->get('id'));
        if ($res) {
            $data['expenses'] = $res->select('id', 'category', 'money_spent', 'spent_at_date','spent_at_time','spent_at_merediem')->get();
            $data['msg'] = 'Expenses retrival success';
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
            $expense = $req->only(['category', 'money_spent', 'spent_at_date','spent_at_time','spent_at_merediem']);
            $expense['user_id'] = session()->get('id');
            $items = $req->input('items');
            $items_len = count($items);
            $expense_id = Expense::create($expense)['id'];
            foreach ($items as $item) {
                $item['expense_id'] = $expense_id;
                Item::create($item);
            }
            return response()->json(['data' => ['code' => '0', 'msg' => 'Expense added']]);
        } catch (Exception $e) {
            return response()->json(['data' => ['code' => '2', 'msg' => 'Incorrect details']]);
        }
    }
}
