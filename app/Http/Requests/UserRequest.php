<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
    public function rules(){
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if(request()->routeIs('user.store')){
            $rules['username'] = 'required|unique:users,username|max:20|alpha_dash';
            $rules['email'] = 'required|email|unique:users,email|max:255';
            $rules['role'] = 'required|boolean';
            $rules['password'] = 'required|min:5|confirmed';
        }

        if(request()->is('profil')){
            $rules['username'] = [
                'required',
                'max:20',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore(auth()->user()->id)
            ];
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->user()->id)
            ];
        }
        return $rules;
    }
    public function attributes(){
        return [
            'name' => 'Nama',
        ];
    }
}
