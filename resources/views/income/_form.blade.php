@php
  $selectedRoot = old('root_cat', $income->income_source ?? '');
  $selectedSub = old('sub_cat', $income->income_sub_source ?? '');
  $selectedBot = old('botSubCat', $income->income_bot_source ?? '');
  $selectedFiscalYear = old('income_fiscalYear', $income->fiscal_year ?? \App\Support\FiscalYear::active());
  $fiscalYears = \App\Support\FiscalYear::selectable($selectedFiscalYear);
  $selectedAmount = old('income_amount', $income->income_amount ?? '');
  $selectedDate = old('income_date', $income->income_date ?? '');
  $selectedMessage = old('income_message', $income->income_descriptation ?? '');
  $selectedPred = (string) old('income_pred', $income->income_pred ?? '0') === '1';
@endphp

<div class="container-fluid income-form">
  <div class="row">
    <div class="col-12">
      <div class="card admin-form-card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">{{ $title }}</h5>
        </div>

        <div class="card-body">
          <form action="{{ $action }}" method="POST">
            @csrf

            <div class="admin-form-sections">
              <section class="admin-form-section">
                <div class="admin-form-section__header">
                  <h6>মৌলিক তথ্য</h6>
                  <p>অর্থবছর এবং আয়ের উৎস সম্পর্কিত তথ্য দিন।</p>
                </div>
                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label">অর্থবছর <span class="text-danger">*</span></label>
                    <select class="form-control" name="income_fiscalYear" required>
                      <option value="" disabled {{ $selectedFiscalYear === '' ? 'selected' : '' }}>অর্থবছর বাছুন</option>
                      @foreach ($fiscalYears as $fiscalYear)
                        <option value="{{ $fiscalYear }}" {{ $selectedFiscalYear === $fiscalYear ? 'selected' : '' }}>
                          {{ $fiscalYear }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">আয়ের উৎস</label>
                    <select id="rootCat" class="form-control" name="root_cat">
                      <option value="" {{ $selectedRoot === '' ? 'selected' : '' }}>আয়ের উৎস বাছুন</option>
                      @foreach ($incomeCategory as $category)
                        @if ($category->category_sector != '')
                          <option value="{{ $category->id }}" {{ (string) $selectedRoot === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->category_sector }}
                          </option>
                        @endif
                      @endforeach
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">আয়ের উপ উৎস</label>
                    <select id="subCat" class="form-control" name="sub_cat">
                      <option value="" {{ $selectedSub === '' ? 'selected' : '' }}>আয়ের উপ উৎস বাছুন</option>
                      @foreach (($subCategories ?? collect()) as $subCategory)
                        <option value="{{ $subCategory->id }}" {{ (string) $selectedSub === (string) $subCategory->id ? 'selected' : '' }}>
                          {{ $subCategory->sector_source }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">আয়ের উপ উৎস (ডিটেইল)</label>
                    <select id="botSubCat" class="form-control" name="botSubCat">
                      <option value="" {{ $selectedBot === '' ? 'selected' : '' }}>আয়ের উপ উৎস বাছুন</option>
                      @foreach (($botSubCategories ?? collect()) as $botSubCategory)
                        <option value="{{ $botSubCategory->id }}" {{ (string) $selectedBot === (string) $botSubCategory->id ? 'selected' : '' }}>
                          {{ $botSubCategory->sector }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </section>

              <section class="admin-form-section">
                <div class="admin-form-section__header">
                  <h6>আয়ের তথ্য</h6>
                  <p>টাকার পরিমাণ, তারিখ এবং বিলের বিবরণ দিন।</p>
                </div>
                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label">টাকার পরিমাণ</label>
                    <input
                      type="number"
                      step="0.01"
                      min="0"
                      id="amount"
                      class="form-control"
                      placeholder="টাকার পরিমাণ লিখুন"
                      name="income_amount"
                      value="{{ $selectedAmount }}"
                    >
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">তারিখ</label>
                    <div class="input-group">
                      <input
                        type="text"
                        id="date_from"
                        name="income_date"
                        class="form-control"
                        placeholder="Select date"
                        value="{{ $selectedDate }}"
                        data-datepicker
                      >
                      <span class="input-group-text">
                        <i class="fas fa-calendar-alt"></i>
                      </span>
                    </div>
                  </div>

                  <div class="col-12">
                    <label class="form-label">বিলের বিবরণ</label>
                    <textarea
                      class="form-control"
                      rows="4"
                      placeholder="বিলের বিবরণ লিখুন"
                      spellcheck="false"
                      id="message"
                      name="income_message"
                    >{{ $selectedMessage }}</textarea>
                  </div>
                </div>
              </section>

              <section class="admin-form-section admin-form-section--compact">
                <div class="admin-form-section__header">
                  <h6>বাজেট অপশন</h6>
                  <p>এন্ট্রিটি পরবর্তী অর্থবছরের বাজেট কিনা তা নির্ধারণ করুন।</p>
                </div>
                <div class="form-check">
                  <input type="hidden" value="0" name="income_pred">
                  <input class="form-check-input" type="checkbox" value="1" name="income_pred" id="income_pred" {{ $selectedPred ? 'checked' : '' }}>
                  <label class="form-check-label" for="income_pred">
                    পরবর্তী অর্থবছরের বাজেট হলে এখানে ক্লিক করুন
                  </label>
                </div>
              </section>
            </div>

            <div class="admin-form-actions">
              <button type="reset" class="btn btn-warning">Reset</button>
              <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
$(document).ready(function () {
  $('#rootCat').on('change', function () {
    let id = $(this).val();

    $('#subCat').html('<option selected>Loading...</option>');
    $('#botSubCat').html('<option value="" selected>আয়ের উপ উৎস বাছুন</option>');

    if (!id) {
      $('#subCat').html('<option value="" selected>আয়ের উপ উৎস বাছুন</option>');
      return;
    }

    $.ajax({
      type: 'GET',
      url: "{{ route('income.subcat', ':id') }}".replace(':id', id),
      success: function (response) {
        $('#subCat').html('<option value="" selected>আয়ের উপ উৎস বাছুন</option>');

        response.forEach(function (item) {
          $('#subCat').append(`<option value="${item.id}">${item.sector_source}</option>`);
        });
      }
    });
  });

  $('#subCat').on('change', function () {
    let id = $(this).val();

    $('#botSubCat').html('<option selected>Loading...</option>');

    if (!id) {
      $('#botSubCat').html('<option value="" selected>আয়ের উপ উৎস বাছুন</option>');
      return;
    }

    $.ajax({
      type: 'GET',
      url: "{{ route('income.botsubcat', ':id') }}".replace(':id', id),
      success: function (response) {
        $('#botSubCat').html('<option value="" selected>আয়ের উপ উৎস বাছুন</option>');

        response.forEach(function (item) {
          $('#botSubCat').append(`<option value="${item.id}">${item.sector}</option>`);
        });
      }
    });
  });
});
</script>
@endpush
