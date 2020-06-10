@extends('layouts.shopLayout')
@section('content')
<div class="container cart">
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif
    @if(\Session::has('error'))
    <div class="alert alert-danger">
        <p>{{ \Session::get('error') }}</p>
    </div>
    @endif
    <div class="card">
        <h2>Manager Order</h2>
        <table id="example" class="table table-bordered table-sm mt-4">
            <thead class="text-center thead thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>MYR {{ number_format($order->total_price, 2, '.', ',')}}</td>
                    <td>{{$orderStatus[$order->status]}}</td>
                    <td>
                        @if($order->status == 1 || $order->status == 3)
                        <a href="{{route('shop-sitemanageOrderCancel',[ $order->id ]) }}" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Cancel</a>
                        <a href="{{route('shop-sitemanageOrderRefund',[ $order->id ]) }}" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Refund</a>
                        @endif
                        @if($order->status == 4)
                        <a href="{{route('shop-sitemanageOrderTrack',[ $order->id ]) }}" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Track</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--container.//-->
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
@endsection