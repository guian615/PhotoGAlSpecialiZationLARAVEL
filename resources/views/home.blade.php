@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card ">
                <form action="/image" enctype="multipart/form-data" method="POST">
                <div class="card-header">{{ __('Upload Image') }}</div>

                <div class="card-body p-4">
                    <div class="form-group row">
                        <label for="caption ">Add Caption</label>
                        <input type="text"
                         id="caption"
                         class="form-control  @error('caption') is-invalid @enderror"
                         name="caption"
                         value="{{ old('caption') }}"
                         autocomplete="caption" autofocus>

                         @error('caption')
                         <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                      <select class="form-control form-control-sm" name="category">
                        <option>djjd</option>
                        <option>deewjjd</option>
                        <option>sasa</option>
                      </select>

                        @csrf
                        <div class="form-group">
                            <input type="file" name="image[]"  class="form-control-image" multiple accept="image/*">
                        </div>
                        <input type="submit" value="Upload" class="btn btn-primary">

                </div>


  </form>
            </div> --}}


            
        </div>
    </div>
</div>
@endsection
