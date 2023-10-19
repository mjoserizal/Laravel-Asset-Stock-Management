<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreTransactionDisposableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'disposable_id' => [
                'required',
                'integer'],
            'user_id' => [
                'required',
                'integer'],
            'stock' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
