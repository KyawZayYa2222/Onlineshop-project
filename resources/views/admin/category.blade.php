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
      <h4>Create A Category</h4>
      <div class="col col-md-6">

        {{-- insert data  --}}
        <form action="{{route('admin.category.create')}}" method="post" class="form">
            @csrf
            @error('categoryName')
                <small class="text-danger">{{$message}}</small>
            @enderror
          <input type="text" name="categoryName" class="form-control mb-3 @error('categoryName') is-invalid @enderror" placeholder="Category Name">
          <button class="btn btn-primary mb-4" type="submit">create</button>
        </form>
      </div>

    {{-- alert checking  --}}
    @if (session('createsuccess'))
        <span class="text-success mb-1" id="alert">{{session('createsuccess')}}</span>
    @elseif (session('updatesuccess'))
        <span class="text-success mb-1" id="alert">{{session('updatesuccess')}}</span>
    @elseif (session('deletesuccess'))
        <span class="text-success mb-1" id="alert">{{session('deletesuccess')}}</span>
    @endif

      <h4>Category List</h4>
      <div class="col col-md-7">
        <table class="table table-striped">
          <tr>
            <th>No.</th>
            <th>Category</th>
            <th>Produt Count</th>
            <th>Actions</th>
          </tr>

          {{-- fetch data  --}}
          @if (!empty($categoryData))
            <?php $i=0; ?>
            @foreach ($categoryData as $data)
            <?php $i++ ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['product_count']}}</td>
                <td>
                    <a href="{{url('admin/category/edit/'.$data['id'])}}" class="btn btn-sm btn-primary">Edit</a>
                    {{-- <a href="{{url('admin/category/delete/'.$data->id)}}" class="btn btn-sm btn-danger">Delete</a> --}}
                </td>
            </tr>
            @endforeach
          @else
          <tr align="center">
            <td colspan="4">No category has been yet!</td>
          </tr>
          @endif
        </table>
      </div>

    </div>
  </section>

@endsection
