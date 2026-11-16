<?php

/**
 * Trait untuk escaping input (SQL Injection prevention).
 */
trait EscapeTrait
{
    public function esc($value)
    {
        return mysql_real_escape_string(trim($value));
    }
}
