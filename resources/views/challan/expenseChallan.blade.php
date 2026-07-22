@php
class BanglaConverter {
    public static $bn = ["১","২","৩","৪","৫","৬","৭","৮","৯","০"];
    public static $en = ["1","2","3","4","5","6","7","8","9","0"];

    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}
@endphp

@extends('layouts.app')

@section('content')

<style>
    .challan-table {
        table-layout: fixed;
        width: 100%;
    }
    .challan-table th,
    .challan-table td {
        vertical-align: middle;
        text-align: center;
        word-break: break-word;
        white-space: normal;
        line-height: 1.4;
    }
    /* remove horizontal scroll */
    .table-responsive {
        overflow-x: hidden !important;
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
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
                <li><i class="fas fa-minus minimize-card"></i></li>
            </ul>
        </div>
    </div>
    <div class="admin-list-filters">
        <form method="GET" action="{{ route('expense-challan') }}" class="admin-list-search">
            <div class="input-group admin-list-search__group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search challan..."
                       value="{{ request('search') }}">

                <div class="input-group-append admin-list-search__actions">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ route('expense-challan') }}" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-block" style="margin-top:30px">
        <div class="table-responsive">
            <table class="table table-striped table-bordered challan-table">
                <thead>
                    <tr>
                        <th style="width:14%">ভাউচার নাম্বার</th>
                        <th style="width:14%">চেক নাম্বার</th>
                        <th style="width:14%">তারিখ</th>
                        <th style="width:14%">টাকার পরিমাণ</th>
                        <th style="width:10%">ভ্যাট</th>
                        <th style="width:10%">আয়কর</th>
                        <th style="width:24%">সম্পাদনা</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($expense as $item)
                        <tr>
                            <td>{{ $item->voucher_no }}</td>
                            <td>{{ $item->expense_cheque }}</td>
                            <td>{{ BanglaConverter::en2bn($item->expense_date) }}</td>
                            <td>{{ BanglaConverter::en2bn($item->expense_amount) }}</td>
                            <td>
                                @if($item->expense_vat !== null)
                                    {{ BanglaConverter::en2bn($item->expense_vat) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->expense_tax !== null)
                                    {{ BanglaConverter::en2bn($item->expense_tax) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('challan.expense', $item->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle"></i>
                                    চালান ডাউনলোড করুন
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">কোনো ডাটা পাওয়া যায়নি</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3 expense-pagination">
                {{ $expense->links('vendor.pagination.expense-list') }}
            </div>
        </div>
    </div>
</div>

@endsection
