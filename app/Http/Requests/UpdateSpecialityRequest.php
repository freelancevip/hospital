<?php

namespace App\Http\Requests;

use App\Models\Speciality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecialityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('speciality_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
