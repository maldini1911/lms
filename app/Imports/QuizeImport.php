<?php

namespace App\Imports;

use App\Models\Quize;
use App\Models\QuestionChoice;
use App\Models\TrueFalse;
use App\Models\TextQuestion;
use Maatwebsite\Excel\Concerns\ToModel;

class QuizeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] == "choise")
        {
            return new QuestionChoice([
                'title'                 => $row[1],
                'question'              => $row[2],
                'first_choice'          => $row[3],
                'second_choice'         => $row[4],
                'third_choice'          => $row[5],
                'fourth_choice'         => $row[6],
                'answer'                => $row[7],
                'subject_id'            => $row[8],
                'member_id'             => $row[9],
                'position'              => $row[10],
                'mark'                  => $row[11],
                'code_assignment'       => $row[12],
                'code_quize'            => $row[13],
                'time'                  => $row[14]
            ]);
        }

        if($row[0] == "true_false")
        {
            return new TrueFalse([
                'title'                 => $row[1],
                'question'              => $row[2],
                'true'                  => $row[3],
                'false'                 => $row[4],
                'answer'                => $row[5],
                'subject_id'            => $row[6],
                'member_id'             => $row[7],
                'position'              => $row[8],
                'mark'                  => $row[9],
                'code_assignment'       => $row[10],
                'code_quize'            => $row[11],
                'time'                  => $row[12]
            ]);
        }

        if($row[0] == "text")
        {
            return new TextQuestion([
                'title'                 => $row[1],
                'question'              => $row[2],
                'answer'                => $row[3],
                'subject_id'            => $row[4],
                'member_id'             => $row[5],
                'position'              => $row[6],
                'mark'                  => $row[7],
                'code_assignment'       => $row[8],
                'code_quize'            => $row[9],
                'time'                  => $row[10]
            ]);
        }
    }
}
