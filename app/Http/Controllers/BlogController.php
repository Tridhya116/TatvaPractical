<?php

namespace App\Http\Controllers;
use App\Blog;
use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs= Blog::get();
        return view('blog.index',compact('blogs'));
    }
    public function create(){

        return view('blog.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:65535',
            'image' => 'required|max:100|mimes:jpg,jpeg,png,bmp,tiff',
            'tags' => 'required|array|min:1'
        ]);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $imageName=NULL;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
  
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        $tags=NULL;
        if(!empty($request->tags) && isset($request->tags[0]) && $request->tags[0] != NULL){
            $tags=json_encode($request->tags);
        }
        else{
            return redirect()->route('blog.create')->with('error','Atleast one blog Tag is required!')->withInput();

        }
          $blog->tags=$tags;
          $blog->image = $imageName;
          $blog->user_id=Auth::id();
    
          $blog->save();
          return redirect()->route('blogs')->with('success','Your blog has been saved successfully!');

    }
    public function delete($id){
        $blog= Blog::where('id',$id)->delete();
        return redirect()->route('blogs')->with('success','Your blog has been deleted successfully!');
    }
    public function edit($id){

        $blog= Blog::where('id',$id)->first();
        return view('blog.edit',compact('blog'));
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:65535',
            'tags' => 'required|array|min:1',
            'image' => 'max:100|mimes:jpg,jpeg,png,bmp,tiff'
        ]);
        $blog = Blog::where('id',$request->id)->first();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $imageName=$blog->image;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
  
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        $tags=NULL;
      
        if(!empty($request->tags) && isset($request->tags[0]) && $request->tags[0] != NULL){
            $tags=json_encode($request->tags);
        }
        else{
            return redirect()->back()->with('error','Atleast one blog Tag is required!')->withInput();

        }
          $blog->tags=$tags;
          $blog->image = $imageName;
          $blog->user_id=Auth::id();
    
          $blog->save();
          return redirect()->route('blogs')->with('success','Your blog has been updated successfully!');

    }
}
