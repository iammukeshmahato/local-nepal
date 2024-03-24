<div class="mb-3 col-md-6">
    <label for="name" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $tourist->user->name }}"
        placeholder="John Doe" disabled />
</div>

<div class="mb-3 col-md-6">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $tourist->user->email }}"
        placeholder="name@example.com" disabled />
</div>

<div class="mb-3 col-md-6">
    <label for="phone" class="form-label">Phone</label>
    <input type="number" class="form-control" id="phone" name="phone"value="{{ $tourist->phone }}"
        placeholder="9800000000" required />
</div>

<div class="mb-3 col-md-6">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob" value="{{ $tourist->user->dob }}"
        placeholder="2001-01-01" required />
</div>

<div class="mb-3 col-md-6">
    <label for="nationality" class="form-label">Nationality</label>
    <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $tourist->nationality }}"
        placeholder="Nepal" required />
</div>
