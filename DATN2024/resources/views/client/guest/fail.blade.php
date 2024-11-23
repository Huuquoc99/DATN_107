@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container m-5">
            <h2 class="page-title">Order Failed</h2>
            <div class="order-complete">
                <div class="order-complete__message">
                    <i class="fa-solid fa-circle-exclamation fa-xl"></i>
                    <h3>Payment Failed</h3>
                    <p>Payment failed. Please check your card information and try again.</p>
                </div>
            </div>
        </section>
    </main>

@endsection
