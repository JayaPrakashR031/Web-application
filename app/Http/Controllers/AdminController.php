<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
//use App\Models\Customer;
use App\Models\post;
use App\Models\User;
use App\Models\SessionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
  public function index(){
    return view('index');
  }
    public function view(){
        $url = url('/createpost');
        $title = "post";
        $post = '';
        $data = compact('url','post','title');
        return view('postform')->with($data);
    }
    public function create(PostRequest $request){
      $data = $request->validated();
        $post = new post;
        $id= session()->getId();
        $user = SessionModel::find($id);
        $post->name = $data['name'];
        $post->author = $data['author'];
        $post->summary = $data['summary'];
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename =time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
        }else{
            $post->image = "image";
        }
        $count =$user->post_count+1;
        $user->save();
        Session::put('count',$count);

        $post->save();
        return redirect('/viewpost');
    }
    public function postView(){
      $users = post::paginate(2);
        $data = compact("users");
        return view("postview")->with($data);
    }
    public function edit($id)
    {
        $post =post::find($id);
        $url = url('/update') . '/' . $id;
        $title = "Update Post";
        $data = compact('url', 'post','title');
        return view('postform')->with($data);
    }
    public function update(PostRequest $request, $id)
    {
        $data = $request->validated();

        $post = post::find($id);
        $post->name = $data['name'];
        $post->author = $data['author'];
        $post->summary = $data['summary'];
        if($request->hasfile('image')){
            $destination = 'uploads/posts/'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename =time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
        }
        $post->update();

        return redirect('/viewpost');
    }
    public function destroy($id)
    {

        $post = post::find($id);
        if($post)
        {
            $destination = 'uploads/posts/'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);

            }
            $post->delete();
            return redirect('/viewpost')->with('message', 'Category Deleted Successfully');
        }
        else{
            return redirect('/viewpost')->with('message', 'No Category Id Found');
        }

    }

}
