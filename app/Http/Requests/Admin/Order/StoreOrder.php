<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.order.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'section_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'short_description' => ['required', 'string'],
            'full_description' => ['required', 'string'],
            'execution_date' => ['required', 'date'],
            'start_execution_time' => ['nullable', 'date'],
            'end_execution_time' => ['nullable', 'date'],
            'price' => ['required', 'numeric'],
            'by_user' => ['required', 'integer'],
            'price_negotiable' => ['required', 'boolean'],
            
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
