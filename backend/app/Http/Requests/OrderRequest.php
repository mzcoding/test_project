<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TermRent;
use App\Enums\TypeProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *      request="OrderRequest",
 *       @OA\JsonContent(
 *          type="object",
 *          required={"productId", "term_rent"},
 *          @OA\Property( property="product_id", type="int", description="product id ", example="5"),
 *          @OA\Property( property="type", type="enum",
 *            @allowableValues(
 *              valueType="LIST",
 *              values="['buy', 'rent']"
 *            ),
 *             description="product id ", example="5"),
 *          @OA\Property( property="term_rent", type="int", description="rental period", example="8"),
 *       )
 * )
 */
class OrderRequest extends FormRequest
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
            'product_id' => ['required', 'integer'],
            'type' => ['required', 'string',
                Rule::in([TypeProduct::BUY->value, TypeProduct::RENT->value])],
            'term_rent' => ['nullable', 'int', Rule::in([
                TermRent::FOUR_HOURS->value,
                TermRent::EIGHT_HOURS->value,
                TermRent::TWELVE_HOURS->value,
                TermRent::TWENTY_FOUR_HOURS->value,
            ])],
        ];
    }

    public function getProduct(): int
    {
        return $this->validated('product_id');
    }

    public function getType(): string
    {
        return $this->validated('type');
    }

    public function getTermRent(): ?int
    {
        if (!isset($this->validated()['term_rent'])) {
            return null;
        }

        return $this->validated('term_rent');
    }
}
