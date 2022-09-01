<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    //
    public function allPost(){
        $posts = Post::all();
        return response()->json([
            'posts' => $posts,
            'message' => 'Post',
            'code' => 200
        ]);
    }
  
    public function addPost(Request $request){
        $request->validate([
            'post_image' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
         ]);
       $file = $request->file('post_image');
       $name_gen = hexdec(uniqid());
       $img_ext = strtolower($file->getClientOriginalExtension());
       $file_name = $name_gen. '.'.$img_ext;
       $up_location = 'image/';
       $last_img= $up_location.$file_name;
       $file->move(public_path('image'), $file_name);
        $post = new Post();
        $post->post_title = $request->post_title;
        $post->post_category = $request->post_category;
        $post->post_content = $request->post_content;
        $post->post_image = $last_img;
        $post->post_author = $request->post_author;
        $post->post_tags = $request->post_tags;
        $post->post_status = $request->post_status;
       
        $post->save();
        return response()->json([
            'message' => 'Post created successfully',
            'code' => 200
        ]);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        
        if ($post) {
            $old_image = $post->post_image;
            unlink($old_image);
            $post->delete();
            return response()->json([
                'message' => 'Post deleted successfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Post with id:$id does not exist",
                'code' => 404
            ]);
        }
    }


    public function editPost($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function updatePost($id, Request $request){
        $post = Post::where('_id', $id)->first();
        $post->post_title = $request->post_title;
        $post->post_category = $request->post_category;
        $post->post_content = $request->post_content;
        $post->post_author = $request->post_author;
        $post->post_tags = $request->post_tags;
        $post->post_status = $request->post_status;
        if($post->post_image!= $request->post_image){
            $request->validate([
                'post_image' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
             ]);
           $file = $request->file('post_image');
           $name_gen = hexdec(uniqid());
           $img_ext = strtolower($file->getClientOriginalExtension());
           $file_name = $name_gen. '.'.$img_ext;
           $up_location = 'image/';
           $last_img= $up_location.$file_name;
           $file->move(public_path('image'), $file_name);
           
        } else {
            $last_img= $post->post_image;
        }
        $post->post_image= $last_img;
        $post->save();
        return response()->json([
            'message' => 'Contact updated successfully',
            'code' => 200
        ]);
    }

    
}
