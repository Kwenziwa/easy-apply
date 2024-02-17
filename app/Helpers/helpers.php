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
