@extends('layouts.adminLayout')

@section('content')
<div class="container customer">
  <table id="customer-table" class="table table-bordered table-sm mt-4">
    <thead class="thead thead-dark">
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Name</th>
        <th>Shop</th>
        <th>Register Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
    @foreach($customers as $customer)
      <tr>
        <td>{{$customer->id}}</td>
        <td>{{$customer->email}}</td>
        <td>{{$customer->name}}</td>
        <td>{{$customer->shopAsCustomer()->first()->name}}</td>
        <td>{{$customer->created_at}}</td>
        <td>
          <a href="{{ route('main-admin-sitecustomerEdit', [app('request')->route('subdomain') ?? '', $customer->id]) }}" class="btn btn-primary ml-2"><i class="fa fa-check"></i>Edit</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
  jQuery(document).ready(function($) {
    var table = $('#customer-table').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      order: [0, 'desc']

    });
  });
</script>
@endsection