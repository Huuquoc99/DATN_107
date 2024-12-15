<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 111111111">
    @if (session('error'))
        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header bg-red text-white">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background: white;">
                {{ session('error') }}
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
        errorToast.show();
        @if(session('error'))
        errorToast.show();
        @endif
    });
</script>
