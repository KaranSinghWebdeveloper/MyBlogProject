<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Apicreate;

class ApiController extends Controller
{
    public function index(){
        $dbdata = Apicreate::all();

        $data = [
            'status' => 200,
            'dbdata' => $dbdata
        ];

        return response()->json($data, 200);
    }

    public function upload(Request $data){
        $validdata = $data->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10'
        ]);
        $post = new Apicreate;
        $post->name = $data['name'];
        $post->email = $data['email'];
        $post->phone = $data['phone'];
        $post->save();

        if($post->save()){
            return response()->json(['message' => 'Data Store Successfully'], 200);
        }else{
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    }

    public function update(Request $data, $id){
        $post = Apicreate::find($id);
        $validdata = $data->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10'
        ]);

        $post->name = $data['name'];
        $post->email = $data['email'];
        $post->phone = $data['phone'];
        $post->save();

        if($post->save()){
            return response()->json(['message' => 'Data Store Successfully'], 200);
        }else{
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    }

    public function selectWithId($id){
        $post = Apicreate::find($id);

        if(!empty($post)){
            return response()->json($post, 200);
        }else{
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    }

}
