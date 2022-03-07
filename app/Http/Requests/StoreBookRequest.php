<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
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

    // protected function prepareForValidation()
    // {
    //     Log::alert($this->authors);
    //     $authors = json_decode($this->authors, true);
    //     Log::debug($authors);
    //     return $this->merge([
    //         'authors' => $authors,
    //     ]);
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'isbn' => [
                'required',
                Rule::unique('book')->ignore($this->id)
            ],
            'authors' => 'required | array',
            "authors.*" => 'required | string',
            'country' => 'required | string',
            'number_of_pages' => 'required | integer',
            'publisher' => 'required |string',
            'release_date' => 'required | date',
        ];
    }
}
