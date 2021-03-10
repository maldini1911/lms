<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'        => $row[0],
            'email'       => $row[1],
            'password'    => bcrypt($row[2]),
            'mobile'      => $row[3],
            'faculty_id'  => $row[4],
        ]);
    }
}
