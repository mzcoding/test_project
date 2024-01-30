<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginResource",
 *     required={"message","token"},
 *     type="object",
 *     @OA\Property( property="message", type="string", description="Message about status operation", example="Loggin succesfuly" ),
 *     @OA\Property( property="token", type="string", description="authorization token", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c" )
 *     )
 */

/**
 * @property $message
 * @property $token
 */
class RegisterResource extends JsonResponse
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'token' => $this->token,
        ];
    }
}
