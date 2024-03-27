@extends('guest.layouts.main')
@push('title')
    <title>Write Your Opinion | LocalNepal</title>
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

        .delete_action {
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

        .delete_action_btns {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
        }

        .review:hover .delete_action {
            visibility: visible;
        }
    </style>
@endpush
@section('main-content')
    <div class="container py-5">
        <div class="card mx-4 ">
            <h5 class="card-header text-center" style="font-size: 2rem;">{{ $destination->title }}</h5>
            <div class="row d-flex justify-content-center">

                <div class="col-md-4 border-5">
                    <h3 class="text-center mt-3">Write your opinion</h3>
                    <form action="{{ url('/destinations/' . $destination->slug) . '/review' }}" method="post"
                        id="rating-from">
                        @csrf
                        <div class="stars text-center mb-5">
                            <span onclick="gfg(1)" class="star">★</span>
                            <span onclick="gfg(2)" class="star">★</span>
                            <span onclick="gfg(3)" class="star">★</span>
                            <span onclick="gfg(4)" class="star">★</span>
                            <span onclick="gfg(5)" class="star">★</span>
                            <h3 id="output">Rating is: 0/5</h3>
                        </div>
                        @error('rating')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                name="review" required></textarea>
                            <label for="floatingTextarea2">How did you like {{ $destination->title }}?</label>
                        </div>

                        <input type="hidden" name="rating" id="rating" />
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}" />
                        <div class="d-flex justify-content-center my-4">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // To access the stars
        let stars = document.getElementsByClassName('star')
        let output = document.getElementById('output')

        // Funtion to update rating
        function gfg(n) {
            remove()
            for (let i = 0; i < n; i++) {
                if (n == 1) cls = 'one'
                else if (n == 2) cls = 'two'
                else if (n == 3) cls = 'three'
                else if (n == 4) cls = 'four'
                else if (n == 5) cls = 'five'
                stars[i].className = 'star ' + cls
            }
            output.innerText = 'Rating is: ' + n + '/5'

            document.getElementById('rating').value = n
        }

        // To remove the pre-applied styling
        function remove() {
            let i = 0
            while (i < 5) {
                stars[i].className = 'star'
                i++
            }
        }
    </script>
@endpush
