@extends('user.layouts.main')

@section('mainsection')

<content>
    <div class="container py-md-5 py-2">
        <div class="form-con mx-auto">
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <div class="info mx-auto">
                        <h3 class="mb-3">Contact Our Sale Team</h3>
                        <p class="px-1">
                            If you have any question, you can contact to our sale team. We are opened for <span>10-hours</span>
                            and you can contact from contact page of site or to our facebook page or our page messenger.
                        </p><br>
                        <p><b>Email: </b><span>sailteam@meron.com</span></p>
                        <p><b>Hot Line: </b><a href="tel:+09935644725">09935644725</a></p>
                        <p><b>Address: </b><span>Yangon, Myanmar</span></p>
                        <p><b>Hours: </b><span>7:00am - 5:00pm</span></p>
                    </div>

                </div>
                <div class="col">
                    <div class="form mx-auto">
                        <h3>Contact Form</h3>
                        @if (session('alertsuccess'))
                            <p class="alert alert-success py-2 my-2" id="alert">{{session('alertsuccess')}}</p>
                        @endif
                        <form action="{{route('contact.create')}}" method="post" autocomplete="off">
                            @csrf
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="text" name="name" placeholder="Name" id="name" class="custom-form-control mb-3" value="@if($userInfo != null){{$userInfo['name']}}@endif"><br>
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="email" name="email" placeholder="Email" id="email" class="custom-form-control mb-3" value="@if ($userInfo != null) {{$userInfo['email']}} @endif"><br>
                            @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="text" name="phone" placeholder="Phone" id="ph" class="custom-form-control mb-3" value="@if ($userInfo != null) {{$userInfo['phone']}} @endif"><br>
                            @error('message')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <textarea name="message" class="custom-form-control mb-3" cols="15" id="addr" rows="4" placeholder="Message"></textarea><br>
                            <button type="submit" id="reg-btn" class="mb-3 custom-btn2">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</content>

@endsection
