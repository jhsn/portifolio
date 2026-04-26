<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'company' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:120'],
            'work_model' => ['required', 'string', 'in:Remoto,Hibrido,Presencial'],
            'contract_type' => ['required', 'string', 'in:CLT,PJ,Estagio,Freelance'],
            'salary_range' => ['nullable', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}