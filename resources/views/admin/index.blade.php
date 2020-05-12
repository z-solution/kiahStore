@extends('layouts.adminLayout')

@section('content')
    <div class="container">
       <div class="card-deck">
          <div class="card">
            <div class="card-header text-center">
              <b>Total Orders</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">99</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Sales</b>
            </div>
            <div class="card-body text-center">
              <p class="card-text">MYR</p>
              <h4 class="card-text">1300</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Customers</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">96</h4>
            </div>
          </div>
        </div>

        <table class="table table-bordered table-sm mt-4">
          <thead>
            <tr>
              <th>Latest Orders</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> Order1 </td>
            </tr>
            <tr>
              <td> Order2 </td>
            </tr>
            <tr>
              <td> Order3 </td>
            </tr>
          </tbody>
        </table>

    </div>
@endsection 

