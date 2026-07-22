@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0">আয়ের বাজেট দেখুন</h5>
    </div>

    <div class="card-body">
        <form action="{{ url('/income-budget-report') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Start Date --}}
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="date_from">Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text"
                                   id="date_from"
                                   name="income_start_date"
                                   class="form-control"
                                   placeholder="Select start date"
                                   autocomplete="off"
                                   required>
                        </div>
                    </div>
                </div>

                {{-- End Date --}}
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="date_to">End Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text"
                                   id="date_to"
                                   name="income_end_date"
                                   class="form-control"
                                   placeholder="Select end date"
                                   autocomplete="off"
                                   required>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="col-12 col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block">Generate</button>
                </div>
            </div>

            <div class="mt-2">
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (typeof flatpickr !== "function") {
        console.error("Flatpickr not loaded. Include flatpickr in layouts.app before @stack('scripts').");
        return;
    }

    const endPicker = flatpickr("#date_to", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    flatpickr("#date_from", {
        dateFormat: "Y-m-d",
        allowInput: true,
        onChange: function(selectedDates) {
            if (selectedDates.length > 0) {
                endPicker.set("minDate", selectedDates[0]);
            }
        }
    });
});
</script>
@endpush
