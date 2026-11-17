<?php
require_once __DIR__ . '/../traits/EscapeTrait.php';

/**
 * Base model: helper query memakai mysql_*.
 */
class BaseModel
{
    use EscapeTrait;

    public function fetchAll($sql)
    {
        $result = mysql_query($sql);
        if (!$result) die('Query gagal: ' . mysql_error());
        $rows = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function fetchOne($sql)
    {
        $result = mysql_query($sql);
        if (!$result) die('Query gagal: ' . mysql_error());
        return mysql_fetch_array($result, MYSQL_ASSOC);
    }

    public function run($sql)
    {
        $result = mysql_query($sql);
        if (!$result) die('Query gagal: ' . mysql_error());
        return $result;
    }

    public function insertId()
    {
        return mysql_insert_id();
    }
}
