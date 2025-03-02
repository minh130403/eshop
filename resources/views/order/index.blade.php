@extends('admin.dashbroad')

@section('body')
    <div class="container-fluid mt-3">
        <h3>Orders</h3>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Order ID</th>
                          <th scope="col">Customer Name</th>
                          <th scope="col">Total Quantity</th>
                          <th scope="col">Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @empty($orders)
                        <th class="text-center" scope="row" colspan="4"> <span class="text-danger "> There is no category</span></th>
                            
                        @endempty

                        @foreach ($orders as $order )
                        <tr>
                          <th scope="row" style="width:20px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                          </th>
                          <td > <a href="/admin/orders/detail/{{ $order->id }}">{{ $order->id }}</a> </td>
                          <td>{{ $order->customer->fullname }}</td>
                          <td>{{ $order->total_quantity}}</td>
                          <td>{{ number_format($order->total_price) }} VNĐ</td>
                          <td>
                            {{-- <a class="btn btn-primary" href="/admin/category/edit/{{ $category->id }}"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                            <form action="/admin/orders/{{ $order->id }}/delete" method="POST"  style="display: inline-block !important;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-primary" type="submit"><i class="fa-solid fa-trash"></i> </button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{  $orders->links() }}
            </div>
        </div>
    </div>
@endsection