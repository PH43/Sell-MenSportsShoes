<?php

if (!function_exists('format_money'))
{
    function format_money($amount): string
    {
        return number_format($amount, 0, ',', '.');
    }
}
