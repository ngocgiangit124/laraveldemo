<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "LoaiTin";

    public function theloai()
    {
        return $this->belongsTo('App\TheLoai','idTheLoai','id');//belongsto thuoc the lai nao
    }

    public  function tintuc()
    {
        return $this->hasMany('App\Tintuc','idLoaiTin','id');
    }
}
