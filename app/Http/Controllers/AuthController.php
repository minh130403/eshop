<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:6'],
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if($user->level_id ===  1 ) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            } 
            else {
                $request->session()->regenerate();
                 return redirect('/');
            }
        }
 
        return back()->with('error', 'Incorrect account or password');
    }



    public function register(Request $request){
        $validateData = $request->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:5',
            ]
        );

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make( $validateData['password']),
         ]);

        $user->level_id = 2;
        $user->save();

        return redirect('/admin/login')->with('mess', 'Register done!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


    public function gotoUsers()
    {
        $users = User::paginate(10);
    
        return view('user.index', [
            'page_group' => 'user',
            'users' => $users
         ]);
    }

    /**
     * Delete a user 
     * @param \App\Models\User $user 
     * 
     * @return \Illuminate\Http\Response
     */

    public function deleteUser(User $user)
    {
        $user->delete();
        
        return back();
    }

    /**
     * Update state of a user
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateState(Request $request,User $user)
    {
        $user->level_id = $request->input('state');

        $user->save();

        return back();
    }
    

    
    public function multipleDelete(Request $request) {
        $validateData = $request->validate([
            'id_arrays' => ['array'] // Thêm 'required' để tránh dữ liệu rỗng
        ]);
    
        if (empty($validateData['id_arrays'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không có user nào được chọn!'
            ], 400);
        }
    
        // Lấy danh sách user trước khi xóa (nếu cần log)
        $users = User::whereIn('id', $validateData['id_arrays'])->get();
    
        // Thực hiện xóa user
        $deleted = User::whereIn('id', $validateData['id_arrays'])->delete();
    
        if ($deleted > 0) { // Kiểm tra xem có user nào bị xóa không
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thành công!',
                'deleted_count' => $deleted,
                'deleted_users' => $users
            ], 200);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Không thể xóa người dùng!'
        ], 500);
    }


    public function updateMultiple(Request $request){
        $validateData = $request->validate(
            
        );
    }
}
