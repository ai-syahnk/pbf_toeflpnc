<?php

if (! function_exists('tanggal_panjang')) {
    /**
     * Konversi tanggal ke format panjang Indonesia.
     * Contoh: "6 Maret 2026"
     *
     * @param  DateTimeInterface|string|int|null  $tanggal
     */
    function tanggal_panjang($tanggal): string
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $dt = $tanggal instanceof DateTimeInterface
            ? $tanggal
            : new DateTime(is_int($tanggal) ? '@'.$tanggal : (string) $tanggal);

        return (int) $dt->format('j').' '.$bulan[(int) $dt->format('n')].' '.$dt->format('Y');
    }
}
