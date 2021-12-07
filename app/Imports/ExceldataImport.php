<?php

namespace App\Imports;

use App\Models\Exceldata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ExceldataImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Exceldata([
        //     'id' => $row['id'],
        //     'name'=> $row['name']
        // ]);
    }
}
