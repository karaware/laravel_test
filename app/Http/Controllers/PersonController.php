<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }

    public function find(Request $request)
    {
        //$item = Person::where('name', $request->input)->first();
        //$param = ['input' => $request->input, 'item' => $item];
        //return view('person.find', $param);
        return view('person.find',['input' => '']);
    }

    public function search(Request $request)
    {
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
        //$item = Person::where('name', $request->input)->first();
        //$param = ['input' => $request->input, 'item' => $item];
        //return view('person.find', $param);
        //$item = Person::find($request->input);
        //$param = ['input' => $request->input, 'item' => $item];
        //return view('person.find', $param);
    }
}
