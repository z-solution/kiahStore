@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container product">
      <div class="card">
            @if(\Session::has('success'))
                <div class="alert alert-success">
                   <p>{{\Session::get('success') }}</p>
                </div>
            @endif
          <div class="card-header mb-2">Product Page
            <a href="{{route('main-siteaddProduct', app('request')->route('subdomain') ?? '')}}" class="btn btn-primary float-right">Add New Product</a>
          </div>
          <table id="example" class="table table-bordered table-sm mt-4">
            <thead class="text-center thead thead-dark">
              <tr>
                <th>Product list</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr class="product-row">
                <td> <img id="product-image" src="{{$product->getFirstAttachmentFilename()}}" class="rounded mx-auto d-inline-block" /> {{$product->name}} </td>
                <td>{{$product->quantity}}</td>

                @if($product->status == 1)
                  <td>Available</td>
                  @elseif($product->status == 0)
                  <td>Out of Stock</td>
                  @else
                  <td>Pending</td>
                @endif 
                
                <td>
                  <a href="{{route('main-siteproductDetails',[ app('request')->route('subdomain') ?? '', $product->id ])}}" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a>

                    <form method="POST" class="delete_form" action="#">
                    {{csrf_field()}}
                     <input type="hidden" name="_method" value="DELETE" />
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
              setTimeout(function(){
                $("div.alert").remove();
            }, 3000 ); // 3 secs
          });

  </script>
@endsection 

