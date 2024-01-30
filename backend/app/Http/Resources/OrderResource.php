<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="OrderResource", type="object",
 *     @OA\Property(
 *       property="id",
 *       type="int",
 *       description="Order id",
 *       title="Order id"
 *     ),
 *     @OA\Property(
 *       property="status",
 *       type="string",
 *       description="Order status",
 *       title="Order status"
 *     ),
 *     @OA\Property(
 *       property="code",
 *       type="string",
 *       description="Hash code",
 *       title="Hash code",
 *       example="f7cc10d4a09f988835b94825049ca5aa"
 *      ),
 *     @OA\Property(
 *        property="is_rent",
 *        type="boolean",
 *        description="Rent or not",
 *        title="Rent or not",
 *        example="true"
 *       ),
 *     @OA\Property(
 *         property="term_rent",
 *         type="int",
 *         description="Term rent in hours",
 *         title="Term rent in hours",
 *         example="8"
 *        ),
 *     @OA\Property(
 *          property="term_rent_at",
 *          type="datetime",
 *          description="Rent date",
 *          title="Rent date",
 *          example="2024-01-31 20:09:24"
 *         ),
 *     @OA\Property(
 *           property="created_at",
 *           type="datetime",
 *           description="Created date",
 *           title="Created date",
 *           example="2024-01-31 20:09:24"
 *          ),
 * )
 */

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'code' => $this->orderStatus->hash_code,
            'is_rent' => $this->orderStatus->is_rent,
            'term_rent' => $this->orderStatus->term_rent,
            'term_rent_at' => $this->orderStatus->term_rent_at,
            'created_at' => $this->created_at,
        ];
    }
}
