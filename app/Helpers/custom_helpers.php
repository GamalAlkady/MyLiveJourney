<?php
// File: app/Helpers/custom_helpers.php

use App\Helpers\IconHelper;
use Illuminate\Support\Facades\Auth;

if (!function_exists('formatPrice')) {
    /**
     * Formats a number into a price string.
     *
     * @param float $amount
     * @param string $currency
     * @return string
     */
    function formatPrice($amount, $currency = 'sar')
    {
        // Use number_format for basic formatting
        // In a real app, you might use a more robust library
        return   number_format($amount, 2) .' ' . __('currency.'. $currency);
    }
}

if (!function_exists('generateRandomSlug')) {
    /**
     * Generates a URL-friendly slug from a string.
     *
     * @param string $string
     * @return string
     */
    function generateRandomSlug($string)
    {
        // Convert to lowercase and replace spaces with a hyphen
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
        return $slug;
    }
}

if (!function_exists('getDate2')) {

    function getDate2($datetime)
    {
        // return $datetime->diffForHumans();  
        return  \Carbon\Carbon::parse($datetime)->format('Y-m-d');
    }
}

if (!function_exists('getTime')) {

    function getTime($datetime)
    {
        return  \Carbon\Carbon::parse($datetime)->format('H:i:s');
    }
}

if (!function_exists('rolePrefix')) {
    function rolePrefix()
    {
        return session('role', 'user'); // قيمة افتراضية
    }
}

if (!function_exists('icon')) {
    function icon(string $name, ?string $class = null): string
    {
        return IconHelper::get($name, $class);
    }
}