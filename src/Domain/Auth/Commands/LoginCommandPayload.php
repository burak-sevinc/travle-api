<?php

declare(strict_types=1);

namespace Crackcode\Domain\Auth\Commands;

use Crackcode\Shared\Utils\AuthConfig;
use Crackcode\Shared\Utils\JsonResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginCommandPayload extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $authConfig = AuthConfig::make();

        $emailMin    = $authConfig->getEmailMin();
        $emailMax    = $authConfig->getEmailMax();
        $passwordMin = $authConfig->getPasswordMin();
        $passwordMax = $authConfig->getPasswordMax();

        return [
            'email' => ['required', 'string', 'email', 'min:' . $emailMin, 'max:' . $emailMax],
            'password' => ['required', 'string', 'min:' . $passwordMin, 'max:' . $passwordMax],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        $response = JsonResponse::unprocessableEntity(
            [
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()->toArray(),
            ],
            'Validation failed',
        );

        throw new ValidationException($validator, $response);
    }
}
