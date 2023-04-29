@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Order Page</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Order Page</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section order">
  <!-------  product table   --------->
  <div class="container">
    @if (session('deletesuccess'))
        <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('deletesuccess')}}</span>
    @endif
    <table class="table table-striped">
      <tr>
        <th>No.</th>
        <th>Product</th>
        <th>Count</th>
        <th>Cost</th>
        <th>UserName</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>

      @if (!empty($orderData->toArray()))
      <?php $i=0; ?>
        @foreach ($orderData as $data)
        <?php $i++ ?>
        <tr class="align-middle">
            <td>{{$i}}</td>
            <td>{{$data->product_name}}</td>
            <td>{{$data->product_count}}</td>
            <td><span style="color: rgb(0, 64, 255)">$</span>{{$data->cost}}</td>
            <td>{{$data->user_name}}</td>
            <td>{{$data->phone}}</td>
            <td>{{$data->address}}</td>
            <td>
                <div class="d-flex">
                    <form action="{{route('admin.order.action')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        @if ($data->status == 'pending')
                            <button class="btn btn-sm btn-warning" name="status" value="{{$data->status}}">{{$data->status}}</button>
                        @else
                            <button class="btn btn-sm btn-success" name="status" value="{{$data->status}}">{{$data->status}}</button>
                        @endif
                    </form>
                    <a href="{{route('admin.order.delete', $data->id)}}" class="btn btn-sm btn-danger ms-1">Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
      @else
        <tr class="text-center">
            <td colspan="8" class="py-4">No order have been yet!</td>
        </tr>
      @endif
    </table>
    {{-- {{$productData->links()}} --}}
  </div>

</section>

@endsection
