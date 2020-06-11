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
      <a href="{{route('main-sitecreateCoupon', app('request')->route('subdomain') ?? '')}}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create Coupon</a>
    </div>
    <table id="example" class="table table-bordered table-sm mt-4">
      <thead class="text-center thead thead-dark">
        <tr>
          <th>Coupon Code</th>
          <th>Coupon Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($coupons as $coupon)
        <tr>
          <td>{{$coupon->code}}</td>
          <td>{{$coupon->value}}</td>
          <td>
            <a href="{{route('main-sitecouponCRUD', [app('request')->route('subdomain') ?? '', $coupon->id] )}}" class="btn btn-primary float-left">
              <i class="fa fa-edit"></i> Edit
            </a>

            <form action="{{route('main-sitedeleteCouponCRUD', app('request')->route('subdomain') ?? '')}}" method="POST" class="delete_form">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="couponId" value="{{$coupon->id}}" />
              <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
            </form>
          </td>
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
      fixedHeader: true
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