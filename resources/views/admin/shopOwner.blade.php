@extends('layouts.adminLayout')

@section('content')
<div class="container shop-owner">
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
      <tr>
        <td>2</td>
        <td>JomFun</td>
        <td>Approve</td>
        <td>12 May 2020</td>
        <td>
          <button>Enable</button>
          <button>Disable</button>
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td>123</td>
        <td>Approve</td>
        <td>12 May 2020</td>
        <td>
          <button>Enable</button>
          <button>Disable</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>abc</td>
        <td>Approve</td>
        <td>12 May 2020</td>
        <td>
          <button>Enable</button>
          <button>Disable</button>
        </td>
      </tr>
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