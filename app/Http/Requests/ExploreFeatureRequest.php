<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExploreFeatureRequest extends FormRequest
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
        return [
            'title' => 'required',
            'deskripsi' => 'required|min:15',
            'card_title' => 'required',
            'card_deskripsi' => 'required|min:15',
            'button' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
