<?php

namespace App\Imports;

use App\Models\Exceldata;

class ExceldataFinal extends ExceldataImport
{

    protected $data;


    public function __construct($data)
    {
        $this->data =$data;
    }
    public function model(array $row)
    {
        return new Exceldata(
            [
                $this->data['id'] => $row['id'],
                $this->data['name']=> $row['name']
            ]
        );
    }



}

