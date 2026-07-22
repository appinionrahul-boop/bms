@php
    
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numto = new NumberToBangla();
    
@endphp
@php
    $maxCount=$expenseCount;
    if($incomeCount>=$expenseCount){
        $maxCount=$incomeCount;
    }
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
    <title>Cash Book Report</title>

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
        /* .invoice{
            margin-top: -50px;
        } */
        .t2{
            margin-right: -50px"
        }
       

        .hd1{
            margin-top: -40px;
        }
       
    </style>

</head>
<body>
    {{-- <a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a> --}}
    <p hidden>{{ $r = " " }}</p>
<div class="">
    <table width="100%" style="border:0">
        <tr style="border: 0">
        <td style="border: 0"><p style="text-align: justify">জমা /Dr. <br>জমা খরচের খাতা<br>Cash Book of </p></td>
        <td style="border: 0"> <p style=" text-align:" class=""> জেলা পরিষদ পঞ্চগড় <br>মাসের নাম <br>Name of The Month<br>{{BanglaConverter::en2bn($startDate)}} {{$r}}হতে  {{$r}}{{BanglaConverter::en2bn($endDate)}}<br>(রাজস্ব)</p></td>
        <td style="border: 0">
            <p >খরচ /Cr.<br>Year:<?php echo date("Y"); ?></p>
        </td>
        </tr>
    </table>
    
  
</div>


<br/>
<div class="invoice">
  
    <table width="100%" class="detail">
        <thead>
            <tr>
                <td style="width: 8%">মাস ও <br>তারিখ<br>Month & Date</td>
                <td style="width: 9%">ভাউচার <br>নং/চেক নং <br>Voucher No/ Cheque No  </td>
                <td style="width: 10%"> বিবরণ<br>Particulars </td>
                <td style="width: 4%"> ফোলিও<br>Folio  </td>
                <td style="width: 9%">পরিমাণ<br>Amount<br> টাকা</td>
                {{-- <td style="width: 6%">পরিমাণ<br>Amount<br> পয়সা</td> --}}
                <td style="width: 9%">মোট<br>Total </td>
                <td style="width: 8%" >মাস ও <br>তারিখ<br>Month & Date</td>
                <td style="width: 9%">ভাউচার <br>নং/চেক নং <br>Voucher No/ Cheque No  </td>
                <td style="width: 11%"> বিবরণ <br>Particulars </td>
                <td style="width: 5%"> ফোলিও <br>Folio  </td>
                <td style="width: 9%">পরিমাণ<br>Amount<br> টাকা</td>
                {{-- <td style="width: 6%">পরিমাণ<br>Amount<br> পয়সা</td> --}}
                <td style="width: 9%">মোট<br>Total </td>

            </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sumIncome = 0 }}</p>
            <p hidden>{{ $sumExpense = 0 }}</p>
            <p hidden>{{ $i = 0 }}</p>
            @for ($j = 0; $j <= $maxCount-1; $j++)
            <tr>
                @if ($i<=$incomeCount-1)
                <td>{{BanglaConverter::en2bn( $income[$j]->income_date) }} </td>
                <td>{{ $income[$j]->voucher_no }}<br>{{ $income[$j]->income_cheque }}</td>
                <td>{{ $income[$j]->income_descriptation }}</td>
                <td></td>
                <td>{{ $numto->bnNum($income[$j]->income_amount)   }}</td>
                {{-- <td ></td> --}}
                <td ></td>
                <p hidden>{{ $sumIncome +=$income[$j]->income_amount  }}</p> 
            @else
               <td></td>
               {{-- <td></td> --}}
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            @endif
          
         
           @if ($i<=$expenseCount-1)
           <td>{{BanglaConverter::en2bn($expense[$j]->expense_date)}}</td>
           <td>{{$expense[$j]->voucher_no}}<br>{{$expense[$j]->expense_cheque}}<br>{{$expense[$j]->vat_cheque_descriptation}}<br>{{$expense[$j]->tax_cheque_descriptation}}</td>
           <td>{{$expense[$j]->descriptation}}

                @if ($expense[$j]->expense_folio!=NULL)
                <br>
                {{ $expense[$j]->expense_folio }}
                @endif
               

                @if ($expense[$j]->tax_desriptation!=NULL)
                <br>
                {{ $expense[$j]->tax_desriptation }}
                @endif

            </td>
           <td></td>
           <td>{{$numto->bnNum($expense[$j]->expense_amount)}}
                @if ($expense[$i]->vat_amount!=NULL)
                <br>ভ্যাট =
                {{ $numto->bnNum($expense[$j]->vat_amount )}}
                @endif

                @if ($expense[$j]->tax_amount!=NULL)
                <br>আয়কর =
                {{$numto->bnNum( $expense[$j]->tax_amount )}}
                @endif
            </td>
           {{-- <td></td> --}}
           <td></td>
           <p hidden>{{ $sumExpense +=$expense[$j]->totalExpense  }}</p> 
           @else
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               {{-- <td></td> --}}
               <td></td>
               <td></td>
           @endif
               {{-- <p hidden>{{ $sumIncome +=$mergeTbl->income_amount  }}</p>  --}}
              
            </tr>
            <p hidden>{{ $i++ }}</p>
            @endfor
            <p hidden>{{ $balance =$sumIncome-$sumExpense  }}</p>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                {{-- <td>মোট আয়</td> --}}
                <td>{{$numto->bnNum($sumIncome)}} </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                {{-- <td>মোট ব্যায় </td> --}}
                <td>{{$numto->bnNum($sumExpense)}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                {{-- <td></td>
                <td></td> --}}
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td > <br><br>স্থিতি </td>
                <td>{{$numto->bnNum($sumIncome)}}<br>{{$numto->bnNum($sumExpense)}}<br>{{$numto->bnNum($balance)}}</td>
            </tr>
          

        </tbody>
       


    </table>
</div>

    {{-- <div class="" style="position: absolute; bottom: 20;">
    <table width="100%" style="border:0">
        <tr style="border: 0">
            <td align="left" style="width: 50%;" style="border: 0">
                
                    <p>------------------------- <br>প্রধান নির্বাহী কর্মকর্তা <br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
            <td align="center" style="width: 40%;" style="border: 0">
                <p class="t2">----------------- <br>চেয়ারম্যান<br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
        </tr>

    </table>
    </div> --}}
</body>
</html>