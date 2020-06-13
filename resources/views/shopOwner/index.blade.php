@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
       <div class="card-deck mb-4">
          <div class="card">
            <div class="card-header text-center">
              <b>Total Orders</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">{{$orderCount->count()}}</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Sales</b>
            </div>
            <div class="card-body text-center">
              <p class="card-text">MYR</p>
              <h4 class="card-text">{{$salesCount}}</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Customers</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">{{$customerCount}}</h4>
            </div>
          </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
              <b>Latest Orders</b>
            </div>
            <div class="card-body text-center">
              <table id="example" class="table table-bordered table-sm mt-4">
                <thead class="thead thead-dark">
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orderCount->get() as $order)
                    <tr>
                      <td>{{$order->id}}</td>
                      <td>{{$order->customer->name}}</td>
                      
                      @if($order->status == 0)
                        <td>Unpaid</td>
                      @elseif($order->status == 1)
                        <td>Paid</td>
                      @elseif($order->status == 2)
                        <td>Paidfail</td>
                      @elseif($order->status == 3)
                        <td>Processing</td>
                      @elseif($order->status == 4)
                        <td>Shippiing</td>
                      @elseif($order->status == 5)    
                        <td>Complete</td>
                      @elseif($order->status == 6)
                        <td>Cancel</td>
                      @elseif($order->status == 7)
                        <td>RefundRequest</td>
                      @elseif($order->status == 8)
                        <td>Refunded</td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
@endsection 
@section('scripts')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
  <script>
      jQuery(document).ready(function($) {
          // Setup - add a text input to each footer cell
          // $('#example thead tr').clone(true).appendTo( '#example thead' );
          $('#example thead tr:eq(1) th').each( function (i) {
              var title = $(this).text();
              $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

              $( 'input', this ).on( 'keyup change', function () {
                  if ( table.column(i).search() !== this.value ) {
                      table
                          .column(i)
                          .search( this.value )
                          .draw();
                  }
              } );
          } );

          var table = $('#example').DataTable( {
              orderCellsTop: true,
              fixedHeader: true
          } );
      });

  </script>
  <script>
          $(document).ready(function(){

              $('.delete_form').on('submit', function(){
                  if(confirm('Are you sure you want to delete it?'))
                  {
                      return true;
                  }else
                  {
                      return false;
                  }
              });
          });
  </script>
@endsection

