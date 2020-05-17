@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
              <div class="card-body">
                <div class="mb-4">
                  <h4><u> Coupon Details </u></h4>
                  <h5>Order Id: 12</h5>
                  <h5>Date: 22 April 2020</h5>
                  <h5># of items: 3</h5>
                </div> 

                <div>
                  <h4><u> Payment Address </u></h4>
                  <p>No 5, Jalan Selasih 5,
                      Teman Selasih Fasa 1,
                      68100 Batu Caves,
                      Selangor</p>
                </div> 

                <div>
                  <h4><u> Shipping Address </u></h4>
                  <p>No 5, Jalan Selasih 5,
                      Teman Selasih Fasa 1,
                      68100 Batu Caves,
                      Selangor</p>
                </div>

                <table class="table table-bordered table-sm mt-4">
                    <thead class="text-center thead thead-dark">
                      <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> product1 </td>
                        <td>3</td>
                        <td>MYR 50.00</td>
                        <td>MYR 150.00</td>
                      </tr>
                      <tr>
                        <td> product2 </td>
                        <td>2</td>
                        <td>MYR 50.00</td>
                        <td>MYR 100.00</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><b>Sub total</b></td>
                        <td>MYR 250.00</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><b>Shipping Rate</b></td>
                        <td>MYR 10.00</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><b>Total</b></td>
                        <td> MYR 260.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection





