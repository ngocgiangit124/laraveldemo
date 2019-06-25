<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    function __construct()
    {
        $theloai =TheLoai::all();
        $slide = slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);

//        if(Auth::ckeck())
//        {
//            view()->share('nguoidung',Auth::user());
//        }

    }


    function trangchu()
    {

        return view('pages.trangchu');
    }
    function lienhe()
    {

        return view('pages.lienhe');

    }
    function loaitin($id)
    {
        $loaitin=LoaiTin::find($id);
        $tintuc =TinTuc::where('idLoaiTin',$id)->paginate(5);//phan trang
        return view('pages.loaitin',['loaitin'=>$loaitin],['tintuc'=>$tintuc]);
    }
    function tintuc($id)
    {
        $tintuc= TinTuc::find($id);
        $tinnoibat =TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan=TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangNhap()
    {
        return view('pages.dangnhap');
    }
    function postDangNhap(Request $request)
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
            return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao','Dang Nhap ko thanh cong');
        }
    }
    function getDangXuat()
    {
        Auth::logout();
       return redirect('trangchu');
    }
}
