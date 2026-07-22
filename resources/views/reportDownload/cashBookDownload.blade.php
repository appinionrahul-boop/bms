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
                font-size: 13px;
                
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
    @php $balance = $sumIncome - $sumExpense; @endphp
    @foreach ($rowChunks as $chunkIndex => $rows)
    <table width="100%" class="detail">
        <thead>
            <tr>
                <td style="width: 8%">মাস ও <br>তারিখ<br>Month & Date</td>
                <td style="width: 9%">ভাউচার <br>নং/চেক নং <br>Voucher No/ Cheque No  </td>
                <td style="width: 14%"> বিবরণ<br>Particulars </td>
                <td style="width: 9%">পরিমাণ<br>Amount<br> টাকা</td>
                <td style="width: 9%">মোট<br>Total </td>
                <td style="width: 8%" >মাস ও <br>তারিখ<br>Month & Date</td>
                <td style="width: 9%">ভাউচার <br>নং/চেক নং <br>Voucher No/ Cheque No  </td>
                <td style="width: 15%"> বিবরণ <br>Particulars </td>
                <td style="width: 9%">পরিমাণ<br>Amount<br> টাকা</td>
                <td style="width: 9%">মোট<br>Total </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
            @php
                $incomeRow = $row['income'];
                $expenseRow = $row['expense'];
            @endphp
            <tr>
                @if ($incomeRow)
                    <td>{{ BanglaConverter::en2bn($incomeRow->income_date) }}</td>
                    <td>{{ $incomeRow->voucher_no }}<br>{{ $incomeRow->income_cheque }}</td>
                    <td>{{ $incomeRow->income_descriptation }}</td>
                    <td>{{ $numto->bnNum($incomeRow->income_amount) }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @endif

                @if ($expenseRow)
                    <td>{{ BanglaConverter::en2bn($expenseRow->expense_date) }}</td>
                    <td>{{ $expenseRow->voucher_no }}<br>{{ $expenseRow->expense_cheque }}<br>{{ $expenseRow->vat_cheque_descriptation }}<br>{{ $expenseRow->tax_cheque_descriptation }}</td>
                    <td>{{ $expenseRow->descriptation }}
                        @if ($expenseRow->expense_folio)
                            <br>{{ $expenseRow->expense_folio }}
                        @endif
                        @if ($expenseRow->tax_desriptation)
                            <br>{{ $expenseRow->tax_desriptation }}
                        @endif
                    </td>
                    <td>{{ $numto->bnNum($expenseRow->expense_amount) }}
                        @if ($expenseRow->vat_amount)
                            <br>{{ $numto->bnNum($expenseRow->vat_amount) }}
                        @endif
                        @if ($expenseRow->tax_amount)
                            <br>{{ $numto->bnNum($expenseRow->tax_amount) }}
                        @endif
                    </td>
                    <td></td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @endif
            </tr>
            @endforeach

            @if ($chunkIndex === $rowChunks->count() - 1)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $numto->bnNum($sumIncome) }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $numto->bnNum($sumExpense) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><br><br>স্থিতি</td>
                <td>{{ $numto->bnNum($sumIncome) }}<br>{{ $numto->bnNum($sumExpense) }}<br>{{ $numto->bnNum($balance) }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if ($chunkIndex !== $rowChunks->count() - 1)
        <html-separator/>
    @endif
    @endforeach
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
