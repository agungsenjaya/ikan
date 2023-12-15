<?php
function rupiah($e){
    $locale = 'id';
    $currency = 'IDR';
    $price = intval($e);
    $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    $formattedPrice = $fmt->formatCurrency($price, $currency);
    return $formattedPrice;
}