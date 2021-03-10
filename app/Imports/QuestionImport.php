<?php

namespace App\Imports;

use App\Models\Questions;

use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            return new Questions([
                'type'                  => $row[0],
                'title'                 => $row[1],
                'question'              => $row[2],
                'choise1'               => $row[3],
                'choise2'               => $row[4],
                'choise3'               => $row[5],
                'choise4'               => $row[6],
                'answer'                => $row[7],
                'assignment_id'         => $row[8],
                'quize_id'              => $row[9],
                'mark'                  => $row[10],
                'time'                  => $row[11],
                'doctor_id'             => $row[12],
                'course_id'             => $row[13],
            ]);

    }
}
