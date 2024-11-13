@extends('client.layouts.master')

@section('content')
    
  <main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Account Details</h2>
      <div class="row">
        <div class="col-lg-3">
            <ul class="account-nav">
              <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s ">Dashboard</a></li>
              <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s">Orders</a></li>
              <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s menu-link_active">Account Details</a></li>
              <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s">Change password</a></li>

            </ul>
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__edit">
            <div class="my-account__edit-form">
              <form name="account_edit_form" class="needs-validation" novalidate>
                <div class="row">
                  <div class="col-md-12">
                    <div class="my-3">
                      <h5 class="text-uppercase mb-0">User Information</h5>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating my-3">
                      <input type="text" class="form-control" id="name" placeholder="Name">
                      <label for="name"> Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating my-3">
                      <input type="text" class="form-control" id="phone" placeholder="Phone">
                      <label for="phone">Phone</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="text" class="form-control" id="address" placeholder="Address" required>
                      <label for="address"> Address</label>
                    </div>
                  </div>
              
                  <div class="col-md-12">
                    <div class="my-3">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
