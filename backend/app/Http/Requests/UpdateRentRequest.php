<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TermRent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *      request="UpdateRentRequest",
 *       @OA\JsonContent(
 *          type="object",
 *          required={"term_rent"},
 *          @OA\Property( property="term_rent", type="int", description="rental period", example="5"),
 *       )
 * )
 */
class UpdateRentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'term_rent' => ['required', 'int', Rule::in([
                TermRent::FOUR_HOURS->value,
                TermRent::EIGHT_HOURS->value,
                TermRent::TWELVE_HOURS->value,
                TermRent::TWENTY_FOUR_HOURS->value,
            ])],
        ];
    }

    public function getTermRent(): int
    {
        return (int) $this->validated('term_rent');
    }
}
