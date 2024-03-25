@extends('guest.layouts.main')
@push('title')
    <title>Home | LocalNepal</title>
@endpush
@push('links')
    <style>
        .star {
            font-size: 5vh;
            cursor: pointer;
        }

        .one {
            color: rgb(255, 0, 0);
        }

        .two {
            color: rgb(255, 106, 0);
        }

        .three {
            color: rgb(251, 255, 120);
        }

        .four {
            color: rgb(255, 255, 0);
        }

        .five {
            color: rgb(24, 159, 14);
        }

        .notice_action {
            visibility: hidden;
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            margin: 0 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .notice_action_btns {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
        }

        .card-body:hover .notice_action {
            visibility: visible;
        }
    </style>
@endpush
@section('main-content')
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
                </div>
            </div>

            <div class="col-md-6">
                <form action="{{ url('/guides/' . base64_encode($guide->id) . '/book') }}" method="POST">
                    @csrf
                    <input type="hidden" name="guide_id" value="{{ $guide->id }}">
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
                                <p>Total Cost: <strong id="total_cost">$100</strong></p>
                            </div>

                            <div class="mb-3 col-md-12 d-flex justify-content-end">
                                <input class="btn btn-success" type="submit" value="Book Guide">
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script>
        let start_date = document.getElementById('start_date');
        start_date.setAttribute('min', new Date().toISOString().split('T')[0]);
        let end_date = document.getElementById('end_date');
        let total_cost = document.getElementById('total_cost');
        let total_days = document.getElementById('total_days');
        const rate = document.getElementById('rate').innerText;

        start_date.addEventListener('change', () => {
            const today = new Date();
            const selectedDate = new Date(start_date.value);
            if (selectedDate < today) {
                alert('Please select a valid start date');
                start_date.value = '';
            }
            days_diff();
        });
        end_date.addEventListener('change', () => {
            days_diff();
        });

        function days_diff() {
            let start = new Date(start_date.value);
            let end = new Date(end_date.value);
            let diff = end - start;
            let days = diff / (1000 * 60 * 60 * 24);
            let hours = Math.ceil(diff / (1000 * 60 * 60));
            if (days < 0 || isNaN(days) || hours < 24) {
                days = 0;
                total_days.innerHTML = `Total Hours: <strong>${hours} Hours</strong>`;
                cost = Math.abs(hours * rate);
            } else {
                total_days.innerHTML = `Total Days: <strong>${hours} Hours</strong>`;
                cost = Math.abs(days * rate * 24);
            }
            total_cost.innerText = `$${cost}`;
        }
    </script>
@endpush