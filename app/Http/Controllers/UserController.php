<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //
    public function allUsers(){
        $users= User::all();
        return response()->json([
            'users' => $users,
            'code'=>200,
            'message'=>'Users'
        ]);
    }
    
    public function addUser(Request $request){
       
     
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;  
        $user->password= Hash::make($request->password);
  
        $user->save();
        return response()->json([
            'message' => 'User created successfully',
            'code' => 200
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if ($user) {
           
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "User with id:$id does not exist",
                'code' => 404
            ]);
        }
    }


    public function editUser($id)
    {
        // $user = User::find($id);
        $user = DB::table('users')->where('_id',$id)->get()->first();
        return response()->json($user);
    }

    public function updateUser($id, Request $request){
        $user = User::where('_id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;  
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'code' => 200
        ]);
    }

    public function searchUser($data) {
        $data = User::where('name','LIKE','%'.$data.'%')->get();
        return response()->json($data);

    }
}
