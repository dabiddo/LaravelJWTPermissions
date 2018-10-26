<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\HttpException;


abstract class Request extends FormRequest
{
    public function forbiddenResponse(){
        return new Response(['message' => 'Not Authorized'], 403);
    }

    public function failedAuthorization(){
        throw new HttpException(400, 'Not Authorized', null, [], 400);
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpException(400, $validator->errors()->first(), null, [], 777);
    }
}
