@extends('layout.layout')

@section('title','Asset')

@section('content')
    <section class="section section-lg bg-default" style="margin-top: 15%">
        <div class="container container-bigger product-single">
            <div class="row row-fix justify-content-sm-center justify-content-lg-between row-30 align-items-lg-center">
                <div class="col-lg-5 col-xl-6 col-xxl-5">
                    @if(strcmp($asset[0]->data[0]->media_type,"image") == 0)
                        <img style=" display: block; margin-top: 20px; margin-bottom: 20px; margin-left: auto; margin-right: auto;" class="img-thumbnail rounded" src="{{$media}}" alt="">
                    @else
                        <audio controls>
                            <source src="{{$media}}" type="audio/mpeg">
                        </audio>
                    @endif
                </div>
                <div class="col-lg-7 col-xl-6 col-xxl-6 text-center text-lg-left">

                    <h3 style="font-family:'Lato'; font-weight: 400;font-size: 28px;"><b>
                            @if($asset[0]->data[0]->title)
                                {{$asset[0]->data[0]->title}}
                            @endif
                        </b></h3>
                    <div class="divider divider-default"></div>

                    <p class="text-spacing-sm" style="font-size: 16px" >
                        @if(strcmp($asset[0]->data[0]->media_type,"image") == 0)
                            @if($asset[0]->data[0]->description)
                                {{$asset[0]->data[0]->description }}
                            @endif
                        @endif
                    </p>
                    <ul class="list-group" style="font-family:'Lato';  margin-top: 35px; margin-bottom: 20px; font-weight: 400;font-size: 19px;">
                        @if($asset[0]->data[0]->date_created)
                            <li class="list-group-item">Date Created: {{ $asset[0]->data[0]->date_created }}</li>
                        @endif
                        @if($asset[0]->data[0]->center)
                            <li class="list-group-item">Centre: {{ $asset[0]->data[0]->center }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection