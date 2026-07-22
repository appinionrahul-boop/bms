@php
  $selectedVoucher = old('expense_voucher', $expense->voucher_no ?? '');
  $selectedFiscalYear = old('expense_fiscalYear', $expense->fiscal_year ?? \App\Support\FiscalYear::active());
  $fiscalYears = \App\Support\FiscalYear::selectable($selectedFiscalYear);
  $selectedCheque = old('expense_cheque', $expense->expense_cheque ?? '');
  $selectedCategory = old('expense_cat', $expense->expense_category ?? '');
  $selectedSubCategory = old('expense_subCat', $expense->expense_sub_category ?? '');
  $selectedAmount = old('expense_amount', $expense->expense_amount ?? '');
  $selectedDate = old('expense_date', $expense->expense_date ?? '');
  $selectedMessage = old('expense_message', $expense->descriptation ?? '');
  $selectedVat = old('expense_vat', $expense->expense_vat ?? '');
  $selectedVatAmount = old('vat_amount', $expense->vat_amount ?? '');
  $selectedVatCheque = old('vat_cheque_descriptation', $expense->vat_cheque_descriptation ?? '');
  $selectedFolio = old('expense_folio', $expense->expense_folio ?? '');
  $selectedTax = old('expense_tax', $expense->expense_tax ?? '');
  $selectedTaxAmount = old('tax_amount', $expense->tax_amount ?? '');
  $selectedTaxCheque = old('tax_cheque_descriptation', $expense->tax_cheque_descriptation ?? '');
  $selectedTaxDescription = old('tax_desriptation', $expense->tax_desriptation ?? '');
  $selectedPred = (string) old('expense_pred', $expense->expense_pred ?? '0') === '1';
@endphp

<div class="card admin-form-card">
  <div class="card-header">
      <h5>{{ $title }}</h5>
  </div>

  <div class="card-body">
      <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (isset($method) && strtoupper($method) !== 'POST')
              @method($method)
          @endif

          <div class="admin-form-sections">
              <section class="admin-form-section">
                  <div class="admin-form-section__header">
                      <h6>মৌলিক তথ্য</h6>
                      <p>ভাউচার, অর্থবছর এবং চেক সংক্রান্ত তথ্য দিন।</p>
                  </div>
                  <div class="row g-3">
                      <div class="col-12 col-md-6">
                          <label class="form-label">ভাউচার নাম্বার</label>
                          <input type="text" id="voucher" placeholder="ভাউচার নাম্বার লিখুন" name="expense_voucher" class="form-control" value="{{ $selectedVoucher }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">অর্থবছর <span class="text-danger">*</span></label>
                          <select class="form-control" name="expense_fiscalYear" required>
                              <option value="" disabled {{ $selectedFiscalYear === '' ? 'selected' : '' }}>অর্থবছর বাছুন</option>
                              @foreach ($fiscalYears as $fiscalYear)
                                  <option value="{{ $fiscalYear }}" {{ $selectedFiscalYear === $fiscalYear ? 'selected' : '' }}>{{ $fiscalYear }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="col-12">
                          <label class="form-label">চেক নাম্বার</label>
                          <input type="text" id="cheque" placeholder="চেক নাম্বার লিখুন" name="expense_cheque" class="form-control" value="{{ $selectedCheque }}">
                      </div>
                  </div>
              </section>

              <section class="admin-form-section">
                  <div class="admin-form-section__header">
                      <h6>ব্যয়ের তথ্য</h6>
                      <p>ব্যয়ের উৎস, পরিমাণ, তারিখ এবং বিবরণ যুক্ত করুন।</p>
                  </div>
                  <div class="row g-3">
                      <div class="col-12 col-md-6">
                          <label class="form-label">ব্যয়ের উৎস <span class="text-danger">*</span></label>
                          <select id="rootCat" class="form-control" name="expense_cat" required>
                              <option value="" {{ $selectedCategory === '' ? 'selected' : '' }}>ব্যয়ের উৎস বাছুন</option>
                              @foreach ($expenseCat as $cat)
                                  <option value="{{ $cat->id }}" {{ (string) $selectedCategory === (string) $cat->id ? 'selected' : '' }}>{{ $cat->expense_category }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">ব্যয়ের উপ উৎস <span class="text-danger">*</span></label>
                          <select id="subCat" class="form-control" name="expense_subCat" required>
                              <option value="" {{ $selectedSubCategory === '' ? 'selected' : '' }}>ব্যয়ের উপ উৎস বাছুন</option>
                              @foreach (($expenseSubCat ?? collect()) as $subCat)
                                  <option value="{{ $subCat->id }}" {{ (string) $selectedSubCategory === (string) $subCat->id ? 'selected' : '' }}>{{ $subCat->expense_subCategory }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">টাকার পরিমাণ</label>
                          <input type="number" step="0.01" min="0" id="amount" placeholder="টাকার পরিমাণ লিখুন" name="expense_amount" class="form-control" value="{{ $selectedAmount }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">ব্যয়ের তারিখ</label>
                          <input type="text" id="date_from" name="expense_date" class="form-control" placeholder="Select date" value="{{ $selectedDate }}" data-datepicker>
                      </div>

                      <div class="col-12">
                          <label class="form-label">ব্যয়ের বিবরণ</label>
                          <textarea placeholder="ব্যায়ের বিবরণ লিখুন" id="message" name="expense_message" class="form-control" rows="3">{{ $selectedMessage }}</textarea>
                      </div>
                  </div>
              </section>

              <section class="admin-form-section">
                  <div class="admin-form-section__header">
                      <h6>ভ্যাট তথ্য</h6>
                      <p>ভ্যাটের হার, পরিমাণ এবং সংশ্লিষ্ট বিবরণ লিখুন।</p>
                  </div>
                  <div class="row g-3">
                      <div class="col-12 col-md-6">
                          <label class="form-label">ব্যয়ের ভ্যাট (%)</label>
                          <input type="number" step="0.01" min="0" placeholder="ভ্যাটে কতো % লিখুন" name="expense_vat" class="form-control" value="{{ $selectedVat }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">ভ্যাটের টাকার পরিমাণ</label>
                          <input type="number" step="0.01" min="0" id="vat_am" placeholder="ভ্যাটের পরিমাণ" name="vat_amount" class="form-control" value="{{ $selectedVatAmount }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">ভ্যাটের চেকের বিবরণ</label>
                          <textarea id="vat_ch" placeholder="ভ্যাটের চেকের বিবরণ লিখুন" name="vat_cheque_descriptation" class="form-control" rows="3">{{ $selectedVatCheque }}</textarea>
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">ভ্যাটের বিবরণ</label>
                          <textarea id="folio" placeholder="চালানের বিবরণ" name="expense_folio" class="form-control" rows="3">{{ $selectedFolio }}</textarea>
                      </div>
                  </div>
              </section>

              <section class="admin-form-section">
                  <div class="admin-form-section__header">
                      <h6>আয়কর তথ্য</h6>
                      <p>আয়করের হার, টাকার পরিমাণ এবং প্রয়োজনীয় বিবরণ দিন।</p>
                  </div>
                  <div class="row g-3">
                      <div class="col-12 col-md-6">
                          <label class="form-label">আয়কর (%)</label>
                          <input type="number" step="0.01" min="0" id="tax_p" placeholder="আয়কর কতো % লিখুন" name="expense_tax" class="form-control" value="{{ $selectedTax }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">আয়করের টাকার পরিমাণ</label>
                          <input type="number" step="0.01" min="0" id="tax_am" placeholder="আয়করের পরিমাণ" name="tax_amount" class="form-control" value="{{ $selectedTaxAmount }}">
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">আয়করের চেকের বিবরণ</label>
                          <textarea id="tax_ch" placeholder="আয়করের চেকের বিবরণ লিখুন" name="tax_cheque_descriptation" class="form-control" rows="3">{{ $selectedTaxCheque }}</textarea>
                      </div>

                      <div class="col-12 col-md-6">
                          <label class="form-label">আয়করের বিবরণ</label>
                          <textarea id="taxD" placeholder="আয়করের বিবরণ" name="tax_desriptation" class="form-control" rows="3">{{ $selectedTaxDescription }}</textarea>
                      </div>
                  </div>
              </section>

              <section class="admin-form-section admin-form-section--compact">
                  <div class="admin-form-section__header">
                      <h6>বাজেট অপশন</h6>
                      <p>এন্ট্রিটি পরবর্তী অর্থবছরের বাজেট কিনা তা নির্ধারণ করুন।</p>
                  </div>
                  <div class="form-check">
                      <input type="hidden" value="0" name="expense_pred">
                      <input class="form-check-input" type="checkbox" value="1" name="expense_pred" id="expense_pred" {{ $selectedPred ? 'checked' : '' }}>
                      <label class="form-check-label" for="expense_pred">
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

@push('scripts')
<script>
$(function () {
  $(document).on('change', '#rootCat', function () {
    let id = $(this).val();

    $('#subCat').html('<option value="" selected>Loading...</option>');

    if (!id) {
      $('#subCat').html('<option value="" selected>ব্যয়ের উপ উৎস বাছুন</option>');
      return;
    }

    $.ajax({
      type: 'GET',
      url: "{{ route('expense.subcat', ':id') }}".replace(':id', id),
      success: function (response) {
        $('#subCat').html('<option value="" selected>ব্যয়ের উপ উৎস বাছুন</option>');

        response.forEach(function (item) {
          $('#subCat').append(`<option value="${item.id}">${item.expense_subCategory}</option>`);
        });
      },
      error: function (xhr) {
        console.log("Expense subcat error:", xhr.status, xhr.responseText);
        $('#subCat').html('<option value="" selected>Failed to load</option>');
      }
    });
  });
});
</script>
@endpush
