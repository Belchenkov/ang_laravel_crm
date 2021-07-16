<?php

namespace App\Modules\Admin\LeadComment\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeadCommentRequest
 * @package App\Modules\Admin\LeadComment\Requests
 * @property int lead_id
 * @property int status_id
 * @property string|null text
 * @property int user_id
 */
class LeadCommentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'lead_id' => 'required|integer',
            'status_id' => 'required|integer',
            'text' => 'string|nullable'
        ];
    }
}
