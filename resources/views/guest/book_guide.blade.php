@extends('guest.layouts.main')
@push('title')
    <title>Book - {{ $guide->user->name }} | LocalNepal</title>
@endpush

@section('main-content')
    @include('vendor.sweetalert.alert')
    <div class="container py-5 px-5">
        <h1 class="text-center mb-5">{{ $guide->user->name }}</h1>
        <div class="row justify-content-center px-5">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img" src="{{ asset('storage/profiles/' . $guide->user->avatar) }}" alt="Card image cap">
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="detail-box">
                    <h5 class="mb-3">Phone: {{ $guide->phone }}</h5>
                    <h5 class="mb-3">Email: {{ $guide->user->email }}</h5>
                    <h5 class="mb-3">Location: {{ $guide->location }} </h5>
                    <h5 class="mb-3">Rate: $<span id="rate">{{ $guide->rate }}</span>/hr </h5>
                    <h5 class="mb-3">Rate: $<span id="rate_day">150</span>/day </h5>
                </div>
            </div>

            <div class="col-md-6">
                <form action="{{ url('/guides/' . base64_encode($guide->id) . '/book') }}" method="POST">
                    @csrf
                    <input type="hidden" name="guide_id" value="{{ $guide->id }}">
                    <input type="hidden" name="total_cost" id="total_cost_input">
                    <div class="card mt-4">
                        <div class="card-body row">
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                    placeholder="2001-01-01" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                    placeholder="2001-01-01" required />
                            </div>

                            <div class="mb-3 col-md-6 d-none"></div>

                            <div class="mb-3 col-md-6">
                                <p id="total_days">Total Days: <strong>0</strong></p>
                            </div>
                            <div class="mb-3 col-md-6">
                                <p>Total Cost: <strong id="total_cost">$0</strong></p>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="message" class="form-label">Payment Method</label>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label
                                    class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                    for="khalti">
                                    <input name="payment" class="form-check-input" type="radio" value="khalti"
                                        id="khalti" checked="" onclick="payment_method()">
                                    <span class="custom-option-body">
                                        <img src="{{ asset('assets/img/payments/khalti.jpg') }}" alt="visa-card"
                                            width="58" data-app-light-img="icons/payments/visa-light.png"
                                            data-app-dark-img="icons/payments/visa-dark.png">
                                        {{-- <span class="ms-3">Khalti Wallet</span> --}}
                                    </span>
                                </label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label
                                    class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                    for="stripe">
                                    <input name="payment" class="form-check-input" type="radio" value="stripe"
                                        id="stripe" checked="" onclick="payment_method()">
                                    <span class="custom-option-body">
                                        <img src="{{ asset('assets/img/payments/stripe.jpg') }}" alt="visa-card"
                                            width="58" data-app-light-img="icons/payments/visa-light.png"
                                            data-app-dark-img="icons/payments/visa-dark.png">
                                        {{-- <span class="ms-3">Stripe</span> --}}
                                    </span>
                                </label>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label
                                    class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                    for="cash">
                                    <input name="payment" class="form-check-input" type="radio" value="cash"
                                        id="cash" checked="" onclick="payment_method()">
                                    <span class="custom-option-body">
                                        <img src="{{ asset('assets/img/payments/cash.jpg') }}" alt="visa-card"
                                            width="58" data-app-light-img="icons/payments/visa-light.png"
                                            data-app-dark-img="icons/payments/visa-dark.png">
                                        {{-- <span class="ms-3">By Cash</span> --}}
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-12 d-flex justify-content-end">
                                <input class="btn btn-success" id="submit_btn" type="submit" value="Pay by Cash">
                            </div>
                        </div>

                    </div>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/book_guide.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        function payment_method() {
            let submit_btn = document.getElementById('submit_btn');
            let payment = document.querySelector('input[name="payment"]:checked').value;
            if (payment == 'khalti') {
                submit_btn.value = 'Pay by Khalti';
                document.querySelector('form').setAttribute('action',
                    "{{ url('/payment/khalti') }}");
            } else if (payment == 'stripe') {
                submit_btn.value = 'Pay by Stripe';
                document.querySelector('form').setAttribute('action',
                    "{{ url('/payment/stripe') }}");
                console.log(location.href, location.origin);
            } else {
                submit_btn.value = 'Pay by Cash';
                document.querySelector('form').setAttribute('action',
                    "{{ url('/guides/' . base64_encode($guide->id) . '/book') }}");

            }
        }
    </script>
@endpush
