<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
        if(is_array($this->file('photo'))) {
            $photos = count($this->input('photo'));
            foreach(range(0, $photos) as $index){
                $rules['photo.'.$index] = 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:10000';
            }
        }else{
            if($this->hasFile('photo')) {
                $rules['photo'] = 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:10000';
            }
        }
        return $rules;
    }
}
