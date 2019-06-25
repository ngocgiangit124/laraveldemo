<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user =User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem()
    {
        return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,[
           'Ten'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password'
        ],[
            'Ten.required'=>'Ban chua nhap ten',
            'Ten.min'=>'ten nguoi phai it hon 3 ky tu',
            'email.required'=>'ban nhap chua nhap email',
            'email.email'=>'ban chua nhap dung dinh dang email',
            'email.unique'=>'Email tồn tại',
            'password.required'=>'ban chua nhap password',
            'password.min'=>'mat khau it nhat  ki tu',
            'password.max'=>'mat khau chi dc it hon 32 ky tu',
            'passwordAgain.required'=>'ban chua nhap lai mat kau',
            'passwordAgain.same'=>'mat khau nhapp lai chua khop'

        ]);
        $user = new User;
        $user -> name = $request->Ten;
        $user -> email= $request->email;
        $user -> password =bcrypt($request->password);
        $user ->quyen = $request->quyen;
        $user ->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,[
            'Ten'=>'required|min:3',

        ],[
            'Ten.required'=>'Ban chua nhap ten',
            'Ten.min'=>'ten nguoi phai it hon 3 ky tu',


        ]);
        $user =  User::find($id);
        $user -> name = $request->Ten;
        $user ->quyen = $request->quyen;
        if($request->changePassword == "on")
        {
            $this->validate($request,[
                'password'=>'required|min:6|max:32',
                'passwordAgain'=>'required|same:password'
            ],[

                'password.required'=>'ban chua nhap password',
                'password.min'=>'mat khau it nhat  ki tu',
                'password.max'=>'mat khau chi dc it hon 32 ky tu',
                'passwordAgain.required'=>'ban chua nhap lai mat kau',
                'passwordAgain.same'=>'mat khau nhapp lai chua khop'

            ]);
            $user -> password =bcrypt($request->password);
        }


        $user ->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sua thành công');
    }

    public function getXoa($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','ban da xoa thanh cong');
    }
    public function getdangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:6|max:32',

        ],[
            'email.required'=>'ban chua nhap email',
            'password.required'=>'ban chua nhap password',
            'password.min'=>'ko nho hon 6',
            'password.max'=>'ko lon hon 32'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','dang nhap ko thanh cong');
        }
    }

    public function getDangXuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }

}
