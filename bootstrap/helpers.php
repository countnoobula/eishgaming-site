<?php

if (!function_exists('k')) {
    function k($number) {
        if ($number > 999) {
            return round($number / 1000, 2) ."k";
        }
        return round($number, 2);
    }
}
