@extends('layouts.adminLayout')

@section('content')
    <div class="container">
      <div class="card">
        <div class="card-header">Coupon Page</div>
        
        <table class="table table-bordered table-sm mt-4">
          <thead class="text-center">
            <tr>
              <th>Order list</th>
              <th>Customer</th>
              <th>Total</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> <img src="#" class="rounded mx-auto d-block" /> product1 </td>
              <td>Bjoe Cool</td>
              <td>MYR 500</td>
              <td>Pending</td>
              <td> <a href="#" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a></td>
            </tr>
            <tr>
              <td> <img src="#" class="rounded mx-auto d-block" /> product2 </td>
              <td>Zahir Boom</td>
              <td>MYR 400</td>
              <td>Pending</td>
              <td> <a href="#" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endsection 

