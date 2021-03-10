<?php

namespace App\Imports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\ToModel;

class DoctorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Doctor([
            'name'     => $row[0],
            'email'    => $row[1],
            'password' => bcrypt($row[2]),
            'mobile'   => $row[3],
        ]);
    }
}
