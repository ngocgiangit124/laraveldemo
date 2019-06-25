?
<!-- slider -->
<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators ">
                    <?php $i=0; ?>
                        @foreach($slide as $sl)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i==0) class="active" @endif ></li>
                    <?php $i++; ?>
                    @endforeach
                </ol>
            <div class="carousel-inner">
                <?php $i=0; ?>
                @foreach($slide as $sl)
                <div @if( $i ==0) class="item active" @else class = "item" @endif >
                <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="{{$sl->NoiDung}}">
                    <?php $i++; ?>
                </div>
                    @endforeach

                <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control carousel-control-prev" href="#carouselExampleIndicators" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end slide -->
