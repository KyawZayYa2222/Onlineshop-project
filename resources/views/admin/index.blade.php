@extends('admin.layouts.main')

@section('mainsection')

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Sales</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$reports['saleCount']}}</h6>
                    <span class="text-muted small pt-2 ps-1">products</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Revenue</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>${{$reports['revenue']}}</h6>
                    <span class="text-muted small pt-2 ps-1">incomes</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Subscribers</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$reports['subscribers']}}</h6>
                    <span class="text-muted small pt-2 ps-1">persons</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Customers Card -->

          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Recent Sales</h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Customer</th>
                      <th scope="col">Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Count</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (!empty($recentSales->toArray()))
                        @foreach ($recentSales as $data)
                        <tr>
                            <td>{{$data->user_name}}</td>
                            <td>{{$data->product_name}}</td>
                            <td><span style="color: rgb(0, 64, 255)">$</span>{{$data->price}}</td>
                            <td>{{$data->product_count}}</td>
                            <td>
                                @if ($data->status == "pending")
                                <span class="badge bg-warning">{{$data->status}}</span>
                                @else
                                <span class="badge bg-success">{{$data->status}}</span>
                                @endif
                            </td>
                          </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- End Recent Sales -->
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Budget Report -->
        <div class="card">
          <div class="card-body pb-0">
            <h5 class="card-title">Top Rated Products</h5>
            <div id="budgetChart" style="min-height: 400px;" class="echart">
                <table class="table table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($topRateProducts->toArray()))
                            @foreach ($topRateProducts as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->rate}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div><!-- End Budget Report -->

      </div><!-- End Right side columns -->

    </div>
  </section>

@endsection
