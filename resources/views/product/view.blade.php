@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('View Products') }}</div>

        <div class="card-body">
          <br>
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="float-right">
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <br><br>
              <div class="todo-title">
                <strong>Title: </strong> {{ $product->title }}
              </div>
              <br>
              <div class="todo-description">
                <strong>Description: </strong> {{ $product->description }}
              </div>
              <br>
              <div class="todo-description">
                <strong>Status: </strong> {{ $product->status }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection