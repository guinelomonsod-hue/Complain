<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return auth('api')->check();
    }
     
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priority,id',
            'subject' => 'required|string|255',
            'description' => 'required|string',
            'location' => 'requires|string|255',
        ];
    }
}
