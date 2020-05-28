@extends('layouts.adminLayout')

@section('content')
<div class="container shop-owner">
  
  @if(\Session::has('success'))
    <div class="alert alert-success">
       <p>{{\Session::get('success') }}</p>
    </div>
  @endif
  <table id="shop-owner-table" class="table table-bordered table-sm mt-4">
    <thead class="thead thead-dark">
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Status</th>
        <th>Register Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
    @foreach($shopOwners as $shopOwner)
      <tr>
        <td>{{$shopOwner->id}}</td>
        <td>{{$shopOwner->name}}</td>
        <td>{{ array_flip($shopStatus)[$shopOwner->status]}}</td>
        <td>12 May 2020</td>
        <td>
          @if($shopOwner->status == 0)
          <form method="POST" class="delete_form" action="{{route('main-admin-siteshop-owner-approve', [app('request')->route('subdomain') ?? '', $shopOwner->id])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="POST" />
            <button type="submit" class="btn btn-primary ml-2"><i class="fa fa-check"></i> Approve</button>
          </form>
          @endif
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
    var table = $('#shop-owner-table').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      order: [0, 'desc']

    });
  });
</script>
@endsection