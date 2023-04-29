@extends('auth.layouts.main')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col col-md-6">
        <div class="mx-auto p-sm-4 p-2 border rounded shadow">
            <div class="d-flex mb-3">
                <img src="{{asset('user/img/meron-logo2.png')}}" width="60px">
                <h2 class="pt-3 ms-3 text-secondary" style="font-style: italic;">Register Form</h2>
            </div>
            {{-- register form  --}}
            <form action="{{route('register')}}" method="post">
                @csrf
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" name="name" placeholder="Name" value="{{old('name')}}" class="custom-form-control mb-3"><br>
                @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="email" name="email" placeholder="Email" value="{{old('email')}}" class="custom-form-control mb-3"><br>
                @error('phone')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" name="phone" placeholder="Phone" class="custom-form-control mb-3"><br>
                @error('address')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <textarea name="address" class="custom-form-control mb-3" cols="15" rows="4" placeholder="Address"></textarea><br>
                @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="password" name="password" placeholder="Password" id="pass" class="custom-form-control mb-3">
                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, pass);"></i></span><br>
                @error('password_confirmation')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="password" name="password_confirmation" placeholder="Confirmed password" id="confirm-pass" class="custom-form-control mb-1">
                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, confirmPass);"></i></span><br>
                {{-- @error('terms')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="checkbox" name="terms" id="check" class="form-check-input mb-4">&nbsp;<span>I agree to the terms & policies</span><br> --}}
                <button type="submit" id="reg-btn" class="btn btn-success mb-2">Register</button>
                <a href="{{url('/')}}" class="btn btn-secondary mb-2">Cancel</a><br>
                If you have already registered, <a href="{{route('login')}}">login</a>.
            </form>
        </div>
    </div>
</div>

@endsection
