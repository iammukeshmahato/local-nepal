<div class="card h-100">
    <div class="card-body row widget-separator">
        <div class="col-sm-5 border-shift border-end">
            <h2 class="text-primary">
                {{ number_format($average, 1) }}
                <i class="bx bxs-star mb-2 ms-1"></i>
            </h2>
            <p class="fw-medium mb-1">Total {{ count($item->reviews) }} reviews</p>
            <p class="text-muted">All reviews are from genuine customers</p>
            <hr class="d-sm-none">
        </div>

        <div class="col-sm-7 gy-1 text-nowrap d-flex flex-column justify-content-between ps-4 gap-2 pe-3">
            <div class="d-flex align-items-center gap-3">
                <small>5 Star</small>
                <div class="progress w-100" style="height:10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="" id="progress-bar-5"
                        aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <small class="w-px-20 text-end">{{ $ratings_count[4] }}</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <small>4 Star</small>
                <div class="progress w-100" style="height:10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="" id="progress-bar-4"
                        aria-valuenow="{{ $ratings_count[3] }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="w-px-20 text-end">{{ $ratings_count[3] }}</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <small>3 Star</small>
                <div class="progress w-100" style="height:10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="" id="progress-bar-3"
                        aria-valuenow="{{ $ratings_count[2] }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="w-px-20 text-end">{{ $ratings_count[2] }}</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <small>2 Star</small>
                <div class="progress w-100" style="height:10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="" id="progress-bar-2"
                        aria-valuenow="{{ $ratings_count[1] }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="w-px-20 text-end">{{ $ratings_count[1] }}</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <small>1 Star</small>
                <div class="progress w-100" style="height:10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="" id="progress-bar-1"
                        aria-valuenow="{{ $ratings_count[0] }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="w-px-20 text-end">{{ $ratings_count[0] }}</small>
            </div>

        </div>
    </div>
</div>
