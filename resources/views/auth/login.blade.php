@extends('auth.layouts.main')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col col-md-6">
        <div class="mx-auto p-sm-4 p-2 border rounded shadow" style="height:400px">
            <div class="d-flex mb-3">
                <img src="{{asset('user/img/meron-logo2.png')}}" width="60px">
                <h2 class="pt-3 ms-3 text-secondary" style="font-style: italic;">Login Form</h2>
            </div>

            <form action="{{route('login')}}" method="post">
                @csrf
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="email" name="email" placeholder="Email" class="custom-form-control mb-3"><br>
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="password" name="password" value="{{old('password')}}" placeholder="Password" id="pass" class="custom-form-control mb-3">
                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, pass);"></i></span><br>
                <input type="checkbox" name="remember" id="check" class="form-check-input mb-3">&nbsp;<span>Remember me to login.</span><br>
                <button type="submit" name="register" id="reg-btn" class="btn btn-success mb-2">Login</button>
                <a href="{{url('/')}}" class="btn btn-secondary mb-2">Cancel</a><br>
                If you don't have an account, <a href="{{route('register')}}">register</a>.
            </form>
        </div>
    </div>
</div>

@endsection
