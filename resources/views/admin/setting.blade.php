@extends('layouts.adminLayout')

@section('content')
<div class="container setting">
  
  @if(\Session::has('success'))
    <div class="alert alert-success">
       <p>{{\Session::get('success') }}</p>
    </div>
  @endif
  <h1>System Setting</h1>
  <table id="setting-table" class="table table-bordered table-sm mt-4">
    <thead class="thead thead-dark">
      <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Maintainer mood for all shop</td>
        <td>
          @if ($shopMaintainerMood && $shopMaintainerMood->value == 'true')
          Enable
          @else
          Disable
          @endif
        </td>
        <td>
          <form method="POST" class="post_form" action="{{route('main-admin-sitepost-setting', [app('request')->route('subdomain') ?? ''])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="POST" />
            <input type="hidden" name="name" value="{{$systemShopMaintainerMood}}" />
            <input type="hidden" name="desc_name" value="Maintainer mood for all shop" />
            <input type="hidden" name="value" value="true" />
            <input type="hidden" name="desc_value" value="enable" />
            <button type="submit" class="btn btn-primary ml-2"><i class="fa fa-check"></i> Enable</button>
          </form>
          <form method="POST" class="post_form" action="{{route('main-admin-sitepost-setting', [app('request')->route('subdomain') ?? ''])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="POST" />
            <input type="hidden" name="name" value="{{$systemShopMaintainerMood}}" />
            <input type="hidden" name="desc_name" value="Maintainer mood for all shop" />
            <input type="hidden" name="value" value="false" />
            <input type="hidden" name="desc_value" value="disable" />
            <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-times"></i> Disable</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
@endsection