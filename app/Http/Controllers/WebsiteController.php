<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Category;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $search){
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')->get();
        $resentPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')->limit(3)->get();
        $otherPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(6)->get();
        $viralPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(3)->get();
        $category = category::all();
        $search = $search['search'];
        if(!empty($search)){
            $searchItem = project::Join('categorys', 'projects.category_id', '=', 'categorys.id')
            ->where('title', 'LIKE', '%'.$search.'%' )
            ->orWhere('peragraph', 'LIKE', '%'.$search.'%')
            ->orWhere('category', 'LIKE', '%'.$search.'%')->get();

            if(count($searchItem) > 0){
                $find = '';
            }else{
                $find = 1;
            }
            return view('website/index', [
             'data' => $data,
             'otherPost' => $otherPost,
             'resentPost' => $resentPost, 
             'category' => $category,  
             'search' => $searchItem, 
             'searchValue' => $search,
             'viralPost' => $viralPost, 
             'find' => $find
            ]);
        }else{
            return view('website/index', [
             'data' => $data, 
             'otherPost' => $otherPost,
             'resentPost' => $resentPost, 
             'category' => $category, 
             'viralPost' => $viralPost, 
             'search' => ''
            ]);
        }
    }

    public function layout(){
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')
        ->get();
        $resentPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')->limit(3)->get();
        $otherPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(6)->get();
        $viralPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(3)->get();
        $category = category::all();
        return view('website/layout', ['data' => $data,'viralPost' => $viralPost, 'otherPost' => $otherPost,'resentPost' => $resentPost, 'category' => $category,  'search' => '']);
    }

    public function post($title){
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->where('projects.title', $title)->get();
        $category = category::all();
        $resentPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')->limit(3)->get();
        $otherPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(6)->get();
        $viralPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(3)->get();
        if(!empty($data)){
            echo $view = $data[0]['view'];
            $int = (int)$view;
            $viewid = $data[0]['id'];
            $datanew = $int+1;
            $post = project::find($viewid);
            $post->view = $datanew;
            $post->save();

            return view('website/post', ['data' => $data,'viralPost' => $viralPost, 'otherPost' => $otherPost,'resentPost' => $resentPost, 'category' => $category]);
        }
            return back();
    }

    public function category($category){
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->where('categorys.category', $category)->get();
        $resentPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')->limit(3)->get();
        $otherPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(6)->get();
        $viralPost = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->limit(3)->get();
        $category = category::all();
        if($data){
            return view('website/post', ['data' => $data,'viralPost' => $viralPost, 'otherPost' => $otherPost,'resentPost' => $resentPost, 'category' => $category]);
        }
            return back();
    }
}
