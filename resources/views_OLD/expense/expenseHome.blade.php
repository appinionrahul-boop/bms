@extends('layouts.app')

@section('content')

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      
      {{-- <a href="/income/create" class="btn btn-success">Add New Income </a> --}}
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="feather icon-maximize full-card"></i></li>
              <li><i class="feather icon-minus minimize-card"></i></li>
              <li style="margin-right:28px"> <a href="/expense/create" class="btn hor-grd btn-grd-success">নতুন ব্যায় যোগ করুন</a></li>
              {{-- <li><i class="feather icon-trash-2 close-card"></i></li> --}}
          </ul>
      </div>
  </div>
  <div class="card-block" style="margin-top:30px">
    <div class="table-responsive">
        <div class="dt-responsive table-responsive">
            <table id="res-config" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th class="th-sm" style="text-align:center">Sl No</th>
                    <th class="th-sm" style="text-align:center">ভাউচার নাম্বার</th>
                    <th class="th-sm" style="text-align:center">চেক নাম্বার</th>
                    <th class="th-sm" style="text-align:center">ব্যয়ের  উৎস </th>
                    <th class="th-sm" style="text-align:center">তারিখ</th>
                    <th class="th-sm" style="text-align:center">টাকার পরিমাণ</th>
                    <th class="th-sm" style="text-align:center">অর্থবছর</th>
                    <th class="th-sm" style="text-align:center">ব্যায়ের বিবরণ</th>
                    <th class="th-sm" style="text-align:center">সম্পাদনা</th>
                </tr>
            </thead>
            <tbody>
                <p hidden>{{ $sl = 1 }}</p>
                @foreach ($expense as $expenseShow)
                    <tr>
                        <td class="align-middle" style="text-align:center">{{ $sl }}</td>
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->voucher_no}}</td>
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->expense_cheque}}</td>
                        
                        
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->getExpenseCategory->expense_category }}<br>
                            @if ($expenseShow->expense_sub_category !=NULL)   
                        -> {{ $expenseShow->getExpenseSubCategory->expense_subCategory }}  @endif 
                        </td>
                        {{-- <td class="align-middle" style="text-align:center"></td> --}}
                   
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->expense_date }}</td>
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->expense_amount }}</td>
                        <td class="align-middle" style="text-align:center">{{$expenseShow->fiscal_year  }}</td>
                      
                        <td class="align-middle" style="text-align:center">{{ $expenseShow->descriptation}}</td>
                        <td>
                            <a  href="{{ route('expense.edit',$expenseShow->id) }}" class="btn btn-success"><i class="icofont icofont-check-circled"></i>এডিট </a>
                        </td>
                       
                    </tr>
                    <p hidden> {{ $sl++ }}</p>
                @endforeach

            </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection
