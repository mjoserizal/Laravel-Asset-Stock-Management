<?php

namespace App\Http\Requests;

use App\Asset;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAlatRequest extends FormRequest
{
    public function authorize()
    {

    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];

    }
}
