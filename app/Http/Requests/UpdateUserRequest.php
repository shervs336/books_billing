<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UpdateUserRequest extends FormRequest
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
        return
                  ['firstname' => 'required|string|max:255',
                  'middlename' => 'string|nullable|max:255',
                  'lastname' => 'required|string|max:255',
                  'username' => 'required|string|max:255|unique:users,username,1',
                  'email' => 'required|string|email|max:255|unique:users',
                  'password' => 'string|min:6|nullable|confirmed',
                  'password_confirmation' => 'required_with:password|string|nullable|min:6'];
    }
}
