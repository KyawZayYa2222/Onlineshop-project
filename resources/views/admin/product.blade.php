@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section product">
    <a href="{{route('admin.product.create.page')}}" class="btn btn-outline-primary mb-md-4 mb-3 float-end">Create Product</a>
    {{-- Search box  --}}
    <div class="d-flex">
        <form action="" method="post" class="border rounded shadow-sm">
            <input type="text" name="search" class="border rounded-start px-2 pt-1 pb-2" size="25" style="outline:none">
            <button class="btn btn-sm" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

  <!-------  product table   --------->
  <div class="container">
    @if (session('createsuccess'))
        <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('createsuccess')}}</span>
    @elseif (session('deletesuccess'))
        <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('deletesuccess')}}</span>
        @elseif (session('updatesuccess'))
        <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('updatesuccess')}}</span>
    @endif
    <table class="table table-striped">
      <tr>
        <th>No.</th>
        <th>Image</th>
        <th style="width:200px">Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th style="width:400px">Description</th>
        <th>Actions</th>
      </tr>

      @if (!empty($productData->toArray()))
      <?php $i=0; ?>
        @foreach ($productData as $data)
        <?php $i++ ?>
        <tr class="align-middle">
            <td>{{$i}}</td>
            <td><img src="{{asset('storage/'.$data->image)}}" width="70px"></td>
            <td>{{$data->name}}</td>
            <td>{{$data->category_name}}</td>
            <td>{{$data->price}}</td>
            <td>{{$data->description}}</td>
            <td>
              <a href="{{route('admin.product.edit', $data->id)}}" class="btn btn-sm btn-primary">Edit</a>
              <a href="{{route('admin.product.delete', $data->id)}}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
      @else
        <tr>
            <td colspan="7">No product have been yet!</td>
        </tr>
      @endif
    </table>
    {{$productData->links()}}
  </div>

  </section>

@endsection
