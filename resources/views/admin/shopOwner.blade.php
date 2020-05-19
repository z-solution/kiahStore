@extends('layouts.adminLayout')

@section('content')
<div class="container shop-owner">
  <table id="example" class="table table-bordered table-sm mt-4">
    <thead class="thead thead-dark">
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Status</th>
        <th>Register Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>JomFun</td>
        <td>Approve</td>
        <td>12 May 2020</td>
        <td> 
          <button>Enable</button>
          <button>Disable</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection