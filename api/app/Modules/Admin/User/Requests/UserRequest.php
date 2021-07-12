<?php

namespace App\Modules\Admin\User\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo(['view', 'create']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', ['required', 'confirmed'], function ($input) {
            if (
                ! empty($input->password) ||
                (empty($input->password) && ($this->route()->getName() !== 'api.users.update'))
            ) {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
