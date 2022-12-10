<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PunkApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            //
            'page' => 'integer'
            ,'per_page' => 'integer'
        ];
    }
}
