<?php

namespace App\Imports;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class excelEmail implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function rules(): array
    {
        // return [
        //     'name'             => 'required|max:35',
        //     'email'            => 'required|email|unique:users,email',
        //     'password'         => 'required',
        //     'phone'            => 'required',
        //     // 'phone'            => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'gender'           => 'required',
        //     'address'          => 'required',

        //     'home_address'           => 'required',
        //     'parent_first_name'           => 'required',
        //     'parent_last_name'           => 'required',
        //     'parent_email'           => 'required|email|unique:students,parent_email',

        // ];

    }

    public function customValidationMessages()
    {
        return [




        ];
    }

    public function model(array $row)
    {

        return new CodesData([

        ]);
    }
    public function onError(Throwable $error)
    {

    }

}
