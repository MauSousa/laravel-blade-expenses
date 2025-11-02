<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'store_id' => ['required', 'exists:stores,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:255', 'in:cash,check,credit,debit'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'store_id.required' => 'The store is required.',
            'store_id.exists' => 'The store does not exist.',
            'payment_method.in' => 'The payment method must be one of cash, check, credit, or debit.',
        ];
    }

    /**
     * Checks if the request store belongs to the user.
     *
     * @return array<int, Closure>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $store = request()->user()->stores()->find($this->store_id);
                if (! $store) {
                    $validator->errors()->add(
                        'store_id',
                        'The store does not exist.'
                    );
                }
            },
        ];
    }
}
