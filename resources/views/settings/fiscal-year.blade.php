@extends('layouts.app')

@section('content')
<div class="card shadow-sm report-card">
    <div class="card-header">
        <h5 class="mb-0">অ্যাকটিভ অর্থবছর সেটিং</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('settings.fiscal-year.update') }}" method="POST">
            @csrf

            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">পূর্ববর্তী অর্থবছর</label>
                    <select name="previous_fiscal_year" class="form-control" required>
                        @foreach ($fiscalYears as $fiscalYear)
                            <option value="{{ $fiscalYear }}" {{ $previousFiscalYear === $fiscalYear ? 'selected' : '' }}>
                                {{ $fiscalYear }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-8 col-lg-6">
                    <label class="form-label">বর্তমান সক্রিয় অর্থবছর</label>
                    <select name="active_fiscal_year" class="form-control" required>
                        @foreach ($fiscalYears as $fiscalYear)
                            <option value="{{ $fiscalYear }}" {{ $activeFiscalYear === $fiscalYear ? 'selected' : '' }}>
                                {{ $fiscalYear }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted d-block mt-2">
                        আপনি চাইলে পূর্ববর্তী, বর্তমান সক্রিয়, এবং পরবর্তী অর্থবছর আলাদাভাবে নির্বাচন করে সংরক্ষণ করতে পারবেন।
                    </small>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">পরবর্তী অর্থবছর</label>
                    <select name="next_fiscal_year" class="form-control" required>
                        @foreach ($fiscalYears as $fiscalYear)
                            <option value="{{ $fiscalYear }}" {{ $nextFiscalYear === $fiscalYear ? 'selected' : '' }}>
                                {{ $fiscalYear }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <button type="submit" class="btn btn-primary btn-block">Save Setting</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
