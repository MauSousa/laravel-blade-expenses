<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->expense);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:255', 'in:cash,credit,debit'],
            'store_id' => ['required', 'exists:stores,id'],
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
