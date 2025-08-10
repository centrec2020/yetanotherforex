<?php
// *** Code for Additional Request: Add new rate upon form submission ***

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'base_code'     => strtoupper((string) $this->input('base_code')),
            'target_code'   => strtoupper((string) $this->input('target_code'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'base_code'     => ['required', 'string', 'size:3', 'regex:/^[A-Z]{3}$/'],
            'target_code'   => ['required', 'string', 'size:3', 'regex:/^[A-Z]{3}$/', 'different:base_code'],
            'rate'          => ['required', 'numeric', 'min:0'],
            'effective_date'=> ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'base_code.regex'   => 'Base currency must be a 3-letter ISO code.',
            'target_code.regex' => 'Target currency must be a 3-letter ISO code.'
        ];
    }
}
