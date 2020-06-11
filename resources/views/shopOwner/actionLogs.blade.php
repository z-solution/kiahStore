@extends('layouts.shopOwnerLayout')

@section('content')
<div class="container">
  <div class="card">
    @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success') }}</p>
    </div>
    @endif
    <div class="card-header mb-2">Coupon Page
    </div>
    <table id="example" class="table table-bordered table-sm mt-4">
      <thead class="text-center thead thead-dark">
        <tr>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($actionLogs as $log)
        <tr>
          <td>{{$log->created_at}}</td>
          <td>{{$log->getText()}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
  jQuery(document).ready(function($) {
    // Setup - add a text input to each footer cell
    // $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#example').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      order: [0, 'desc']
    });
  });
</script>
<script>
  $(document).ready(function() {

    $('.delete_form').on('submit', function() {
      if (confirm('Are you sure you want to delete it?')) {
        return true;
      } else {
        return false;
      }
    });
    setTimeout(function() {
      $("div.alert").remove();
    }, 3000); // 3 secs
  });
</script>
@endsection