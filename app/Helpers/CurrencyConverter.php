<?php

function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function rupiahToInt($rupiah)
{
    $cleanRupiah = preg_replace("/[^0-9]/", "", $rupiah);
    return intval($cleanRupiah);
}
