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
                <td><form action="{{route('main-siteorderEdit',[ app('request')->route('subdomain') ?? '', $order->id ]) }}" class="btn btn-primary" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PATCH" />
                    <select name="status">
                      <option value="unpaid" @if($order->status == "unpaid") selected @endif>Unpaid</option>
                      <option value="paid" @if($order->status == "paid") selected @endif>Paid</option>
                       <option value="paymentFailed" @if($order->status == "paymentFailed") selected @endif>Payment failed</option>
                      <option value="processing" @if($order->status == "processing") selected @endif>Processing</option>
                      <option value="shipping" @if($order->status == "shipping") selected @endif>Shipping</option>
                      <option value="delivered" @if($order->status == "delivered") selected @endif>Delivered</option>
                      <option value="canceled" @if($order->status == "canceled") selected @endif>Canceled</option>
                      <option value="refundRequest" @if($order->status == "refundRequest") selected @endif>Refund request</option>
                      <option value="refunded" @if($order->status == "refunded") selected @endif>Refunded</option>
                    </select>
                    
                    <button type="submit" class="btn btn-success ml-2"> Update</button>
                  </form>
                </td>
                <td> <a href="{{route('main-siteorderDetails',[ app('request')->route('subdomain') ?? '', $order->id ]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Details</a>
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