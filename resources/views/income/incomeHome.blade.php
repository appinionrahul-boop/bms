@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')
<style>
.income-table {
    table-layout: fixed;
    width: 100%;
}

.source-cell {
    max-width: 60ch;
    word-break: break-word;
    white-space: normal;
    line-height: 1.4;
}

.desc-cell {
    max-width: 80ch;
    word-break: break-word;
    white-space: normal;
    line-height: 1.4;
}

.action-icons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.action-icons .btn {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style>

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      <div class="card-header-right admin-list-toolbar">
          <ul class="list-unstyled card-option admin-list-toolbar__actions">
              <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
              <li><i class="fas fa-minus minimize-card"></i></li>
              <li class="admin-list-toolbar__create">
                <a href="/income/create" class="btn hor-grd btn-grd-success">নতুন আয় যোগ করুন</a>
              </li>
          </ul>
      </div>
  </div>
<div class="admin-list-filters">
    <form method="GET" action="{{ route('income.home') }}" class="admin-list-search">
            <div class="input-group admin-list-search__group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search income..."
                       value="{{ request('search') }}">

                <div class="input-group-append admin-list-search__actions">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ route('income.home') }}" class="btn btn-danger">Reset</a>
                </div>
            </div>
    </form>
</div>
  <div class="card-block" style="margin-top:30px">
   <div class="table-responsive">
      <table class="table table-bordered table-hover income-table">
          <thead class="thead-light">
            <tr>
                <th style="width:5%">SL</th>
                <th style="width:10%">ভাউচার</th>
                <th style="width:10%">চেক</th>
                <th style="width:15%">আয়ের উৎস</th>
                <th style="width:10%">তারিখ</th>
                <th style="width:10%">পরিমাণ</th>
                <th style="width:10%">অর্থবছর</th>
                <th style="width:20%">বিলের বিবরণ</th>
                <th style="width:10%">অ্যাকশন</th>
            </tr>
          </thead>
          <tbody>
            @php
                $sl = ($income->currentPage() - 1) * $income->perPage() + 1;
            @endphp
            @foreach ($income as $incomeShow)
                <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $incomeShow->voucher_no }}</td>
                <td>{{ $incomeShow->income_cheque }}</td>
                <td class="source-cell">
                    {{ Str::limit(optional($incomeShow->getIncomeCat)->category_sector, 60, '') }}

                    @if ($incomeShow->income_sub_source)
                        <br>
                        <small>{{ Str::limit(optional($incomeShow->getSubIncomeCat)->sector_source, 60, '') }}</small>
                    @endif

                    @if ($incomeShow->income_bot_source && optional($incomeShow->getBotSubIncomeCat)->sector)
                        <br>
                        <small>{{ Str::limit(optional($incomeShow->getBotSubIncomeCat)->sector, 60, '') }}</small>
                    @endif
                </td>
                <td>{{ $incomeShow->income_date }}</td>
                <td>{{ $incomeShow->income_amount }}</td>
                <td>{{ $incomeShow->fiscal_year }}</td>
                <td class="desc-cell">{{ wordwrap((string) $incomeShow->income_descriptation, 80, "\n", true) }}</td>
                <td>
                    <div class="action-icons">
                        <a href="{{ route('income.edit',$incomeShow->id) }}"
                           class="btn btn-sm btn-info"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('income.delete',$incomeShow->id) }}"
                           class="btn btn-sm btn-danger"
                           title="Delete"
                           onclick="return confirm('Are you sure you want to delete this income?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
                </tr>
            @endforeach
          </tbody>
      </table>

      <div class="d-flex justify-content-end mt-3 expense-pagination">
          {{ $income->links('vendor.pagination.expense-list') }}
      </div>
  </div>
</div>

</div>

@endsection
