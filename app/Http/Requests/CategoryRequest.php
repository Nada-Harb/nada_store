<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('category', 0);
        return [
            
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:categories,slug, $id',
                'parent_id' => 'nullable|int|exists:categories,id',
                'image' => [
                    'nullable',
                    'image',
                    'max:200',
                    
                    Rule::dimensions()->minHeight(300)->maxHeight(1200)->minWidth(300)->maxWidth(1200),
                    ]
                
            
        ];
    }

    public function messages()
    {
        return[
            'required' => ':attribute is required!!',
            'slug.required' => 'You must enter a URL slug',
        ];
    }
}
