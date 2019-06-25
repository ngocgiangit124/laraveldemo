<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "TheLoai";

    public function loaitin()
    {
        return $this->hasMany('App\LoaiTin','idTheLoai','id');//hasMany
    }

    public  function tintuc()
    {
        return $this->hasManyThrough('App\Tintuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }

}
