<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class PresentationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: Change this value after adding roles
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'professor_name' => 'required',
            'course_id' => 'required',
            'title' => 'required',
            'type' => 'required',
        ];

        $user = Auth::user();
        if ($user->is_professor()){
            unset($rules['professor_name']);
        }

        return $rules;
    }
}
