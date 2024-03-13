<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiHandler
{
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'error'=>$validator->errors()
        ], 422));

    }
}
