@extends('client.layouts.master')

@section('content')

<div class="col-lg-9">
    <div class="page-content my-account__order-details">
        <h2>Order #{{ $orderWithItems->code }}</h2>
        <p>Date: {{ $orderWithItems->created_at->format('F j, Y') }}</p>
        <p>Status: {{ $orderWithItems->statusOrder->name }}</p>
        <p>Total Price: ${{ number_format($orderWithItems->total_price, 2) }}</p>

        <h3>Items:</h3>
        <ul>
            @foreach ($orderWithItems->orderItems as $item)
                <li>{{ $item->product_name }} - Quantity: {{ $item->quantity }} - Price: ${{ number_format($item->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
