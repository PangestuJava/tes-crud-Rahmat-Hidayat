<?php
class ValidationService
{
    public function required(array $fields, array $data)
    {
        foreach ($fields as $f) {
            if (!isset($data[$f]) || trim($data[$f]) === '') {
                return "Field '$f' wajib diisi.";
            }
        }
        return null;
    }

    public function isDate($value)
    {
        $d = DateTime::createFromFormat('Y-m-d', $value);
        return $d && $d->format('Y-m-d') === $value;
    }

    public function isNumeric($value)
    {
        return is_numeric($value);
    }
}
