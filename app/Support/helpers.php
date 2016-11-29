<?php

/**
 * Generate a code based on the given integer.
 *
 * @param  integer  $integer
 * @return string
 */
function generate_code($integer)
{
    return base_convert(($integer + 9999999), 10, 36);
}
