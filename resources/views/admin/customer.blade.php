@extends('layouts.adminLayout')

@section('content')
<div class="container customer">
  
  @if(\Session::has('success'))
    <div class="alert alert-success">
       <p>{{\Session::get('success') }}</p>
    </div>
  @endif
  <table id="customer-table" class="table table-bordered table-sm mt-4">
    <thead class="thead thead-dark">
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Name</th>
        <th>Register Date</th>
      </tr>
    </thead>
    <tbody>
      
    @foreach($customers as $shopOwner)
      <tr>
        <td>{{$shopOwner->id}}</td>
        <td>{{$shopOwner->email}}</td>
        <td>{{$shopOwner->name}}</td>
        <td>{{$shopOwner->created_at}}</td>
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