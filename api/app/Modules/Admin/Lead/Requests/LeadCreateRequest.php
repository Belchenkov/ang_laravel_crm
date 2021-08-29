<?php

namespace App\Modules\Admin\Lead\Requests;

use App\Services\Requests\ApiRequest;

/**
 * Class LeadCreateRequest
 * @package App\Modules\Admin\Lead\Requests
 * @property string $text
 */
class LeadCreateRequest extends ApiRequest
{
    /**
     * @var mixed
     */

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
            'link' => 'required_without:phone',
            'phone' => 'required_without:link',
            'source_id' => 'required',
            'unit_id' => 'required',
            'is_processed' => 'required'
        ];
    }
}
