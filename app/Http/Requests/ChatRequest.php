<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChatRequest extends FormRequest
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
        return [       
            'service_id' => [
                'required',
                Rule::exists( 'services', 'id' )->where( function ( $query ) {
                    return $query->where('user_id', '!=', auth()->user()->id );
                } ),     
            ]   
        ];
    }
}
