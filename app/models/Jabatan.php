<?php
require_once __DIR__ . '/BaseModel.php';

class Jabatan extends BaseModel
{
    public function all()
    {
        return $this->fetchAll("SELECT * FROM jabatan ORDER BY nama_jabatan ASC");
    }
}
