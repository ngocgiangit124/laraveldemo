<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem()
    {
        $theloai =TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request)
    {


         echo  $request->Ten;
        $this->validate($request,[
            'Ten'=> 'required|unique:Loaitin,Ten|min:3|max:100|unique:Theloai',
            'Theloai'=>'required'
        ],[
            'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten.unique'=>'Tên loại tin đã tòn tại',
            'Ten.min'=>'Ten Độ dài phải nhiều nhơn 3 ký tự',
            'Ten.max'=>'Ten Độ dài phải ít nhơn 100 ký tự',
            'Theloai.unique'=>'Bạn chưa chọn thể loại'
        ]);

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheloai = $request->Theloai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin],['theloai'=>$theloai]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function postSua(Request $request, $id)
    {
        echo  $request->Ten;
        $this->validate($request,
            [
            'Ten'=> 'required|unique:Loaitin,Ten|min:3|max:100|unique:Theloai',
            'Theloai'=>'required'
            ],[
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.unique'=>'Tên loại tin đã tòn tại',
                'Ten.min'=>'Ten Độ dài phải nhiều nhơn 3 ký tự',
                'Ten.max'=>'Ten Độ dài phải ít nhơn 100 ký tự',
                'Theloai.unique'=>'Bạn chưa chọn thể loại'
            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau =changeTitle($request->Ten);
        $loaitin->idTheloai = $request->Theloai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin ->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
}
