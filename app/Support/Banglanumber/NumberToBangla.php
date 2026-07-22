<?php

namespace Rakibhstu\Banglanumber;

class NumberToBangla
{
    private const ENGLISH_DIGITS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    private const BANGLA_DIGITS = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    private const ONES = [
        0 => 'শূন্য',
        1 => 'এক',
        2 => 'দুই',
        3 => 'তিন',
        4 => 'চার',
        5 => 'পাঁচ',
        6 => 'ছয়',
        7 => 'সাত',
        8 => 'আট',
        9 => 'নয়',
        10 => 'দশ',
        11 => 'এগারো',
        12 => 'বারো',
        13 => 'তেরো',
        14 => 'চৌদ্দ',
        15 => 'পনেরো',
        16 => 'ষোল',
        17 => 'সতেরো',
        18 => 'আঠারো',
        19 => 'উনিশ',
    ];
    private const TENS = [
        2 => 'বিশ',
        3 => 'ত্রিশ',
        4 => 'চল্লিশ',
        5 => 'পঞ্চাশ',
        6 => 'ষাট',
        7 => 'সত্তর',
        8 => 'আশি',
        9 => 'নব্বই',
    ];
    private const SPECIAL_TWODIGIT = [
        20 => 'বিশ',
        21 => 'একুশ',
        22 => 'বাইশ',
        23 => 'তেইশ',
        24 => 'চব্বিশ',
        25 => 'পঁচিশ',
        26 => 'ছাব্বিশ',
        27 => 'সাতাশ',
        28 => 'আটাশ',
        29 => 'ঊনত্রিশ',
        30 => 'ত্রিশ',
        31 => 'একত্রিশ',
        32 => 'বত্রিশ',
        33 => 'তেত্রিশ',
        34 => 'চৌত্রিশ',
        35 => 'পঁয়ত্রিশ',
        36 => 'ছত্রিশ',
        37 => 'সাঁইত্রিশ',
        38 => 'আটত্রিশ',
        39 => 'ঊনচল্লিশ',
        40 => 'চল্লিশ',
        41 => 'একচল্লিশ',
        42 => 'বিয়াল্লিশ',
        43 => 'তেতাল্লিশ',
        44 => 'চুয়াল্লিশ',
        45 => 'পঁয়তাল্লিশ',
        46 => 'ছেচল্লিশ',
        47 => 'সাতচল্লিশ',
        48 => 'আটচল্লিশ',
        49 => 'ঊনপঞ্চাশ',
        50 => 'পঞ্চাশ',
        51 => 'একান্ন',
        52 => 'বাহান্ন',
        53 => 'তেপ্পান্ন',
        54 => 'চুয়ান্ন',
        55 => 'পঞ্চান্ন',
        56 => 'ছাপ্পান্ন',
        57 => 'সাতান্ন',
        58 => 'আটান্ন',
        59 => 'ঊনষাট',
        60 => 'ষাট',
        61 => 'একষট্টি',
        62 => 'বাষট্টি',
        63 => 'তেষট্টি',
        64 => 'চৌষট্টি',
        65 => 'পঁয়ষট্টি',
        66 => 'ছেষট্টি',
        67 => 'সাতষট্টি',
        68 => 'আটষট্টি',
        69 => 'ঊনসত্তর',
        70 => 'সত্তর',
        71 => 'একাত্তর',
        72 => 'বাহাত্তর',
        73 => 'তিয়াত্তর',
        74 => 'চুয়াত্তর',
        75 => 'পঁচাত্তর',
        76 => 'ছিয়াত্তর',
        77 => 'সাতাত্তর',
        78 => 'আটাত্তর',
        79 => 'ঊনআশি',
        80 => 'আশি',
        81 => 'একাশি',
        82 => 'বিরাশি',
        83 => 'তিরাশি',
        84 => 'চুরাশি',
        85 => 'পঁচাশি',
        86 => 'ছিয়াশি',
        87 => 'সাতাশি',
        88 => 'আটাশি',
        89 => 'ঊননব্বই',
        90 => 'নব্বই',
        91 => 'একানব্বই',
        92 => 'বিরানব্বই',
        93 => 'তিরানব্বই',
        94 => 'চুরানব্বই',
        95 => 'পঁচানব্বই',
        96 => 'ছিয়ানব্বই',
        97 => 'সাতানব্বই',
        98 => 'আটানব্বই',
        99 => 'নিরানব্বই',
    ];
    private const SCALES = [
        10000000 => 'কোটি',
        100000 => 'লক্ষ',
        1000 => 'হাজার',
        100 => 'শত',
    ];

    public function bnNum($value): string
    {
        return str_replace(self::ENGLISH_DIGITS, self::BANGLA_DIGITS, (string) $value);
    }

    public function bnMoney($value): string
    {
        $normalized = (float) $value;
        $taka = (int) floor($normalized);
        $poisha = (int) round(($normalized - $taka) * 100);

        $parts = [];

        if ($taka > 0) {
            $parts[] = $this->toWords($taka) . ' টাকা';
        }

        if ($poisha > 0) {
            $parts[] = $this->toWords($poisha) . ' পয়সা';
        }

        if ($parts === []) {
            return 'শূন্য টাকা';
        }

        return implode(' ', $parts);
    }

    private function toWords(int $number): string
    {
        if ($number < 20) {
            return self::ONES[$number];
        }

        if ($number < 100) {
            if (isset(self::SPECIAL_TWODIGIT[$number])) {
                return self::SPECIAL_TWODIGIT[$number];
            }

            $tens = intdiv($number, 10);
            $remainder = $number % 10;

            return trim(self::TENS[$tens] . ' ' . ($remainder ? $this->toWords($remainder) : ''));
        }

        foreach (self::SCALES as $scale => $label) {
            if ($number >= $scale) {
                $major = intdiv($number, $scale);
                $remainder = $number % $scale;

                if ($scale === 100 && $major > 1 && $major < 10) {
                    $majorWord = $this->toWords($major) . 'শ';
                    return trim($majorWord . ' ' . ($remainder ? $this->toWords($remainder) : ''));
                }

                return trim($this->toWords($major) . ' ' . $label . ' ' . ($remainder ? $this->toWords($remainder) : ''));
            }
        }

        return '';
    }
}
