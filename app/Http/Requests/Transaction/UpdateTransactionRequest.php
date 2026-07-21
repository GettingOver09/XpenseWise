<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'integer', 'exists:accounts,id'],

            'category_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],

            'transfer_group_id' => [
                'nullable',
                'uuid',
            ],

            'amount' => [
                'required',
                'numeric',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'payee' => [
                'nullable',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                'in:income,expense,transfer',
            ],

            'status' => [
                'nullable',
                'in:to review,reviewed',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'transaction_date' => [
                'required',
                'date',
            ],
        ];
    }
}
