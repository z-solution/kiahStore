@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <table class="table table-bordered table-sm mt-4">
          <thead class="text-center">
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
                <a href="#" class="btn btn-primary float-left"><i class="fa fa-edit"></i> Edit</a>

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
@endsection 

