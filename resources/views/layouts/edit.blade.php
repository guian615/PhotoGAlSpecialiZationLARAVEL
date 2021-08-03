@extends('layouts.app')

@section('content')

    <div class="container ">

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
                        <option @if ($image->category == 'Leisure') {{ 'selected' }} @endif>Leisure</option>
                        <option @if ($image->category == 'Life') {{ 'selected' }} @endif>Life</option>
                        <option @if ($image->category == 'Others') {{ 'selected' }} @endif>Others</option>
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
    </div>
@endsection
