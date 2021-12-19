@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Products') }}</div>

        <div class="card-body">
          <br>
          <div class="row justify-content-center">
            @can('isAdmin')
            <div class="col-md-12">
              <div class="float-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add new product</a>
              </div>
            </div>
            @endcan
            <br>
            <br>
            <div class="col-md-12">
              @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
              @endif
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th width="5%">#</th>
                    <th width="10%">Name</th>
                    <th width="10%">Description</th>
                    <th width="10%">Purchase Price</th>
                    <th width="10%">Sell Price</th>
                    <th width="10%">Image</th>
                    @can('isAdmin')
                    <th width="10%">
                      <center>Action</center>
                    </th>
                    @endcan
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                  <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->desc }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->sell_price }}</td>
                    <td>@if (Storage::url($product->image))
                      <img src="{{ Storage::url($product->image) }}" alt="" class="img-fluid">
                      @else
                      -
                      @endif
                    </td>
                    @can('isAdmin')
                    <td>
                      <div class="action_btn">
                        <div class="action_btn">
                          <a href="{{ route('product.edit', $product->id )}}" class="btn btn-warning">Edit</a>
                        </div>
                        <div class="action_btn margin-left-10">
                          <form action="{{ route('product.destroy', $product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                          </form>
                        </div>
                      </div>
                    </td>
                    @endcan
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4">
                      <center>No data found</center>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection