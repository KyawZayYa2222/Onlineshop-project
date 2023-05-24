@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
    <h1>Contact</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section category">
    <div class="container">
        @if (session('deletesuccess'))
            <span class="alert alert-success py-2 inline-block" id="alert" style="display:inline-block">{{session('deletesuccess')}}</span>
        @endif
        <table class="table table-striped">
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Actions</th>
          </tr>

          @if (!empty($contactData->toArray()))
          <?php $i=0; ?>
            @foreach ($contactData as $data)
            <?php $i++ ?>
            <tr class="align-middle">
                <td>{{$i}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->message}}</td>
                <td>
                  <a href="{{route('admin.contact.delete', $data->id)}}" class="btn btn-sm btn-danger ms-1">Delete</a>
                </td>
            </tr>
            @endforeach
          @else
            <tr class="text-center">
                <td colspan="6" class="py-4">No Contact have been yet!</td>
            </tr>
          @endif
        </table>
        {{-- {{$productData->links()}} --}}
      </div>
  </section>

@endsection
