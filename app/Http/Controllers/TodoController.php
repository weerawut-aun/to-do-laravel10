<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    function index() {
        $todos = DB::table('todos')->get();
        return view('welcome',compact('todos'));
    }

    function insert(Request $request) {
      
        $request->validate([
            'title'=>'required|max:50',
            'description'=>'required'
        ],[
            'title.required'=>'กรุณาป้อนข้อความลงในช่อง title',
            'description.required'=>'กรุณาป้อนข้อความลงในช่อง description'
        ]);

        $data= [
            'title'=>$request->title,
            'description'=>$request->description
        ];

       DB::table('todos')->insert($data);

        return redirect('/');
    }

    function done($id) {
        $todo = DB::table('todos')->where('id',$id)->first();

        $data=[
            'isDone'=>!$todo->isDone
        ];


        DB::table('todos')->where('id',$id)->update($data);
       
        return redirect('/');
       
    }

    function cancel($id){
        DB::table('todos')->where('id',$id)->delete();
        return redirect('/');

    }
}
