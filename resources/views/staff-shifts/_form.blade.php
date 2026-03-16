<div class="row g-3">
    <div class="col-md-6">
        <div class="form-floating">
            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                <option value="">Select Staff</option>
                @foreach($staffMembers as $staffMember)
                    <option value="{{ $staffMember->id }}" {{ (string) old('user_id', isset($staffShift) ? $staffShift->user_id : '') === (string) $staffMember->id ? 'selected' : '' }}>
                        {{ $staffMember->name }}{{ $staffMember->role ? ' - ' . ucfirst($staffMember->role) : '' }}
                    </option>
                @endforeach
            </select>
            <label for="user_id"><i class="fas fa-user me-1"></i> Staff Member</label>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" name="shift_date" id="shift_date"
                   class="form-control @error('shift_date') is-invalid @enderror"
                   value="{{ old('shift_date', isset($staffShift) && $staffShift->shift_date ? $staffShift->shift_date->format('Y-m-d') : '') }}"
                   required>
            <label for="shift_date"><i class="fas fa-calendar-day me-1"></i> Shift Date</label>
            @error('shift_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <input type="time" name="start_time" id="start_time"
                   class="form-control @error('start_time') is-invalid @enderror"
                   value="{{ old('start_time', isset($staffShift) ? substr((string) $staffShift->start_time, 0, 5) : '') }}"
                   required>
            <label for="start_time"><i class="fas fa-clock me-1"></i> Start Time</label>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <input type="time" name="end_time" id="end_time"
                   class="form-control @error('end_time') is-invalid @enderror"
                   value="{{ old('end_time', isset($staffShift) ? substr((string) $staffShift->end_time, 0, 5) : '') }}"
                   required>
            <label for="end_time"><i class="fas fa-hourglass-end me-1"></i> End Time</label>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                @foreach(['scheduled' => 'Scheduled', 'in-progress' => 'In Progress', 'completed' => 'Completed', 'off' => 'Off Day'] as $value => $label)
                    <option value="{{ $value }}" {{ old('status', isset($staffShift) ? $staffShift->status : 'scheduled') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <label for="status"><i class="fas fa-signal me-1"></i> Shift Status</label>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="section" id="section"
                   class="form-control @error('section') is-invalid @enderror"
                   value="{{ old('section', isset($staffShift) ? $staffShift->section : '') }}"
                   placeholder="Kitchen, Table 1-5, Counter">
            <label for="section"><i class="fas fa-map-signs me-1"></i> Section / Duty</label>
            @error('section')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <textarea name="notes" id="notes"
                      class="form-control @error('notes') is-invalid @enderror"
                      placeholder="Shift Notes"
                      style="height: 110px">{{ old('notes', isset($staffShift) ? $staffShift->notes : '') }}</textarea>
            <label for="notes"><i class="fas fa-sticky-note me-1"></i> Shift Notes</label>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="d-flex justify-content-between border-top pt-3 mt-4">
    <a href="{{ route('staff-shifts.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Shifts
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> {{ $submitLabel }}
    </button>
</div>
