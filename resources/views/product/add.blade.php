@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Add Products') }}</div>

        <div class="card-body">
          <br>
          <div class="row justify-content-center">
            <div class="col-md-12">
              @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-error" role="alert">
                {{ session('error') }}
              </div>
              @endif
              <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                  <div class="col-md-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label for="desc" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                  <div class="col-md-12">
                    <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="desc">

                    @error('desc')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label for="purchase_price" class="col-md-4 col-form-label text-md-right">{{ __('Purchase Price') }}</label>
                  <div class="col-md-12">
                    <input id="purchase_price" type="number" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" value="{{ old('purchase_price') }}" required autocomplete="purchase_price">

                    @error('purchase_price')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label for="sell_price" class="col-md-4 col-form-label text-md-right">{{ __('Sell Price') }}</label>
                  <div class="col-md-12">
                    <input id="sell_price" type="number" class="form-control @error('sell_price') is-invalid @enderror" name="sell_price" value="{{ old('sell_price') }}" required autocomplete="sell_price">

                    @error('sell_price')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                  <div class="col-md-12">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image">

                    @error('image')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row flex-column flex-fill">
                  <br>
                  @can('isAdmin')
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('product.index') }}" class="btn btn-dark">Back</a>
                    @endcan
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection