@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>Images</h3>
                            </div>
                            <div>
                                <form class="form-inline">
                                    <div class="mr-2 font-weight-bold"> Sort By </div>
                                    <select class="form-control">
                                        <option>Oldest</option>
                                        <option>Latest</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-row-reverse" >
                            <form action="/" method="GET" role="search" class="  ">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" placeholder="Search"
                                        style="border-color: #80ccff;" class="input-group-btn">
                                    <button type="submit" class="btn btn-outline-info ml-2">
                                        <span class="glyphicon glyphicon-search"><i class="fa fa-search"
                                                aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="row ">
                            <div class="col-md-3 border-right border-dark">

                                <h5>Filter By Category</h5>
                                <div class="list-group">
                                    <a href="javascript:filter_image('all')"
                                        class="list-group-item list-group-item-action">All</a>
                                    <a href="javascript:filter_image('leisure')"
                                        class="list-group-item list-group-item-action">Leisure</a>
                                    <a href="javascript:filter_image('life')"
                                        class="list-group-item list-group-item-action">Life</a>
                                    <a href="javascript:filter_image('Others')"
                                        class="list-group-item list-group-item-action">Others</a>
                                </div>
                            </div>

                            <div class="col-md-9">
                                @if (Auth::check())
                                    @if ('image->user_id == Auth::user()->id')
                                        @csrf

                                        {{-- Upload image --}}
                                        <button data-toggle="collapse" class="btn btn-outline-success mb-2"
                                            data-target="#demo" style="margin-top: -50px;">
                                            <i class="fa fa-plus"> </i>
                                        </button>

                                        <div id="demo" class="collapse">
                                            <div class="card ">
                                                <form action="/image" enctype="multipart/form-data" method="POST">
                                                    <div class="card-header">{{ __('Upload Image') }}</div>

                                                    <div class="card-body p-4">
                                                        <div class="form-group row">
                                                            <label for="caption ">Add Caption</label>
                                                            <input type="text" id="caption"
                                                                class="form-control  @error('caption') is-invalid @enderror"
                                                                name="caption" value=" {{ old('caption') }}"
                                                                autocomplete="caption" autofocus>

                                                            @error('caption')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong> {{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <label for="category">Select List</label>
                                                        <select class="form-control mb-4" name="category">
                                                            <option>Select a Category</option>
                                                            <option>Leisure</option>
                                                            <option>Life</option>
                                                            <option>Others</option>
                                                        </select>

                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="file" name="image[]" class="form-control-image"
                                                                multiple accept="image/*">
                                                        </div>
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="fa fa-paper-plane"> </i>
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- End upload image --}}
                                    @endif
                                @endif
                                <div class="">

                                    <div class="row">

                                        {{-- @if (count($images)) --}}
                                        @forelse($images as $image)

                                            <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">

                                                <div class="card mb-4">

                                                    <div class="card-header">
                                                        <i class="fa fa-thumb-tack text-danger mr-2" aria-hidden="true"></i>
                                                        {{ $image->caption }}
                                                    </div>

                                                    <img src="{{ asset($image->image) }}" class="card-img-top"
                                                        height="220">


                                                    @if (Auth::check())
                                                        @if ('image->user_id == Auth::user()->id')

                                                            <div class="card-body">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-sm">
                                                                            <form action="/image/{{ $image->id }}"
                                                                                method="POST">
                                                                                @method('DELETE')
                                                                                @csrf

                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger ml-5">
                                                                                    <i class="fa fa-trash"
                                                                                        style="font-size: 17px;"> </i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-sm">

                                                                            <a class="btn btn-outline-primary"
                                                                                href="/image/{{ $image->id }}/edit">
                                                                                <i class="fa fa-pencil-square-o"> </i>
                                                                            </a>


                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endif
                                                    @endif
                                                </div>

                                            </div>

                                        @empty
                                            <h1 class="text-danger">
                                                There is no Uploads
                                            </h1>
                                    </div>
                                    @endforelse


                                    {{-- @if (count($images))
                                    <div class="col-md-12">
                                        {{ $images->links()}}
                                    </div> --}}

                                    {{-- @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                {{ $images->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
<script type="text/javascript">

var query={}

function filter_image(value){
    Object.assign(query, {'category':value});
    window.location.href = "{{route('welcome')}}" + '?'+ $.param(query);
}

</script> --}}
