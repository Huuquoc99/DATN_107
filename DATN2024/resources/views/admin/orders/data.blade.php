@if(!empty($orders))
    <div class="table-responsive table-card mb-1 text-center">
        @if (session("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success")}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</p>
        </div>
         <div>
             {!! $orders->withQueryString()->links() !!}
         </div>
     </div>
@else
    <div class="noresult">
        <div class="text-center">
            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
            <h5 class="mt-2">Sorry! No Result Found</h5>
            <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
        </div>
    </div>
@endif
