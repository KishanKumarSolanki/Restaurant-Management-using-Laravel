<div class="row g-3">
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $staffMember->name ?? '') }}"
                   placeholder="Staff Name" required>
            <label for="name"><i class="fas fa-user me-1"></i> Full Name</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $staffMember->email ?? '') }}"
                   placeholder="Email Address" required>
            <label for="email"><i class="fas fa-envelope me-1"></i> Email Address</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <input type="text" name="phone" id="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $staffMember->phone ?? '') }}"
                   placeholder="Phone Number">
            <label for="phone"><i class="fas fa-phone me-1"></i> Phone Number</label>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                @foreach (['manager' => 'Manager', 'waiter' => 'Waiter', 'chef' => 'Chef', 'cashier' => 'Cashier', 'staff' => 'Staff'] as $value => $label)
                    <option value="{{ $value }}" {{ old('role', $staffMember->role ?? 'staff') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <label for="role"><i class="fas fa-user-shield me-1"></i> Role</label>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <input type="number" step="0.01" min="0" name="wage" id="wage"
                   class="form-control @error('wage') is-invalid @enderror"
                   value="{{ old('wage', $staffMember->wage ?? '') }}"
                   placeholder="Daily Wage">
            <label for="wage"><i class="fas fa-money-bill-wave me-1"></i> Daily Wage</label>
            @error('wage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" {{ isset($staffMember) ? '' : 'required' }}>
            <label for="password"><i class="fas fa-lock me-1"></i> Password</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control"
                   placeholder="Confirm Password" {{ isset($staffMember) ? '' : 'required' }}>
            <label for="password_confirmation"><i class="fas fa-lock me-1"></i> Confirm Password</label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between border-top pt-3 mt-4">
    <a href="{{ route('staff-members.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Staff
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> {{ $submitLabel }}
    </button>
</div>
