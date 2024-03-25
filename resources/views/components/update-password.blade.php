<div class="card mb-4">
    <h5 class="card-header">Reset Password 🔒</h5>

    <div class="card-body ">
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework"
            action="{{ url(Auth::user()->role . '/update-password') }}" method="post">
            @csrf
            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="current_password">Current Password</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="current_password" class="form-control" name="current_password"
                        placeholder="Enter Current Password" aria-describedby="password" required>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('current_password')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">New Password</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="Enter New Password" aria-describedby="password" required>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="confirm-password">Confirm Password</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="confirm-password" class="form-control" name="password_confirmation"
                        placeholder="Enter Confirm Password" aria-describedby="password" required>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>

            </div>
            <input class="btn btn-primary d-grid ms-auto justify-content-end mb-3" type="submit"
                value="Update Password" />
        </form>
    </div>
</div>
