@extends('layouts.app')

@section('content')

    {{-- <div class="container ">

        <div class="card">
            <form action="/image/{{ $image->id }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">{{ __('Update Image') }}</div>

                <div class="card-body p-4">
                    <div class="form-group row">
                        <label for="caption">Edit Caption</label>
                        <input type="text" id="caption" class="form-control  @error('caption') is-invalid @enderror"
                            name="caption" value="{{ old('caption') ?? $image->caption }}" autocomplete="caption"
                            autofocus>

                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="category">Select List</label>
                    <select class="form-control mb-4" name="category" autocomplete="category" autofocus>>
                        <option>Edit a Category</option>
                        <option @if ($image->category == 'shonen') {{ 'selected' }} @endif>shonen</option>
                        <option @if ($image->category == 'shojo') {{ 'selected' }} @endif>shojo</option>
                        <option @if ($image->category == 'seinen') {{ 'selected' }} @endif>seinen</option>
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @csrf
                    <div class="form-group">
                        <input type="file" name="image[]" class="form-control-image" multiple accept="image/*">

                    </div>

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fa fa-paper-plane"> </i>
                    </button>

                    <a href="/">
                        <button type="submit" class="btn btn-outline-primary float-right">
                            <i class="fa fa-mail-reply"> </i>
                        </button>
                    </a>



                </div>

            </form>

        </div>
    </div> --}}

    {{-- update page --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <img src="https://png.pngtree.com/png-vector/20210402/ourlarge/pngtree-flat-upgrade-software-digital-network-maintenance-technology-load-vector-internet-program-png-image_3167334.jpg"
                    class="" alt="" style="height:400px;width:500px; margin-top:100px; ">
            </div>
            <div class="col-sm">
                <div class="container ">
                    <form action="/image/{{ $image->id }}" enctype="multipart/form-data" method="POST" id="mform"
                        style="width: 500px;margin-top:20%">

                        @csrf
                        @method('PUT')
                        <fieldset>
                            <h1 class="text-primary">Update Image</h1>
                            <div class="input-group input-group-lg mt-3">
                                <span class="input-group-addon"><span class="fa fa-cc mr-2" aria-hidden="true"
                                        style="font-size:40px;"> </span></span>
                                <input type="text" id="caption" class="form-control  @error('caption') is-invalid @enderror"
                                    name="caption" value="{{ old('caption') ?? $image->caption }}" autocomplete="caption"
                                    autofocus>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="fa fa-list-alt mr-2 mt-1" aria-hidden="true"
                                        style="font-size:40px;">
                                    </span></span>
                                <select class="form-control mb-4" name="category" autocomplete="category" autofocus>>
                                    <option>Edit a Category</option>
                                    <option @if ($image->category == 'shonen') {{ 'selected' }} @endif>shonen</option>
                                    <option @if ($image->category == 'shojo') {{ 'selected' }} @endif>shojo</option>
                                    <option @if ($image->category == 'seinen') {{ 'selected' }} @endif>seinen</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            @csrf

                            <button type="submit" class="btn btn-outline-primary btn-lg mr-3">
                                <i class="fa fa-paper-plane"> </i>
                            </button>

                            <a href="/">
                                <button type="submit" class="btn btn-outline-secondary btn-lg">
                                    <i class="fa fa-mail-reply"> </i>
                                </button>
                            </a>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
