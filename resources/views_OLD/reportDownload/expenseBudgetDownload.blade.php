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
    <title>Expense Budget Report</title>

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
            font-size: 14px;
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
   <p style="font-size: 18x; text-align:center"> জেলা পরিষদ পঞ্চগড় <br>ফরম -"খ"<br> {বিধি ৪ দ্রষ্টব্য}
   <br> ২য়  অংশ ( রাজস্ব ও উন্নয়ন খাতে ব্যয় )  </p>
   <p> অর্থবছর :২০২০-২০২১</p>
</div>


<br/>

<div class="invoice">
    <table  width="100%" class="detail">
        <tr>
            <td style="width: 32%">ব্যয়ের খাত সমূহ </td>
            <td style="width: 17%">২০২১-২০২২ সনের<br> বাজেট বরাদ্দ </td>
            <td style="width: 17%">২০২০-২০২১ সনের <br>সংশোধিত বাজেট  </td>
            <td style="width: 17%">২০১৯-২০২০ সনের <br>প্রকৃত বাজেট  </td>
            <td style="width: 17%">মন্তব্য</td>
        </tr>

        <tr>
            <td style="width: 32%">১ </td>
            <td style="width: 17%">২ </td>
            <td style="width: 17%">৩ </td>
            <td style="width: 17%">৪ </td>
            <td style="width: 17%">৫</td>
        </tr>
        <tr>
            <td  style="text-align: left;font-size: 16px">প্রথম অংশ চলতি হিসাব </td>
        </tr>
        <tr>
            <td style="text-align: left">ক. সাধারণ সংস্থাপনা ব্যয়:<br>১)চেয়ারম্যান এবং সদস্যগণের সম্মানি ভাতা</td>
            <td></td>
            <td>
                @if ($ssB0!='')
                {{$numto->bnNum($ssB0)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২)জেলা পরিষদে প্রেষণে নিয়োজিত কর্মকর্তা/কর্মচারীদের বেতন ভাতা</td>
            <td>
               
            </td>
            <td>
                @if ($ssB1!='')
                {{$numto->bnNum($ssB1)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩)জেলা পরিষদের কর্মকর্তা/কর্মচারীদের বেতন ভাতা</td>
            <td>
               
            </td>
            <td> @if ($ssB2!='')
                {{$numto->bnNum($ssB2)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪)জেলা পরিষদের কর্মচারীদের অবসর-উত্তর ছুটিকালীন বেতন/এককালীন মঞ্জুরী ও আনুতোষিক</td>
            <td></td>
            <td>
                @if ($ssB3!='')
                {{$numto->bnNum($ssB3)}}
                 @endif
            </td>
            <td></td>
            <td></td>
            
        </tr>
        <tr>
            <td  style="text-align: left">৫)জেলা পরিষদের কর্মচারীদের ভবিষ্য তহবিলে প্রদেয় চাঁদা</td>
            <td></td>
            <td>
                @if ($ssB4!='')
                {{$numto->bnNum($ssB4)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৬)কর্মকর্তা/কর্মচারীদের উৎসব,শ্রান্তি বিনোদন ভাতা, নববর্ষ ভাতা</td>
            <td></td>
            <td>
                @if ($ssB5!='')
                {{$numto->bnNum($ssB5)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৭)অন্যান্য ভাতা</td>
            <td></td>
            <td>
                @if ($ssB6!='')
                {{$numto->bnNum($ssB6)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: right">ক অংশের মোট </td>
            <td></td>
            <td>
                @if ($ssB1+$ssB2+$ssB3+$ssB4+$ssB5+$ssB6!='')
                {{$numto->bnNum($ssB0+$ssB1+$ssB2+$ssB3+$ssB4+$ssB5+$ssB6)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
           <td  style="text-align: left">খ)অন্যান্য সংস্থাপনা ব্যায়<br>১)কর্মকর্তা/কর্মচারীদের ভ্রমন ভাতা</td>
                <td></td>
            <td>
                @if ($sIncome1!='')
                {{$numto->bnNum($sIncome1)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২)গাড়ীচালক ও চতুর্থ শ্রেণীর কর্মচারীদের পোষাক/ ছাতা/ জুতা/ ইত্যাদি সরবরাহ </td>
            <td></td>
            <td>
                @if ($sIncome2!='')
                {{$numto->bnNum($sIncome2)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩)জেলা পরিষদের কর্মকর্তা/কর্মচারীদের আকস্মিক মৃত্যুতে সাহায্য প্রদান</td>
            <td></td>
            <td>
                @if ($sIncome3!='')
                {{$numto->bnNum($sIncome3)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ৪ )যানবাহন/জীপগাড়ী মেরামত</td>
            <td></td>
            <td>
                @if ($sIncome4!='')
                {{$numto->bnNum($sIncome4)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৫)যানবাহন জ্বালানী</td>
            <td></td>
            <td>
                @if ($sIncome5!='')
                {{$numto->bnNum($sIncome5)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৬)টেলিফোন বিল ও ইন্টারনেট সংযোগ ও বিল </td>
            <td></td>
            <td>
                @if ($sIncome6!='')
                {{$numto->bnNum($sIncome6)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৭)পৌর কর</td>
            <td></td>
            <td>
                @if ($sIncome7!='')
                {{$numto->bnNum($sIncome7)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ৮)ভূমি উন্নয়ন কর</td>
            <td></td>
            <td>
                @if ($sIncome8!='')
                {{$numto->bnNum($sIncome8)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৯)বিদ্যুৎ /পানি ইত্যাদির বিল</td>
            <td></td>
            <td>
                @if ($sIncome9!='')
                {{$numto->bnNum($sIncome9)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১০)বৈদ্যুতিক সরঞ্জামাদি ক্রয়/মেরামত</td>
            <td></td>
            <td>
                @if ($sIncome10!='')
                {{$numto->bnNum($sIncome10)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ১১)গ্যাস বিল, গ্যাস লাইন স্থাপন/মেরামত ও আনুষংগিক</td>
            <td></td>
            <td>
                @if ($sIncome11!='')
                {{$numto->bnNum($sIncome11)}}
                 @endif
            </td>
          
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১২)মনোহারী দ্রব্যাদি ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome12!='')
                {{$numto->bnNum($sIncome12)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ১৩)ডাক টিকিট ক্রয়/চিঠি প্রেরণ</td>
            <td></td>
            <td>
                @if ($sIncome13!='')
                {{$numto->bnNum($sIncome13)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১৪)বিভিন্ন রেজিস্ট্রার/বই প্রস্তুত/ফরম ইত্যাদি ছাপানো ও বাঁধানো ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome14!='')
                {{$numto->bnNum($sIncome14)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১৫)দৈনিক সংবাদ পত্র/ম্যাগাজিন/বই পুস্তক ইত্যাদি ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome15!='')
                {{$numto->bnNum($sIncome15)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১৬)বিভিন্ন সভা/সমিতি/অনুষ্ঠানে আপ্যায়ন ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome16!='')
                {{$numto->bnNum($sIncome16)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ১৭)কম্পিউটার ক্রয়/মেরামত রক্ষণা বেক্ষণ ইত্যাদি</td>
            <td></td>
            <td>
                @if ($sIncome17!='')
                {{$numto->bnNum($sIncome17)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১৮)ইন্টারকম ক্রয়/মেরামত/রক্ষণা বেক্ষণ ইত্যাদি</td>
            <td></td>
            <td>
                @if ($sIncome18!='')
                {{$numto->bnNum($sIncome18)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১৯)ফটোষ্ট্যাট মেশিন,ফ্যাক্স মেশিন ক্রয়/মেরামত/ রক্ষণা বেক্ষণ ইত্যাদি
          </td>
          <td></td>
          <td>
              @if ($sIncome19!='')
              {{$numto->bnNum($sIncome19)}}
               @endif
          </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২০)ডিজিটাল ডুপ্লিকেটিং মেশিন ক্রয়/মেরামত</td>
            <td></td>
            <td>
                @if ($sIncome20!='')
                {{$numto->bnNum($sIncome20)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২১)প্রকৌশল বিভাগের যন্ত্রপাতি ও অন্যান্য দ্রব্যাদি ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome21!='')
                {{$numto->bnNum($sIncome21)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২২)রোড রোলার ক্রয়/মেরামত/রক্ষণা বেক্ষণ ইত্যাদি</td>
            <td></td>
            <td>
                @if ($sIncome22!='')
                {{$numto->bnNum($sIncome22)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৩)যানবাহন (জীপ,পিকআপ,মাইক্রোবাস ইত্যাদি) ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome23!='')
                {{$numto->bnNum($sIncome23)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৪)মোটর সাইকেল ক্রয়/ মেরামত </td>
            <td></td>
            <td>
                @if ($sIncome24!='')
                {{$numto->bnNum($sIncome24)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৫)অফিস ও ডাকবাংলোর জন্য ক্রোকারিজ দ্রব্যাদি ক্রয় </td>
            <td></td>
            <td>
                @if ($sIncome25!='')
                {{$numto->bnNum($sIncome25)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৬)মামলা মোকদ্দমা ব্যয় ও আইন উপদেষ্টার সম্মানি ভাতা </td>
            <td></td>
            <td>
                @if ($sIncome26!='')
                {{$numto->bnNum($sIncome26)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৭)টেন্ডার নোটিশ/কোটেশন/পত্রিকায় বিজ্ঞাপন বাবদ ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome27!='')
                {{$numto->bnNum($sIncome27)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">	
                ২৮) বিভিন্ন জাতীয় অনুষ্ঠান উদযাপন উপলক্ষে ব্যয়</td>
                <td></td>
                <td>
                    @if ($sIncome28!='')
                    {{$numto->bnNum($sIncome28)}}
                     @endif
                </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২৯)জেলা পরিষদের কর্মচারীগণের কল্যান তহবিল</td>
            <td></td>
            <td>
                @if ($sIncome29!='')
                {{$numto->bnNum($sIncome29)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩০)জেলা পরিষদের কর্মকর্তা/কর্মচারীগণের পোষ্যদের শিক্ষা অনুদান</td>
            <td></td>
            <td>
                @if ($sIncome30!='')
                {{$numto->bnNum($sIncome30)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩১)জেলা পরিষদের কর্মকর্তা/কর্মচারীগণের পোষ্যদের চিকিৎসা  অনুদান</td>
            <td></td>
            <td>
                @if ($sIncome31!='')
                {{$numto->bnNum($sIncome31)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩২)ত্রাণ তহবিল</td>
            <td></td>
            <td>
                @if ($sIncome32!='')
                {{$numto->bnNum($sIncome32)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৩)মুক্তিযোদ্ধা/মুক্তিযোদ্ধা পরিবারবর্গের জন্য বিভিন্ন কর্মসূচি বাবদ ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome33!='')
                {{$numto->bnNum($sIncome33)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৪)বিভিন্ন প্রশিক্ষন কর্মসূচি বাবদ ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome34!='')
                {{$numto->bnNum($sIncome34)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৫)জেলা পরিষদের সম্পত্তি রক্ষণা বেক্ষণ বাবদ ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome35!='')
                {{$numto->bnNum($sIncome35)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৬)খেয়াঘাট/পুকুর মেরামত/সংস্কার বাবদ ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome36!='')
                {{$numto->bnNum($sIncome36)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৭)পরিস্কার পরিচ্ছন্নতা কায্যক্রম</td>
            <td></td>
            <td>
                @if ($sIncome37!='')
                {{$numto->bnNum($sIncome37)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৮)তাৎক্ষণিক ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome38!='')
                {{$numto->bnNum($sIncome38)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩৯)অপ্রত্যাশিত ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome39!='')
                {{$numto->bnNum($sIncome39)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪০)অফিসার্স ডরমেটরী ভবন রক্ষণা বেক্ষণ</td>
            <td></td>
            <td>
                @if ($sIncome40!='')
                {{$numto->bnNum($sIncome40)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪১)কর্মকর্তা/কর্মচারীগণের বাস ভবন মেরামত/সংস্কার</td>
            <td></td>
            <td>
                @if ($sIncome41!='')
                {{$numto->bnNum($sIncome41)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪২)জেলা পরিষদ মিলনায়তন সংস্কার ও আসবাবপত্র ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome42!='')
                {{$numto->bnNum($sIncome42)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৩)জেলা পরিষদের অফিস সম্প্রসারন/পুনঃ নির্মাণ/সংস্কার ও আসবাবপত্র ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome43!='')
                {{$numto->bnNum($sIncome43)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৪)জেলা পরিষদের ডাকবাংলো/অডিটরিয়াম সংস্কার /পুনঃনির্মাণ/রক্ষণা বেক্ষণ</td>
            <td></td>
            <td>
                @if ($sIncome44!='')
                {{$numto->bnNum($sIncome44)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৫)জেলা পরিষদের লাইব্রেরী উন্নয়ন ও বই পুস্তক ক্রয়</td>
            <td></td>
            <td>
                @if ($sIncome45!='')
                {{$numto->bnNum($sIncome45)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৬)জেলা পরিষদের গাড়ী রেজিস্টেশন/নবায়ন/বীমা ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome46!='')
                {{$numto->bnNum($sIncome46)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৭)নিজেস্ব প্রতিষ্ঠান পরিচালনা ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome47!='')
                {{$numto->bnNum($sIncome47)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৮)বিভিন্ন সভা/দরপত্র মূল্যায়ন/নিয়োগ কমিটির সমস্যদের সম্মানী</td>
            <td></td>
            <td>
                @if ($sIncome48!='')
                {{$numto->bnNum($sIncome48)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪৯)তথ্য ও যোাগাযোগ প্রযুক্তি</td>
            <td></td>
            <td>
                @if ($sIncome49!='')
                {{$numto->bnNum($sIncome49)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৫০)ধোলাই ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome50!='')
                {{$numto->bnNum($sIncome50)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৫১)অন্যান্য ব্যয়</td>
            <td></td>
            <td>
                @if ($sIncome51!='')
                {{$numto->bnNum($sIncome51)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: right">খ অংশের মোট </td>
            <td></td>
            <td>
                @if ($sIncomeSum!='')
                {{$numto->bnNum($sIncomeSum)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left;font-size:15px">সরকারি উন্নয়ন দ্বারা উন্নয়ন<br>সরকার কর্তৃক মঞ্জুরকৃত অর্থ (সরকারি খাতে ব্যায় প্রকল্প বাস্তবায়নে)</td>
            <td>
        
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১|বার্ষিক উন্নয়ন কর্মসূচী (এডিপি) এর সাধারণ বরাদ্দ</td>
            <td></td>
            <td>
                @if ($gov1!='')
                {{$numto->bnNum($gov1)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ২|বার্ষিক উন্নয়ন কর্মসূচী (এডিপি) এডিপি এর বিশেষ বরাদ্দ</td>
            <td></td>
            <td>
                @if ($gov2!='')
                {{$numto->bnNum($gov2)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩|অন্যান্য (অনুন্নয়ন ব্যয়)</td>
            <td></td>
            <td>
                @if ($gov3!='')
                {{$numto->bnNum($gov3)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">গ অংশের মোট</td>
            <td></td>
            <td>
                @if ($gov1+$gov2+$gov3!='')
                {{$numto->bnNum($gov1+$gov2+$gov3)}}
                 @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> মোট : ১ম অংশ (নিজস্ব তহবিল ও সরকারি অনুদান - ক+খ +গ )</td>
            <td></td>
            <td>
                @if ($ssB0+$ssB1+$ssB2+$ssB3+$ssB4+$ssB5+$ssB6+$sIncomeSum+$gov1+$gov2+$gov3!='')
                {{$numto->bnNum($ssB0+$ssB1+$ssB2+$ssB3+$ssB4+$ssB5+$ssB6+$sIncomeSum+$gov1+$gov2+$gov3)}}
                 @endif
            </td>
            
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২য় অংশ - মূলধন হিসাব:</td>
            <td>
               
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১)কর্মচারীদের গৃহ নির্মাণ/মেরামত ঋণ</td>
            <td></td>
            <td>
                @if ($mul1!='')
                {{$numto->bnNum($mul1)}}
                 @endif
            </td>
           
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ২)কর্মচারীদের মোটর সাইকেল/বাই-সাইকেল ক্রয় বাবদ ঋণ</td>
            <td></td>
            <td>
                @if ($mul2!='')
                {{$numto->bnNum($mul2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩)জামানত ফেরত</td>
            <td></td>
            <td>
                @if ($mul3!='')
                {{$numto->bnNum($mul3)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪)ভ্যাট</td>
            <td></td>
            <td>
                @if ($mul4!='')
                {{$numto->bnNum($mul4)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৫)আয়কর</td>
            <td></td>
            <td>
                @if ($mul5!='')
                {{$numto->bnNum($mul5)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৬)বিগত বছরের অসমাপ্ত প্রকল্পের ব্যয় (নিজস্ব ও এডিপি)</td>
            <td></td>
            <td>
                @if ($mul6!='')
                {{$numto->bnNum($mul6)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৭)অন্যান্য (ব্যাংক কর্তন)</td>
            <td></td>
            <td>
                @if ($mul7!='')
                {{$numto->bnNum($mul7)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">মোট : ২য় অংশ (১ থেকে ৭ এর যোগফল )</td>
            <td></td>
            <td>
                @if ($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7!='')
                {{$numto->bnNum($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">মোট ব্যায় (১ম অংশ + ২য় অংশ ) </td>
            <td></td>
            <td>
                @if ($sumAll!='')
                {{$numto->bnNum($sumAll)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td></td>
            <td></td>
        </tr>
       
    </table>
    
</div>

</body>
</html>