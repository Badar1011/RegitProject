@extends('layout.layout')

@section('title','Homepage')

@section('content')

    <h1 style="margin-top: 10%">NASA Search</h1>

    <form method="post" action="/">
        @csrf
        <div class="form-group">
            <input type="search" class="form-control {{ $errors->has('search') ? "is-invalid" : "" }}" name="search" id="search" value="{{ old('search') }}" aria-describedby="searchbar" placeholder="Apollo 11" required>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>

        <div class="form-check">
            <input type="checkbox" value="image" class="form-check-input" name="checkbox[]" id="images">
            <label class="form-check-label" for="images">Images</label>
        </div>
        <div class="form-check">
            <input type="checkbox" value="audio" class="form-check-input" name="checkbox[]" id="audio">
            <label class="form-check-label" for="audio">Audio</label>
        </div>
        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
   @if($assets)
        <div class="row">
            @foreach($assets as $asset)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card" style="margin-top: 30px; margin-bottom: 20px; background-color: whitesmoke" >
                        <div class="thumbnail" style="padding-top: 40px; padding-left: 25px; padding-right: 25px; padding-bottom: 10px">
        {{--       @if(strcmp($asset->data[0]->media_type,"image") == 0)
                  <img style=" display: block; margin-top: 20px; margin-bottom: 20px; margin-left: auto; margin-right: auto;" class="img-thumbnail rounded" src="{{$asset->links[0]->href}}" alt="">
              @else

              @endif --}}
              <div class="card-body">
                 <a href="/asset/{{$asset->data[0]->nasa_id}}">
                     <h5 style="font-family:'Lato'; font-weight: 400;font-size: 24px;">{{ $asset->data[0]->title }}</h5>
                 </a>
              </div>
          </div>
      </div>
  </div>
@endforeach
</div>
@endif

@endsection