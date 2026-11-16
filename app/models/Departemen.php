<?php
require_once __DIR__ . '/BaseModel.php';

class Departemen extends BaseModel
{
    public function all()
    {
        return $this->fetchAll("SELECT * FROM departemen ORDER BY nama_departemen ASC");
    }
}
