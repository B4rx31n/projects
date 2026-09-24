@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Details
                        <a href="{{ route('products.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Name: {{ $product->name }}</h5>
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
