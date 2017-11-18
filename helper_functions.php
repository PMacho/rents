<?php

function returner($x){
    if (is_array($x) && sizeof($x) == 1) return $x[0];
    return $x;
}