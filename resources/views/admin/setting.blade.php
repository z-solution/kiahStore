@extends('layouts.adminLayout')

@section('content')
<div class="container customer">
  
  @if(\Session::has('success'))
    <div class="alert alert-success">
       <p>{{\Session::get('success') }}</p>
    </div>
  @endif
 
</div>
@endsection
@section('scripts')
@endsection