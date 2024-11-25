@extends('client.layouts.master')

@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">CONTACT US</h2>
      </div>
    </section>
    
    <section class="google-map mb-5">
        <h2 class="d-none">Contact Us</h2>
        <div class="google-map__wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4007.51186150038!2d105.74507512236875!3d21.03815400681283!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455305afd834b%3A0x17268e09af37081e!2sT%C3%B2a%20nh%C3%A0%20FPT%20Polytechnic.!5e1!3m2!1svi!2s!4v1730356472465!5m2!1svi!2s" 
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
            ></iframe>
        </div>
    </section>

    <section class="contact-us container">
      <div class="mw-930">
        <div class="row mb-5">
          <div class="col-lg-6">
            <h3 class="mb-4">Store in London</h3>
            <p class="mb-4">1418 River Drive, Suite 35 Cottonhall, CA 9622<br>United Kingdom</p>
            <p class="mb-4">sale@uomo.com<br>+44 20 7123 4567</p>
          </div>
          <div class="col-lg-6">
            <h3 class="mb-4">Store in Istanbul</h3>
            <p class="mb-4">1418 River Drive, Suite 35 Cottonhall, CA 9622<br>Turky</p>
            <p class="mb-4">sale@uomo.com<br>+90 212 555 1212</p>
          </div>
        </div>
        <div class="contact-us__form">
          {{-- <form name="contact-us-form" class="needs-validation" novalidate>
            <h3 class="mb-5">Get In Touch</h3>
            <div class="form-floating my-4">
              <input type="text" class="form-control" id="contact_us_name" placeholder="Name *" required>
              <label for="contact_us_name">Name *</label>
            </div>
            <div class="form-floating my-4">
              <input type="email" class="form-control" id="contact_us_email" placeholder="Email address *" required>
              <label for="contact_us_name">Email address *</label>
            </div>
            <div class="my-4">
              <textarea class="form-control form-control_gray" placeholder="Your Message" cols="30" rows="8" required></textarea>
            </div>
            <div class="my-4">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form> --}}

          <form action="{{ route('contact.submit') }}" method="POST" name="contact-us-form" class="needs-validation" novalidate>
            @csrf
            <h3 class="mb-5">Get In Touch</h3>
            <div class="form-floating my-4">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="contact_us_name" name="name" placeholder="Name *" required>
                <label for="contact_us_name">Name *</label>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating my-4">
                <input type="email" class="form-control @error('name') is-invalid @enderror" id="contact_us_email" name="email" placeholder="Email address *" required>
                <label for="contact_us_email">Email address *</label>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="my-4">
                <textarea class="form-control form-control_gray @error('name') is-invalid @enderror" name="message" placeholder="Your Message" cols="30" rows="8" required></textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
        </div>
      </div>
    </section>
  </main>
  @endsection