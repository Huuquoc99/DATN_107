@extends('client.layouts.master')

@section('content')
@include('client.layouts.partials.banner')
@include('client.layouts.partials.shop-by-categories')
@include('client.layouts.partials.product')
@include('client.layouts.partials.discount')
@include('client.layouts.partials.new-popular')
@include('client.layouts.partials.review')
@include('client.layouts.partials.blog')
{{-- @include('client.layouts.partials.shop-brand') --}}



@endsection