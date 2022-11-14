<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.order.edit', $this->order);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'section_id' => ['sometimes', 'integer'],
            'category_id' => ['sometimes', 'integer'],
            'short_description' => ['sometimes', 'string'],
            'full_description' => ['sometimes', 'string'],
            'execution_date' => ['sometimes', 'date'],
            'start_execution_time' => ['nullable', 'date'],
            'end_execution_time' => ['nullable', 'date'],
            'price' => ['sometimes', 'numeric'],
            'by_user' => ['sometimes', 'integer'],
            'price_negotiable' => ['sometimes', 'boolean'],
            'city' => ['sometimes']
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
