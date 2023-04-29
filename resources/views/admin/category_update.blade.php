@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section category">
    <div class="container">
      <h4>Update Category</h4>
      <div class="col col-md-6">
        <form action="{{route('admin.category.update')}}" method="post" class="form">
            @csrf
            @error('categoryName')
                <small class="text-danger">{{$message}}</small>
            @enderror
          <input type="hidden" name="upd_id" value="{{$categoryData[0]['id']}}">
          <input type="text" name="categoryName" class="form-control mb-3 @error('categoryName') is-invalid @enderror" value="{{$categoryData[0]['name']}}" placeholder="Category Name">
          <button class="btn btn-primary mb-4" type="submit">Update</button>
          <a href="{{route('admin.category.page')}}" class="btn btn-secondary mb-4">Cancel</a>
        </form>
      </div>

    </div>
  </section>

@endsection
