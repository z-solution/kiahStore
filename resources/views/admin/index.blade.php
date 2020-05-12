@extends('layouts.adminLayout')

@section('content')
    <div class="container">
       <div class="card-deck mb-4">
          <div class="card">
            <div class="card-header text-center">
              <b>Total Orders</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">99</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Sales</b>
            </div>
            <div class="card-body text-center">
              <p class="card-text">MYR</p>
              <h4 class="card-text">1300</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-header text-center">
              <b>Total Customers</b>
            </div>
            <div class="card-body text-center">
              <h4 class="card-text">96</h4>
            </div>
          </div>
        </div>

        <table id="example" class="table table-bordered table-sm mt-4">
          <thead>
            <tr>
              <th>Latest Orders</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> Order1 </td>
            </tr>
            <tr>
              <td> Order2 </td>
            </tr>
            <tr>
              <td> Order3 </td>
            </tr>
          </tbody>
        </table>

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

