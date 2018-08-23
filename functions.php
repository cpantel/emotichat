<?php

function now() {
    $date  = new DateTime();
    return $date->format('Y-m-d_H-i-s');
}

