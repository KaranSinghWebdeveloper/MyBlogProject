<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;

class BackendController extends Controller
{
    public function index(Request $search){
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')
        ->get();
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
            return view('backend/index', ['data' => $data, 'category' => $category,  'search' => $searchItem, 'searchValue' => $search , 'find' => $find]);
        }else{
            return view('backend/index', ['data' => $data, 'category' => $category,  'search' => '']);
        }
        
    }

    public function data(Request $data){
        $data->validate([
            'title' => 'required',
            'peragraph' => 'required',
            'category_id' => 'required',
            'image' => 'required|max:5000'
        ]);
        $post = new project;
        $post->title = $data['title'];
        $post->peragraph = $data['peragraph'];
        $post->category_id = $data['category_id'];
        $image = $data->file('image');
        if($image){
            $filename = $image->getClientOriginalExtension();
            $file = time().'.'.$filename;
            $image->move('image/', $file);
            $post->image = $file;
        }
        $post->save();
        if($post->save()){
            $session = session()->flash('success', 1);
            return back();
        }
    }

    public function category(){
        $category = category::all();
        return view('backend/category', ['category' => $category]);
    }
    public function Addcategory(Request $category){
        $category->validate([
            'category' => 'required'
        ]);
        $newCategory = new category;
        $newCategory->category = $category['category'];
        $newCategory->save();
        if($newCategory->save()){
            return redirect()->route('admin');
        }
    }

    public function categoryDelete($id){
        $categoryd = category::where('id', $id)->get();
        $category = category::all();
        $delete = category::where('id', $id)->delete();
        if($delete){
            $session = session()->flash('success', 1);
            return back();
        }
            return back();
    }

    public function deletePost($id){
        $delete = project::where('id', $id)->delete();
        if($delete){
            $session = session()->flash('delete', 1);
            return back();
        }else{
            $session = session()->flash('notDelete', 1);
            return back();
        }
    }

    public function updatePost($id){
        $updatePost = category::where('projects.id', $id)
        ->Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->get();
        $data = category::Join('projects', 'categorys.id', '=', 'projects.category_id')
        ->orderBy('projects.id', 'desc')
        ->get();
        $category = category::all();
        if($updatePost){
            return view('backend/index', [
                'update' => $updatePost,
                'data' => $data, 
                'category' => $category,  
                'search' => '']);
        }else{
            return back();
        }
    }

    public function updateNow(string $id, Request $data){
        $updateNow = project::where('id', $id)
        ->get();
        $oldImage = $updateNow[0]['image'];
        $data->validate([
            'title' => 'required',
            'peragraph' => 'required',
            'category_id' => 'required'
        ]);
        $post = project::find($id);
        $post->title = $data['title'];
        $post->peragraph = $data['peragraph'];
        $post->category_id = $data['category_id'];
        if($data->file('image')){
        $image = $data->file('image');
        if($image){
            $filename = $image->getClientOriginalExtension();
            $file = time().'.'.$filename;
            $image->move('image/', $file);
            $post->image = $file;
        }
        }else{
            $post->image = $oldImage;
        }

        $post->save();
        if($post->save()){
            $session = session()->flash('updatenow', 1);
            return redirect(route('admin'));
        }
    }

}
