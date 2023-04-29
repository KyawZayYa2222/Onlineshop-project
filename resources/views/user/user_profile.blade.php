@extends('user.layouts.main')

@section('mainsection')

<content>
    <div class="container my-4 align-middle" id="content">
        <div class="row row-cols-md-2 row-cols-1 justify-content-between">
            <div class="col col-md-3 col-sm-2 p-0 menu-con">
                <div class="d-flex flex-column bg-light large-menu">
                    <div class="d-flex flex-row ps-3 pt-3 menu-item menu-tab align-items-center" id="personal_data">
                        <p class="me-3 ms-md-1 ms-sm-3"><i class="bi bi-stack"></i></p>
                        <p class="menu-text">Personal Data</p>
                    </div>
                    <div class="d-flex flex-row ps-3 pt-3 menu-item menu-tab align-items-center" id="edit_info">
                        <p class="me-3 ms-md-1 ms-sm-3"><i class="bi bi-info-circle"></i></p>
                        <p class="menu-text">Edit Info</p>
                    </div>
                    <div class="d-flex flex-row ps-3 pt-3 menu-item menu-tab align-items-center" id="change_password">
                        <p class="me-3 ms-md-1 ms-sm-3"><i class="bi bi-lock-fill"></i></p>
                        <p class="menu-text">Change Password</p>
                    </div>
                    <div class="d-flex flex-row ps-3 pt-3 menu-item menu-tab align-items-center" id="orders">
                        <p class="me-3 ms-md-1 ms-sm-3"><i class="bi bi-arrow-down-circle-fill"></i></p>
                        <p class="menu-text">Order History</p>
                    </div>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <input type="submit" id="submit" hidden>
                        <label for="submit" class="menu-item" style="width:100%">
                            <div class="d-flex flex-row ps-3 pt-3 align-items-center" id="logout">
                                <p class="me-3 ms-md-1 ms-sm-3"><i class="bi bi-box-arrow-right"></i></p>
                                <p class="menu-text">Logout</p>
                            </div>
                        </label>
                    </form>
                </div>

                <div class="d-flex justify-content-center small-menu">
                    <div id="personal_data" class="d-flex px-2 menu-item menu-tab">
                        <p class="mx-1 pb-2"><i class="bi bi-stack"></i></p>
                    </div>
                    <div id="edit_info" class="d-flex px-2 menu-item menu-tab">
                        <p class="mx-1 pb-2"><i class="bi bi-info-circle"></i></p>
                    </div>
                    <div id="orders" class="px-2 menu-item menu-tab">
                        <p class="mx-1 pb-2"><i class="bi bi-arrow-down-circle-fill"></i></p>
                    </div>
                    <div id="change_password" class="px-2 menu-item menu-tab">
                        <p class="mx-1 pb-2"><i class="bi bi-lock-fill"></i></p>
                    </div>
                    <div id="logout" class="menu-item px-2">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <input type="submit" id="submit" hidden>
                            <label for="submit" class="mx-1 pb-2"><i class="bi bi-box-arrow-right"></i></label>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col col-md-9 col-sm-10">
                <div class="bg-light px-2 py-4" style="min-height: 500px;">
                    <div id="personal_data_content" class="contents">
                        <h4 class="mb-3">Personal Data</h4>
                        <div class="d-flex flex-column align-items-center">
                            <div class="profile-con mb-2">
                                @if ($userData['image']==null)
                                    <img src="{{asset('user/img/profile_no_photo.png')}}" alt="">
                                @else
                                    <img src="{{asset('storage/'.$userData['image'])}}" alt="">
                                @endif

                            </div>
                            <div class="user-info-con" >
                                <h3 class="text-center">{{$userData['name']}}</h3><hr>
                                <p class="lh-lg"><b>Email: </b> {{$userData['email']}} <br>
                                    <b>Phone: </b> {{$userData['phone']}} <br>
                                    <b>Address: </b> {{$userData['address']}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div id="orders_content" class="contents">
                        <h4 class="mb-3">Order History</h4>
                        <div id="order-content" class="d-flex flex-column align-items-center">
                            <table class="table table-stripped">
                                <tr class="table-secondary">
                                    <th width="40%">Item</th>
                                    <th width="20%">Count</th>
                                    <th width="20%">Cost</th>
                                    <th width="20%">Date</th>
                                </tr>
                                @if ($orderHistory != null)
                                    @foreach ($orderHistory as $history)
                                    <tr>
                                        <td>{{$history->name}}</td>
                                        <td class="align-middle">{{$history->product_count}}</td>
                                        <td class="align-middle">{{$history->cost}}$</td>
                                        <td class="align-middle">{{$history->created_at->format('d/m/Y')}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="4"><p class="my-3">No order have been yet! Buy now.</p></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div id="edit_info_content" class="contents">
                        <h4 class="mb-3">Edit Personal infos</h4>
                        <div id="change-pass-content" class="d-flex flex-column align-items-center">

                            <form action="{{route('user.profile.update', $userData['id'])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if ($userData['image'] != null)
                                    <img src="{{asset('storage/'.$userData['image'])}}" alt="Profile" class="img-thumbnail" width="160px" id="preview-img"><br>
                                @else
                                    <img src="{{asset('admin/img/profile_no_photo.png')}}" alt="Profile" class="img-thumbnail" width="160px" id="preview-img"><br>
                                @endif
                                <input type="file" name="image" id="file-input" hidden>
                                <label for="file-input" class="btn btn-sm btn-danger mt-1 mb-2"><i class="bi bi-arrow-bar-up"></i>Upload</label><br>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <input type="text" name="name" class="custom-form-control mb-3" placeholder="Name" value="{{$userData['name']}}"><br>
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <input type="email" name="email" class="custom-form-control mb-3" placeholder="Email" value="{{$userData['email']}}"><br>
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <input type="text" name="phone" class="custom-form-control mb-3" placeholder="Phone" value="{{$userData['phone']}}"><br>
                                @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <textarea name="address" rows="5" class="custom-form-control mb-3" placeholder="Address">{{$userData['address']}}</textarea><br>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>

                    <div id="change_password_content" class="contents">
                        <h4 class="mb-3">Change password</h4>
                        <p class="mb-4">Create your password more secured</p>
                        <div id="change-pass-content" class="d-flex flex-column align-items-center">
                            <form action="{{route('user.profile.changepassword', $userData['id'])}}" method="post">
                                @csrf
                                @if (session('confirmerror'))
                                    <span class="text-danger">{{session('confirmerror')}}</span><br>
                                @elseif (session('oldpasserror'))
                                    <span class="text-danger">{{session('oldpasserror')}}</span><br>
                                @endif
                                @error('current_password')
                                    <span class="text-danger">{{$message}}</span><br>
                                @enderror
                                <input type="password" name="current_password" class="custom-form-control mb-4" id="old-pass" placeholder="Enter your password">
                                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, oldPass);"></i></span><br>
                                @error('password')
                                <span class="text-danger">{{$message}}</span><br>
                                @enderror
                                <input type="password" name="password" class="custom-form-control mb-4" id="pass" placeholder="Enter new password">
                                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, pass);"></i></span><br>
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span><br>
                                @enderror
                                <input type="password" name="password_confirmation" class="custom-form-control mb-4" id="confirm-pass" placeholder="Confirm new password">
                                <span class="eye-icon-con fs-18"><i class="bi bi-eye" id="pass_show_hide" onclick="clicker(event, confirmPass);"></i></span><br>
                                {{-- user id  --}}
                                <input type="hidden" name="id" value="{{$userData['id']}}">
                                <button onclick="return confirm('You will need to login again when your password changed. Are you sure want to change?')" class="btn btn-primary">Change password</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</content>

@endsection
