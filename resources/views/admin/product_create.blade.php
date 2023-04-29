@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Product / Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section product">
<!--   product create form   -->
      <div class="col col-md-7">
            <img src="{{asset('admin/img/no-image.png')}}" class="img-thumbnail mb-1" id="preview-img" style="max-width:200px">
          <form action="{{route('admin.product.create')}}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            <span>Select a Category</span>
            <select name="category_id" class="form-select mt-1 mb-3 w-50">
                @foreach ($categoryData as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-3" value="{{old('name')}}" placeholder="Product name">
            @error('price')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="input-group mb-3">
              <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" aria-label="Amount (to the nearest dollar)" value="{{old('price')}}" placeholder="Price">
              <span class="input-group-text">$</span>
            </div>
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <textarea name="description" rows="8" class="form-control @error('description') is-invalid @enderror mb-3" placeholder="Description"></textarea>
            @error('image')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="input-group">
              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror mb-3" id="file-input" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>

            <button type="submit" class="btn btn-primary mb-3">Create Product</button>
            <a href="{{route('admin.product.page')}}" class="btn btn-secondary mb-3">Cancel</a>
          </form>
      </div>

  </section>

@endsection
