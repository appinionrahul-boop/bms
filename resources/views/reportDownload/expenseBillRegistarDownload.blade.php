@php
    
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numto = new NumberToBangla();
@endphp

@php
 
class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}
@endphp
<!doctype html>

<html >
    
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Expense Report</title>

    <style type="text/css">
    @font-face {
        font-family: 'FreeSerif', sans-serif; 
    }
        body {
            margin: 0px;
            font-family: 'FreeSerif', sans-serif;
        }
   
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
            
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
      
       table, tr, td {
            border: 1px solid black;
            text-align: center;
        }
       table {
        border-collapse: collapse;
        }
        .p2{
            margin-top: -40px;
        }
        .invoice{
            margin-top: -50px;
        }
        .t2{
            margin-right: -50px"
        }
       
    </style>

</head>
<body>
    {{-- <a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a> --}}
<div class="">
<p style="font-size: 24x; text-align:center"> জেলা পরিষদ পঞ্চগড় <br>ব্যয় বিল রেজিস্টার (রাজস্ব ) <br><br>অর্থবছর :২০২৫-২০২৬</p>
   {{-- <p style="font-size: 20px; text-align:center"> অর্থবছর ২০২৪-২০২৫</p> --}}
</div>


<br/>

<div class="invoice">
    
    <table width="100%" class="detail">
        <thead>
        <tr>
            {{-- <td style="width: 20%">আয়ের খাত সমূহ </td> --}}
            <td style="width: 4%">ক্রমিক নং:</td>
            <td style="width: 10%">ভাউচার নাম্বার <br>ও তারিখ </td>
            {{-- <td style="width: 10%">ভাউচার নাম্বার </td> --}}
            <td style="width: 10%">চেক নাম্বার <br>ও তারিখ </td>
            <td style="width: 20%">বিলের বিবরণ </td>
            <td style="width: 10%">টাকার পরিমাণ </td>
            <td style="width: 15%">প্রধান নির্বাহী  কর্মকর্তার স্বাক্ষর  </td>
            <td style="width: 15%">প্রশাসক/ চেয়ারম্যানের স্বাক্ষর</td>
            <td style="width: 15%">হিসাবের খাত  </td>
            <td style="width: 15%">চেক গ্রহণকারীর<br> স্বাক্ষর </td>
        </tr>
        </thead>
        <tbody>
           <p hidden>{{ $sum = 0 }}</p>
           <p hidden>{{ $sl = 1 }}</p>
            @foreach ($expense as $incomeShow)
            <tr>
                <td class="align-middle" style="text-align:center">{{ $numto->bnNum($sl) }}</td>
                
                <td style="text-align: center" style="width: 10%">{{ $incomeShow->voucher_no }} <br>{{BanglaConverter::en2bn($incomeShow->expense_date ) }} </td>
                <td style="text-align: center" style="width: 10%">{{ $incomeShow->expense_cheque }}
                    {{-- @if ($incomeShow->vat_cheque_descriptation!=NULL)
                    <br>
                    {{ $incomeShow->vat_cheque_descriptation }}
                    @endif
    
                    @if ($incomeShow->tax_cheque_descriptation!=NULL)
                    <br>
                    {{ $incomeShow->tax_cheque_descriptation }}
                    @endif --}}
                </td>
                <td style="text-align: center" style="width: 20%">{{ $incomeShow->descriptation }} 
                    {{-- @if ($incomeShow->expense_folio!=NULL)
                    <br>
                    {{ $incomeShow->expense_folio }}
                    @endif
    
                    @if ($incomeShow->tax_desriptation!=NULL)
                    <br>
                    {{ $incomeShow->tax_desriptation }}
                    @endif --}}
                </td>
                <td style="text-align: center" style="width: 10%">{{ $numto->bnNum($incomeShow->expense_amount)   }}
                    {{-- @if ($incomeShow->vat_amount!=NULL)
                    <br>ভ্যাট =
                    {{ $numto->bnNum($incomeShow->vat_amount )}}
                    @endif
    
                    @if ($incomeShow->tax_amount!=NULL)
                    <br>আয়কর =
                    {{$numto->bnNum( $incomeShow->tax_amount )}}
                    @endif
                <br>মোট = {{ $numto->bnNum($incomeShow->totalExpense)   }} --}}
                </td>
                <td style="text-align: center" style="width: 15%"> </td>
                <td style="text-align: center" style="width: 15%"> </td>
                <td style="text-align: center" style="width: 15%"> </td>
                <td style="text-align: center" style="width: 15%"> </td>
                {{-- <p hidden>{{ $sum +=$incomeShow->expense_amount  }}</p>  --}}
            </tr>
            <p hidden> {{ $sl++ }}</p> 
            @if ($incomeShow->vat_cheque_descriptation!=NULL)
                <tr>
                    <td class="align-middle" style="text-align:center">{{ $numto->bnNum($sl) }}</td>
                    
                    <td style="text-align: center" style="width: 10%">{{ $incomeShow->voucher_no }} <br>{{BanglaConverter::en2bn($incomeShow->expense_date ) }} </td>
                    <td style="text-align: center" style="width: 10%">{{ $incomeShow->vat_cheque_descriptation }}
                    </td>
                    <td style="text-align: center" style="width: 20%">{{ $incomeShow->expense_folio }} 
                    
                    </td>
                    <td style="text-align: center" style="width: 10%">{{ $numto->bnNum($incomeShow->vat_amount)   }}
                    </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    {{-- <p hidden>{{ $sum +=$incomeShow->vat_amount  }}</p>  --}}
                </tr>
                <p hidden> {{ $sl++ }}</p> 
                @endif

                @if ($incomeShow->tax_cheque_descriptation!=NULL)
                <tr>
                    <td class="align-middle" style="text-align:center">{{ $numto->bnNum($sl) }}</td>
                    
                    <td style="text-align: center" style="width: 10%">{{ $incomeShow->voucher_no }} <br>{{BanglaConverter::en2bn($incomeShow->expense_date ) }} </td>
                    <td style="text-align: center" style="width: 10%">{{ $incomeShow->tax_cheque_descriptation }}
                    </td>
                    <td style="text-align: center" style="width: 20%">{{ $incomeShow->tax_desriptation }} 
                    
                    </td>
                    <td style="text-align: center" style="width: 10%">{{ $numto->bnNum($incomeShow->tax_amount)   }}
                    </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    <td style="text-align: center" style="width: 15%"> </td>
                    {{-- <p hidden>{{ $sum +=$incomeShow->tax_amount  }}</p>  --}}
                </tr>
                <p hidden> {{ $sl++ }}</p> 
                @endif
            @endforeach
  

        </tbody>
       
        </tfoot>
    </table>
</div>

{{-- <div class="" style="position: absolute; bottom: 40;">
    <table width="100%" style="border:0">
        <tr style="border: 0">
            <td align="left" style="width: 50%;" style="border: 0">
              
                 <p>-------------------------<br>মোঃ আব্দুল আলীম খান ওয়ারেশী <br>প্রধান নির্বাহী কর্মকর্তা <br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
            <td align="center" style="width: 40%;" style="border: 0">
                <p class="t2">-----------------<br>মোঃ আনোয়ার সাদাত  <br>চেয়ারম্যান<br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
        </tr>

    </table>
</div> --}}
</body>
</html>