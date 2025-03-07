@extends('admin.dashbroad')

@section('body')
    <div class="container-fluid mt-3">
        <h3>Products</h3>
        <div>
          <a class="btn btn-primary" href="/admin/products/add"><i class="fa-solid fa-plus"></i> Add a New Product</a>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                          <th scope="col">Product's Name</th>
                          <th scope="col">Price ({{ $shop->curency ?? 'VNĐ' }})</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        <tr>
                          <th scope="row" style="width:20px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                          </th>
                          <td style="width:60px"> <img class="border rounded img-fluid" src="{{ asset($product->avatar->src) }}"  alt="..."> </td>
                          <td>{{ $product->name }}</td>
                          <td>{{ number_format($product->price) }} </td>
                          <td>
                            <a href="http://localhost:8000/admin/products/edit/{{ $product->id }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="/admin/products/delete/{{ $product->id }}" method="POST"  style="display: inline-block !important;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-primary" type="submit"><i class="fa-solid fa-trash"></i> </button>
                            </form>
                        </td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
                  <div class="row">
                     {{-- <div class="col-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select actions</option>
                            <option value="1">Delete</option>
                            <option value="2">Move to Trash</option>
                          </select>
                     </div>
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Do that</button>
                     </div> --}}
                  </div>
                  {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection