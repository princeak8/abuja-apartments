<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required|string|min:3',
        ];
        if($this->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,jpg,gif,bmp,png|max:10000';
        }

        return $rules;
    }
}
