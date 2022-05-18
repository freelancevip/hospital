<?php

namespace App\Http\Requests;

use App\Models\Record;
use App\Rules\Overlapping;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('record_create');
    }

    public function rules()
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
            ],
            'datetime' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                new Overlapping
            ],
        ];
    }
}
