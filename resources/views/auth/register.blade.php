@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}



    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/002/223/426/small_2x/banner-design-of-folder-with-a-password-and-username-security-for-personal-data-protection-illustration-concept-be-used-for-landing-page-template-ui-web-mobile-app-poster-banner-website-free-vector.jpg"
                    class="" alt="" style="height:400px; margin-top:100px;">
            </div>
            <div class="col-sm">
                <div class="container ">
                    <form method="POST" action="{{ route('register') }}" id="mform" style="margin-top:20%">
                        @csrf
                        <fieldset>
                            <h1 class="text-primary">Register</h1>
                            <div class="input-group input-group-lg mt-3">
                                <span class="input-group-addon"><span class="fa fa-user mr-3" aria-hidden="true"
                                        style="font-size:45px;"> </span></span>
                                <input id="name" placeholder="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="fa fa-envelope mr-2" aria-hidden="true"
                                        style="font-size:40px;">
                                    </span></span>
                                <input id="email" type="email" placeholder="Email Address"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="fa fa-lock mr-3" aria-hidden="true"
                                        style="font-size:45px;">
                                    </span></span>
                                <input id="password" type="password" placeholder="Enter Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="fa fa-lock mr-3" aria-hidden="true"
                                        style="font-size:45px;">
                                    </span></span>
                                <input id="password-confirm" type="password" class="form-control"
                                    placeholder="Confirm Password" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-outline-primary btn-lg">
                                Register <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>


                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
