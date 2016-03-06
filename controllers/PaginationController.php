<?php

function pagination($photosCount, $perPage)
{
    $pageCount = ceil($photosCount / $perPage);
    for ($i = 1; $i <= $pageCount; $i++) {
        echo "<li><a href=\"$i\">$i</a></li>";
    }
}