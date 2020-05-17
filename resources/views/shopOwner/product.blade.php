@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
      <div class="card">
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
              <tr>
                <td> <img src="#" class="rounded mx-auto d-block" /> product1 </td>
                <td>3</td>
                <td>Enabled</td>
                <td>
                  <a href="{{route('main-siteproductDetails', app('request')->route('subdomain') ?? '')}}" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a>

                    <form method="POST" class="delete_form" action="#">
                    {{csrf_field()}}
                     <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
              </tr>
              <tr>
                <td> <img src="#" class="rounded mx-auto d-block" /> product2 </td>
                <td>4</td>
                <td>Enabled</td>
                <td>
                  <a href="#" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a>

                    <form method="POST" class="delete_form" action="#">
                    {{csrf_field()}}
                     <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
              </tr>
              <tr>
                <td> <img src="#" class="rounded mx-auto d-block" /> product3 </td>
                <td>5</td>
                <td>Disabled</td>
                <td>
                  <a href="#" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a>

                    <form method="POST" class="delete_form" action="#">
                    {{csrf_field()}}
                     <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
              </tr>
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
          });
  </script>
@endsection 

