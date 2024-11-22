<div class="product-single__reviews-list overflow-auto" id="review-product-id" data-id="{{ $productId }}" data-page="1"
     style="max-height: 500px;">
    @foreach ($comments as $comment)
    @dd($comment);
        @include('client.comment-detail', ['comment' => $comment])
    @endforeach
</div>
