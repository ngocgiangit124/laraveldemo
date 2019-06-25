@extends('layuot.index')

@section('content')
<div class="container">

@include('layuot.slide')

    <div class="space20"></div>


    <div class="row main-left">
        @include('layuot.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
                </div>

                <div class="panel-body">
                    @foreach($theloai as $tl)
                        @if(count($tl->loaitin ) > 0)
                            <!-- item -->
                            <div class="row-item row"   >
                                <h3>
                                    <a href="">{{$tl->Ten}}</a>
                                    @foreach($tl->loaitin as $lt)
                                    <small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
                                    @endforeach
                                </h3>
                                <?php
                                $data = $tl->tintuc ->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                                $tinone = $data->shift();//lay 1 tin ra lay theo mang nen gan cung theo mang
                                ?>
                                <div class="col-md-8 border-right">
                                    <div class="col-md-5">
                                        <a href="tintuc/{{$tinone['id']}}/{{$tinone['TieuDeKhongDau']}}.html">
                                            <img class="img-responsive" src="upload/tintuc/{{$tinone['Hinh']}}" alt="">
                                        </a>
                                    </div>

                                    <div class="col-md-7">
                                        <h3>{{$tinone['TieuDe']}}</h3>
                                        <p>{{$tinone['TomTat']}}</p>
                                        <a class="btn btn-primary" href="tintuc/{{$tinone['id']}}/{{$tinone['TieuDeKhongDau']}}.html">Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    @foreach($data->all() as $tintuc)
                                    <a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
                                        <h4>
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            {{$tintuc['TieuDe']}}
                                        </h4>
                                    </a>
                                    @endforeach

                                </div>

                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection;
