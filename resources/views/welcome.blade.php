@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-light">

                    {{-- page's card header --}}
                    <div class="card-header">
                        <div class="d-flex justify-content-between">

                            {{-- page title --}}
                            <div>
                                <h3 class="text-primary">Image Gallery</h3>
                            </div>

                            <div class="d-flex flex-row-reverse">

                                {{-- search bar  --}}
                                <form action="/" method="GET" role="search">

                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" placeholder="Search for Caption"
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

                        </div>
                    </div>
                    {{-- page's body --}}
                    <div class="card-body">
                        <div class="row ">

                            {{-- left column --}}
                            <div class="col-md-3 border-right border-dark">

                                {{-- category list menu--}}
                                <h5>Filter By Category</h5>
                                <div class="list-group text-center">
                                    <a href="/?category=All" class="list-group-item list-group-item-action {{ !Request::query('category') ? 'active' : '' }}">
                                        All<span class="badge badge-primary badge-pill float-right">{{ $images->count() }}</span></a>
                                    </a>
                                    <a href="/?category=shonen"
                                        class="list-group-item list-group-item-action {{ Request::query('category') == 'shonen' ? 'active' : '' }}">shonen</a>
                                    <a href="/?category=shojo"
                                        class="list-group-item list-group-item-action {{ Request::query('category') == 'shojo' ? 'active' : '' }}">shojo</a>
                                    <a href="/?category=seinen"
                                        class="list-group-item list-group-item-action {{ Request::query('category') == 'seinen' ? 'active' : '' }}">seinen</a>
                                </div>

                            </div>

                            {{-- right column --}}
                            <div class="col-md-9" style=";">

                                {{-- post upload with user authentication; unables not logged-in users to access upload form--}}
                                @if (Auth::check())
                                    @if ('image->user_id == Auth::user()->id')
                                        @csrf

                                        {{-- Upload toggle button --}}
                                        <button data-toggle="collapse" class="btn btn-outline-success mb-2"
                                            data-target="#demo">
                                            <i class="fa fa-plus"> </i>
                                        </button>

                                        {{-- Upload form --}}
                                        <div id="demo" class="collapse">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img src="https://img.freepik.com/free-vector/image-upload-concept-illustration_114360-798.jpg?size=338&ext=jpg"
                                                            class="mt-3 mb-3" alt="" style="height:400px;width:400px;">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="container" id="upload">
                                                            <form action="/image" enctype="multipart/form-data" method="POST" id="msform">
                                                                <fieldset>
                                                                    <h1 class="text-primary">Upload Image</h1>
                                                                    <div class="input-group input-group-lg">
                                                                        <span class="input-group-addon"><span
                                                                            class="fa fa-cc mr-2" aria-hidden="true"
                                                                            style="font-size:40px;"> </span></span>
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

                                                                    <br>

                                                                    <div class="input-group input-group-lg">
                                                                        <span class="input-group-addon">
                                                                            <span class="fa fa-list-alt mr-2 mt-1"
                                                                                aria-hidden="true" style="font-size:40px;">
                                                                            </span>
                                                                        </span>
                                                                        <select class="form-control mb-4" name="category">
                                                                            <option>Select a Category</option>
                                                                            <option>shonen</option>
                                                                            <option>shojo</option>
                                                                            <option>seinen</option>
                                                                        </select>

                                                                    </div>
                                                                    <br>

                                                                    @csrf
                                                                    <div>
                                                                        <input type="file" name="image[]"
                                                                            class="form-control-image " multiple accept="image/*">
                                                                    </div>

                                                                    <button type="submit" class="btn btn-outline-primary mt-3" style="width:50px">
                                                                        <i class="fa fa-paper-plane"> </i>
                                                                    </button>

                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End upload image --}}
                                    @endif
                                @endif

                                <div>

                                    <div class="row">

                                        {{-- image and info display loop --}}
                                        @forelse($images as $image)
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                                                <div class="card mb-4 bg-light">
                                                    <div class="con">

                                                        {{-- get images uploaded to display --}}
                                                        <img class="img" src="{{ asset($image->image) }}"
                                                            class="card-img-top" height="220">

                                                        {{-- user authentication for deleting and updating image data --}}
                                                        @if (Auth::check())
                                                            @if ('image->user_id == Auth::user()->id')
                                                                <div class="overlay">
                                                                    <div class="text mt-4">

                                                                        {{-- delete form button --}}
                                                                        <form action="/image/{{ $image->id }}"
                                                                            method="POST">
                                                                            @method('DELETE')
                                                                            @csrf

                                                                            <button type="submit"
                                                                                class="btn btn-outline-danger">
                                                                                <i class="fa fa-trash"
                                                                                    style="font-size: 17px;"> </i>
                                                                            </button>
                                                                        </form>

                                                                        {{-- edit button --}}
                                                                        <a class="btn btn-outline-primary mt-3"
                                                                            href="/image/{{ $image->id }}/edit">
                                                                            <i class="fa fa-pencil-square-o"> </i>
                                                                        </a>

                                                                        <a class="btn btn-outline-primary mt-3"
                                                                            href="/image/{{ $image->id }}/edit">
                                                                            <i class="fa fa-comment text-light"> </i>
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    {{-- image caption to display --}}
                                                    <h2 class="text-center">
                                                        <small class="h6">
                                                            <i class="fa fa-cc text-primary" aria-hidden="true"></i>
                                                        </small> {{ $image->caption }}
                                                    </h2>

                                                    {{-- image category to display --}}
                                                    <h6 style="margin-top:-10px;" class="text-center font-italic">
                                                        <small class="h6">
                                                            <i class="fa fa-thumb-tack text-danger" aria-hidden="true"></i>
                                                        </small> {{ $image->category }}
                                                    </h6>

                                                </div>

                                            </div>

                                            @empty
                                            <h1 class="text-danger">
                                                    There is no Uploads
                                            </h1>

                                        @endforelse
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- built-in pagination link for images --}}
                    <div class="row justify-content-center mt-4">
                        {{ $images->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
