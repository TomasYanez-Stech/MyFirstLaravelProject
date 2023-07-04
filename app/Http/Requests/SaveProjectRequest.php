<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /* $this === $request */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /* return [
            "title" => "required",
            "slug" => ["required", "unique:project,slug"],
            "description" => "required"
        ]; */
        
        return [
            "title" => "required",
            "slug" => [
                "required",
                Rule::unique("project")->ignore( $this->route("project") )
            ],
            "description" => "required",
            "image" => [
                "required",
                "mimes:jpeg,jpg,png,svg", // image = jpeg, png, bmp, gif, svg, webp
                // "dimensions:width=600,height=400"
                // "dimensions:min_width=400,min_height=200"
                // "dimensions:ratio=16/9"
                // "size:2000" // kb
                // "max:2000" // kb
            ]
        ];
    }

    public function messages() {
        return [
            "title.required" => __("The project needs a title")
        ];
    }
}
