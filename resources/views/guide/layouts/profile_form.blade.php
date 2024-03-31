<div class="mb-3 col-md-6">
    <label for="name" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $guide->user->name }}"
        placeholder="John Doe" disabled />
</div>

<div class="mb-3 col-md-6">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $guide->user->email }}"
        placeholder="name@example.com" disabled />
</div>

<div class="mb-3 col-md-6">
    <label for="phone" class="form-label">Phone</label>
    <input type="number" class="form-control" id="phone" name="phone"value="{{ $guide->phone }}"
        placeholder="9800000000" required />
</div>

<div class="mb-3 col-md-6">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob" value="{{ $guide->user->dob }}"
        placeholder="2001-01-01" required />
</div>

<div class="mb-3 col-md-6">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ $guide->address }}"
        placeholder="Kathmandu" required />
</div>

    <div class="mb-3 col-md-6">
        <label for="languages" class="form-label">Language</label>

        <select name="languages[]" class="form-select" multiple>
            @foreach ($languages as $language)
                <option value="{{ $language->id }}" @if ($guide->languages->contains($language->id)) selected @endif>
                    {{ $language->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3 col-md-6">
        <label for="location" class="form-label">Serving Location</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ $guide->location }}"
            placeholder="Bhaktapur" required />
    </div>
    <div class="mb-3 col-md-6">
        <label for="rate" class="form-label">Rate per hour</label>
        <input type="number" class="form-control" id="rate" name="rate" value="{{ $guide->rate }}"
            placeholder="$5" required />
    </div>
    <div class="mb-3 col-md-12">
        <label for="about" class="form-label">About</label>
        <textarea class="form-control" id="about" name="about" placeholder="Describe yourself" required>{{ $guide->about }}</textarea>
    </div>
    