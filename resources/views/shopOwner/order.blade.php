@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
               <p>{{\Session::get('success') }}</p>
            </div>
        @endif
        <table id="example" class="table table-bordered table-sm mt-4">
          <thead class="text-center thead thead-dark">
            <tr>
              <th>ID / Order list</th>
              <th>Customer</th>
              <th>Total</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders->get() as $order)
              <tr>
                
                 <td>{{$order->id}}</td>
                <td>{{$order->customer->name}}</td>
                <td>{{$order->total_price}}</td>
                <td>
                  <form action="{{route('main-siteorderEdit',[ app('request')->route('subdomain') ?? '', $order->id ]) }}" class="btn btn-primary" method="POST">
                  {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH" />
                    <select name="status">
                      <option value="0" @if($order->status == "0") selected @endif>Unpaid</option>
                      <option value="1" @if($order->status == "1") selected @endif>Paid</option>
                      <option value="2" @if($order->status == "2") selected @endif>Payment failed</option>
                      <option value="3" @if($order->status == "3") selected @endif>Processing</option>
                      <option value="4" @if($order->status == "4") selected @endif>Shipping</option>
                      <option value="5" @if($order->status == "5") selected @endif>Delivered</option>
                      <option value="6" @if($order->status == "6") selected @endif>Canceled</option>
                      <option value="7" @if($order->status == "7") selected @endif>Refund request</option>
                      <option value="8" @if($order->status == "8") selected @endif>Refunded</option>
                    </select>
                    
                    <button type="submit" class="btn btn-success ml-2"> Update</button>
                  </form>
                </td>
                <td><a href="{{route('main-siteorderDetails',[ app('request')->route('subdomain') ?? '', $order->id ]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Details</a>
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
  $(document).ready(function() {

    $('.delete_form').on('submit', function() {
      if (confirm('Are you sure you want to delete it?')) {
        return true;
      } else {
        return false;
      }
    });
  });
</script>
@endsection