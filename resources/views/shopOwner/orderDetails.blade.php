@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
              <div class="card-body">
                <div class="mb-4">
                  <h4><u> Order Details </u></h4>
                  <h5>Order Id: {{$order->id}}</h5>
                  <h5>Date: {{$order->created_at}}</h5>
                  <h5># of items: {{$orderItems->sum('quantity') }}</h5>
                </div> 
                <div>
                  <h4><u> Payment Address </u></h4>
                  <p>{{$order->blling_address_id}}</p>
                </div> 

                <div>
                  <h4><u> Shipping Address </u></h4>
                  <p>{{$order->shipping_address_id}}</p>
                </div>

                <table class="table table-bordered table-sm mt-4">
                    <thead class="text-center thead thead-dark">
                      <tr>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orderItems->get() as $item)
                        <tr>
                          <td>{{$item->id}}</td>
                          <td>{{$item->quantity}}</td>
                          <td>MYR {{$item->price}}</td>
                          <td>MYR {{ number_format($item->quantity * $item->price) }} </td>
                        </tr>
                      @endforeach 
                      <tr>
                        <td colspan="3" class="text-right"><b>Sub total</b></td>
                        <td>MYR {{$order->total_price}} </td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><b>Shipping Rate</b></td>
                        <td>MYR 10.00</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><b>Total</b></td>
                        <td> MYR {{ number_format($order->total_price + 10) }} </td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection


