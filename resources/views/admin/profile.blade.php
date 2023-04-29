@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        @if ($userData['image'] != null)
            <img src="{{asset('storage/'.$userData['image'])}}" alt="Profile" class="rounded" style="width:180px">
        @else
            <img src="{{asset('admin/img/profile_no_photo.png')}}" alt="Profile" class="rounded">
        @endif
            <h2>{{$userData['name']}}</h2>
            <h3>Site Admin</h3>
          </div>
        </div>
      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{$userData['name']}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$userData['email']}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{$userData['phone']}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{$userData['address']}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="post" action="{{route('admin.profile.update', $userData['id'])}}" enctype="multipart/form-data">
                  @csrf
                    <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                    @if ($userData['image'] != null)
                        <img src="{{asset('storage/'.$userData['image'])}}" alt="Profile" id="preview-img">
                    @else
                        <img src="{{asset('admin/img/profile_no_photo.png')}}" alt="Profile" id="preview-img">
                    @endif
                      <div class="pt-2">
                        <input type="file" name="image" id="file-input" hidden>
                        <label for="file-input" >
                            <a class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                      <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="fullName" value="{{$userData['name']}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                      <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="Email" value="{{$userData['email']}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                    @error('phone')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                      <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="Phone" value="{{$userData['phone']}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                    @error('address')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                      <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="Address" value="{{$userData['address']}}">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{route('admin.profile.page')}}" class="btn btn-secondary">Cancel</a>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post" action="{{route('admin.profile.changepassword', $userData['id'])}}">
                    @csrf
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                @if (session('confirmerror'))
                    <span class="text-danger">{{session('confirmerror')}}</span>
                @elseif (session('oldpasserror'))
                    <span class="text-danger">{{session('oldpasserror')}}</span>
                @endif
                        @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                        @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="renewPassword">
                    </div>
                  </div>

                  {{-- user id  --}}
                  <input type="hidden" name="id" value="{{$userData['id']}}">

                  <div class="text-center">
                    <button onclick="return confirm('You will need to login again when your password changed. Are you sure want to change?')" class="btn btn-primary">Change Password</button>
                    <a href="{{route('admin.profile.page')}}" class="btn btn-secondary">Cancel</a>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
