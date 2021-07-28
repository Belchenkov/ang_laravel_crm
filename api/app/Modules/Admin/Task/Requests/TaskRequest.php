<?php

namespace App\Modules\Admin\Task\Requests;

use App\Services\Requests\ApiRequest;

class TaskRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'text'=>'string|required',
            'responsible_id'=>'required',
        ];
    }
}
