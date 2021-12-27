<?php

function absolutToInteger($int): int
    {

        if ( $int > 0) {
            return ($int - 1) % 9 + 1;
        }
            return 0;

    }
print_r(absolutToInteger(1234));