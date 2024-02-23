<?php

if (!function_exists('customBadge')) {
    function customBadge($type)
    {
        if ($type == 'admin')
            echo "<span class='badge rounded-pill bg-primary'>Admin</span>";
        elseif ($type == 'university')
            echo "<span class='badge rounded-pill bg-info'>University</span>";
        else
            echo "<span class='badge rounded-pill bg-dark'>Student</span>";
    }
}

if (!function_exists('verificationBadge')) {
    function verificationBadge($date)
    {
        if (empty($date))
            echo "<span class='badge rounded-pill bg-primary'>Admin</span>";
        elseif ($date == 'university')
            echo "<span class='badge rounded-pill bg-info'>University</span>";
        else
            echo "<span class='badge rounded-pill bg-dark'>Student</span>";
    }
}


if (!function_exists('redirectToHomePage')) {
    function redirectToHomePage($role)
    {
        return match ($role) {
            0 => 'student.home',
            1 => 'admin.home',
            2 => 'university.home',
            default => '/home',
        };
    }
}
