<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        //クエリビルダ
        $items = DB::table('people')->get();
        return view('hello.index', ['items' => $items]);
        //SQLそのまま記述
//        $items = DB::select('select * from people');
//        return view('hello.index', ['items' => $items]);
    }

    public function post(Request $request)
    {
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('hello.add');
    }

    public function create(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')
          ->insert($param);
        return redirect('/hello');
    }

    public function edit(Request $request)
    {
        $item = DB::table('people')->where('id', $request->id)->first();
        return view('hello.edit', ['form' => $item]);
    }

    public function update(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')->where('id', $request->id)->update($param);
        return redirect('/hello');
    }

    public function del(Request $request)
    {
       $item = DB::table('people')->where('id',$request->id)->first();
       return view('hello.del', ['form' => $item]);
    }

    public function remove(Request $request)
    {
        $param = ['id' => $request->id];
        DB::table('people')->where('id', $request->id)->delete();
        return redirect('/hello');
    }


    public function show(Request $request)
    {
        //$min = $request->min;
        //$max = $request->max;
        $items = DB::table('people')
                   ->offset(2)
                   ->limit(2)
                   ->get();
        return view('hello.show', ['items' => $items]);
    }
}
/*
        $name = $request->name;
        $items = DB::table('people')
                   ->where('name', 'like', '%' . $name . '%')
                   ->orWhere('mail', 'like', '%' . $name . '%')
                   ->get();
        return view('hello.show', ['items' => $items]);
    }

}
*/

/*
        if (isset($request->id)) {
            $param = ['id' => $request->id];
            $items = DB::select('select * from people where id = :id',$param);
        } else {
            $items = DB::select('select * from people');
        }
        return view('hello.index', ['items' => $items]);

//         $items = DB::select('select * from people');
//         return view('hello.index', ['items' => $items]);
    }
*/
/*
    public function post(HelloRequest $request)
    {
         return view('hello.index', ['msg'=>'正しくにゅう六されました']);
    }
}
*/
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
