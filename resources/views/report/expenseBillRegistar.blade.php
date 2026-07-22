@extends('layouts.app')

@section('content')

<style>
  .report-card .card-header{
    background:#f8f9fa;
  }
</style>

<div class="card shadow-sm report-card">
  <div class="card-header">
    <h5 class="mb-0">ব্যায়ের বিল রেজিস্ট্রার রিপোর্ট</h5>
  </div>

  <div class="card-body">
    <form action="{{ url('/expense-billRegistar-report') }}" method="POST">
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
              <input
                type="text"
                id="date_from"
                name="income_start_date"
                class="form-control"
                placeholder="Select start date"
                autocomplete="off"
                required
              >
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
              <input
                type="text"
                id="date_to"
                name="income_end_date"
                class="form-control"
                placeholder="Select end date"
                autocomplete="off"
                required
              >
            </div>
          </div>
        </div>

        {{-- Button --}}
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
    console.error("flatpickr is not loaded. Add it in layouts.app before @stack('scripts').");
    return;
  }

  const startEl = document.getElementById("date_from");
  const endEl   = document.getElementById("date_to");

  const endPicker = flatpickr(endEl, {
    dateFormat: "Y-m-d",
    allowInput: true
  });

  flatpickr(startEl, {
    dateFormat: "Y-m-d",
    allowInput: true,
    onChange: function(selectedDates) {
      if (selectedDates && selectedDates[0]) {
        endPicker.set('minDate', selectedDates[0]);
      }
    }
  });
});
</script>
@endpush
