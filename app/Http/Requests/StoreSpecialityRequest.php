<?php

namespace App\Http\Requests;

use App\Models\Speciality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecialityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('speciality_create');
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
