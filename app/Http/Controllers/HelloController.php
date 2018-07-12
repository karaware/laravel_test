<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;

class HelloController extends Controller
{
    public function index(Request $request)
    {
         return view('hello.index', ['msg'=>'フォーム入力して']);
    }

    public function post(HelloRequest $request)
    {
         return view('hello.index', ['msg'=>'正しくにゅう六されました']);
    }
}
/*
    public function index(Request $request)
    {
    //    return view('hello.index', ['msg'=>'フォームを入力 : ']);
        $validator = Validator::make($request->query(),[
            'id' => 'required',
            'pass' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力してください。';
        }
        return view('hello.index', ['msg'=>$msg, ]);
    }

    public function post(Request $request)
    {
        //$validator = Validator::make($request->all(),[
        $rules = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric',
        ];
        $messages = [
            'name.required' => '名前必ず入力',
            'mail.email' => 'メルアド必要',
            'age.numeric' => '年齢は数字',
            'age.max' => '300歳まで',
            'age.min' => '0歳まで',
        ];
        //バリデーション実行
        $validator = Validator::make($request->all(),$rules,$messages);

        $validator->sometimes('age', 'min:0', function($input){
            return !is_int($input->age);
        });
        $validator->sometimes('age', 'max:300', function($input){
            return !is_int($input->age);
        });

        if($validator->fails()){
            return redirect('/hello')
                ->withErrors($validator)
                ->withInput();
        }
        return view('hello.index',['msg'=>'正しく入力されました!!!']);
    }
    public function test()
    {
        return '<html><body><h1>Hello</h1><p>This is sample page.</p></body></html>';
    }

    
}
