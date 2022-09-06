<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function allComments(){
        $comments= Comment::all();
        return response()->json([
            'comments' => $comments,
            'code'=>200,
            'message'=>'Comments'
        ]);
    }
    
    public function addComment(Request $request){
        $comment = new Comment();
        $comment->comment_content = $request->comment_content;
        $comment->comment_post_id = $request->comment_post_id;
        $comment->comment_post_title = $comment->post->post_title;
        $comment->comment_user_id = $request->comment_user_id;
        $comment->comment_user_name = $comment->user->name;
        $comment->comment_status = $request->comment_status;  
        
  
        $comment->save();
        return response()->json([
            'message' => 'Comment created successfully',
            'code' => 200
        ]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        
        if ($comment) {
           
            $comment->delete();
            return response()->json([
                'message' => 'Comment deleted successfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Comment with id:$id does not exist",
                'code' => 404
            ]);
        }
    }

    public function updateComment($id, Request $request){
        $comment = Comment::where('_id', $id)->first();
        $comment->comment_status = $request->comment_status;
      
        $comment->save();
        return response()->json([
            'message' => 'Comment status updated successfully',
            'code' => 200
        ]);
    }


 

    public function searchComment($data) {
        $data = Comment::where('comment_content','LIKE','%'.$data.'%')->get();
        return response()->json($data);

    }
}
