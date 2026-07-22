@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')
@section('content')
<style>
.expense-table {
    table-layout: fixed;
    width: 100%;
}

.desc-cell {
    word-break: break-word;   /* break long words */
    white-space: normal;      /* allow wrapping */
    line-height: 1.4;
}

/* Control width ratio */
.expense-table th:nth-child(8),
.expense-table td:nth-child(8) {
    width: 20%;  /* Adjust if needed */
}
.expense-table {
    table-layout: fixed;
    width: 100%;
}

.source-cell {
    max-width: 60ch;      /* approx 60 characters per line */
    word-break: break-word;
    white-space: normal;
    line-height: 1.4;
}

.desc-cell {
    max-width: 60ch;
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

.expense-pagination .pagination {
    gap: 6px;
    margin-bottom: 0;
}

.expense-pagination .page-item .page-link {
    align-items: center;
    border-radius: 10px;
    display: inline-flex;
    font-size: 14px;
    height: 36px;
    justify-content: center;
    line-height: 1;
    min-width: 36px;
    padding: 0 10px;
}

.expense-pagination .page-item:first-child .page-link,
.expense-pagination .page-item:last-child .page-link {
    padding: 0;
}

.expense-pagination .page-item:first-child .page-link i,
.expense-pagination .page-item:last-child .page-link i {
    font-size: 12px;
    line-height: 1;
}

</style>

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      <div class="card-header-right admin-list-toolbar">
          <ul class="list-unstyled card-option admin-list-toolbar__actions">
              <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
              <li><i class="fas fa-minus minimize-card"></i></li>
              <li class="admin-list-toolbar__create">
                <a href="/expense/create" class="btn hor-grd btn-grd-success">নতুন ব্যায় যোগ করুন</a>
              </li>
          </ul>
      </div>
  </div>
<div class="admin-list-filters">
    <form method="GET" action="{{ route('expense.index') }}" class="admin-list-search">
            <div class="input-group admin-list-search__group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search expense..."
                       value="{{ request('search') }}">

                <div class="input-group-append admin-list-search__actions">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ route('expense.index') }}" class="btn btn-danger">Reset</a>
                </div>
            </div>
    </form>
</div>
  <div class="card-block" style="margin-top:30px">
   <div class="table-responsive">
    <table class="table table-bordered table-hover expense-table">
        <thead class="thead-light">
            <tr>
                <th style="width:5%">SL</th>
                <th style="width:10%">ভাউচার</th>
                <th style="width:10%">চেক</th>
                <th style="width:15%">ব্যয়ের উৎস</th>
                <th style="width:10%">তারিখ</th>
                <th style="width:10%">পরিমাণ</th>
                <th style="width:10%">অর্থবছর</th>
                <th style="width:20%">ব্যায়ের বিবরণ</th>
                <th style="width:10%">অ্যাকশন</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sl = ($expense->currentPage() - 1) * $expense->perPage() + 1;
            @endphp

            @foreach ($expense as $expenseShow)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $expenseShow->voucher_no }}</td>
                <td>{{ $expenseShow->expense_cheque }}</td>

             <td class="source-cell">
                {{ optional($expenseShow->getExpenseCategory)->expense_category }}
            
                @if ($expenseShow->expense_sub_category)
                    <br>
                    <small>
                        {{ optional($expenseShow->getExpenseSubCategory)->expense_subCategory }}
                    </small>
                @endif
            </td>

                <td>{{ $expenseShow->expense_date }}</td>
                <td>{{ $expenseShow->totalExpense }}</td>
                <td>{{ $expenseShow->fiscal_year }}</td>

                <td class="desc-cell">
                    {{ $expenseShow->descriptation }}
                </td>

                <!--<td>-->
                <!--    <a href="{{ route('expense.edit',$expenseShow->id) }}" class="btn btn-sm btn-info">এডিট</a>-->
                <!--    <a href="{{ route('expense.delete',$expenseShow->id) }}" class="btn btn-sm btn-danger">ডিলিট</a>-->
                <!--    <a style="margin-top:5px" href="{{ route('expense.abR',$expenseShow->id) }}" class="btn btn-warning"><i class="fas fa-file-alt"></i>এবস্ট্রাক্ট </a>-->
                <!--    <a style="margin-top:5px" href="{{ route('expense.bR',$expenseShow->id) }}" class="btn btn-success"><i class="fas fa-money-bill-wave"></i>বিল রেজিস্ট্রার  </a>-->
                <!--</td>-->
                <td>
                  <div class="action-icons">
                      <a href="{{ route('expense.edit',$expenseShow->id) }}"
                         class="btn btn-sm btn-info"
                         title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>

                      <a href="{{ route('expense.delete',$expenseShow->id) }}"
                         class="btn btn-sm btn-danger"
                         title="Delete"
                         onclick="return confirm('Are you sure you want to delete this expense?')">
                        <i class="fas fa-trash"></i>
                      </a>

                      <a href="{{ route('expense.abR',$expenseShow->id) }}"
                         class="btn btn-sm btn-warning"
                         title="Abstract">
                        <i class="fas fa-file-alt"></i>
                      </a>

                      <a href="{{ route('expense.bR',$expenseShow->id) }}"
                         class="btn btn-sm btn-success"
                         title="Bill Register">
                        <i class="fas fa-receipt"></i>
                      </a>
                  </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3 expense-pagination">
        {{ $expense->links('vendor.pagination.expense-list') }}
    </div>
</div>


    </div>
  </div>
</div>

@endsection
