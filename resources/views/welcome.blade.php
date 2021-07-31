@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">

                            <div>
                                <form class="form-inline">
                                    <select class="form-control">
                                        <option>Oldest</option>
                                        <option>Latest</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">Leisure</a>
                                    <a href="#" class="list-group-item list-group-item-action">Life</a>
                                    <a href="#" class="list-group-item list-group-item-action">Others</a>
                                </div>
                            </div>

                            <div class="col-md-9">
                                @if (Auth::check())
                                    @if ('image->user_id == Auth::user()->id')
                                        @csrf

                                        <button data-toggle="collapse" class="btn btn-warning mb-2" data-target="#demo">
                                            Upload </button>

                                        <div id="demo" class="collapse">
                                            <div class="card ">
                                                <form action="/image" enctype="multipart/form-data" method="POST">
                                                    <div class="card-header">{{ __('Upload Image') }}</div>

                                                    <div class="card-body p-4">
                                                        <div class="form-group row">
                                                            <label for="caption ">Add Caption</label>
                                                            <input type="text" id="caption"
                                                                class="form-control  @error('caption') is-invalid @enderror"
                                                                name="caption" value="{{ old('caption') }}"
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
                                                        <input type="submit" value="Upload" class="btn btn-primary">

                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="">

                                    <div class="row">

                                        @forelse($images as $image)

                                            <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">

                                                <div class="card mb-4">

                                                    <div class="card-header">
                                                        {{ $image->caption }}
                                                    </div>

                                                    <img src="{{ asset($image->image) }}" class="card-img-top"
                                                        alt="Broken" height="220">
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
                                                                                <input type="submit" value="Delete"
                                                                                    class="btn btn-danger">
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-sm">

                                                                            <a class="btn btn-primary"
                                                                                href="/image/{{ $image->id }}/edit">
                                                                                Update
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
