<?php


namespace App\Services\Requests;


use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            ResponseService::sendJsonResponse(
                false,
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                $errors
            )
        );
    }
}
