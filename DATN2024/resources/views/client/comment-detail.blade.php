<div class="product-single__reviews-item review-item" data-id="{{ $comment->id }}">
    <div class="customer-avatar">
        <img loading="lazy"
            src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('theme/admin/assets/images/default-avatar.png') }}"
            alt="{{ $comment->user->name }}" class="rounded-circle" width="50" height="50">
    </div>
    <div class="customer-review">
        <div class="customer-name d-flex justify-content-between align-items-center w-100">
            <div>
                <h6 class="mb-0">{{ $comment->user->name ?? '' }}</h6>
            </div>
        </div>
        <div class="reviews-group d-flex ms-auto mt-2 mb-2" >
            @for ($rate = 0; $rate < 5; $rate++)
                @if ($rate < $comment->rate)
                    <svg class="review-star is-selected" width="16" height="16" fill="#f39c12" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                @else
                    <svg class="star-rating__star-icon review-star" width="16" height="16" fill="#ccc"
                        viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                @endif
            @endfor
        </div>
        <div class="review-date text-muted">
            {{ $comment->created_at ? $comment->created_at->format('F d, Y') : '' }}
        </div>
        <div class="review-text">
            <p style="color: black; font-weight: 400">{{ $comment->content ?? '' }}</p>
        </div>
        @if (Auth::user() && Auth::user()->id == $comment->user_id)
        <div class="review-action">
            <a href="#" data-id="{{ $comment->id }}" style="color: #4bb6b7" class="action-review edit-review">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="#" data-id="{{ $comment->id }}" style="color: red" class="action-review delete-review">
                <i class="fas fa-trash-alt"></i> Delete
            </a>
        </div>
        @endif
    </div>
</div>
