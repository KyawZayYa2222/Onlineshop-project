@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Subscribers Page</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Subscribers Page</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section order">
    <!-------  product table   --------->
    <div class="container">
      @if (session('deletesuccess'))
          <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('deletesuccess')}}</span>
      @endif
      <table class="table table-striped w-50">
        <tr>
          <th>No.</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>

        @if (!empty($subscribers->toArray()))
        <?php $i=0; ?>
          @foreach ($subscribers as $data)
          <?php $i++ ?>
          <tr class="align-middle">
              <td>{{$i}}</td>
              <td>{{$data->email}}</td>
              <td>
                <a href="{{route('admin.subscribers.delete', $data->id)}}" class="btn btn-sm btn-danger ms-1">Delete</a>
              </td>
          </tr>
          @endforeach
        @else
          <tr class="text-center">
              <td colspan="8" class="py-4">No subscribers have been yet!</td>
          </tr>
        @endif
      </table>
      {{-- {{$productData->links()}} --}}
    </div>

</section>

@endsection
