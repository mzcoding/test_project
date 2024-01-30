<?php

declare(strict_types=1);

namespace App\Http\Annotations;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Body200", type="object",
 *     @OA\Property( property="success", type="boolean", description="Successful request", example="true" ),
 *     @OA\Property( property="message", type="string", description="Status Description", example="Request completed successfully" )
 * )
 *
 * @OA\Schema(
 *     schema="Pagination", type="object",
 *     @OA\Property( property="links", type="object", description="Pagination links",
 *          @OA\Property( property="first", example="https://current.resource?page=1"),
 *          @OA\Property( property="last", example="https://current.resource?page=8"),
 *          @OA\Property( property="prev", example="null"),
 *          @OA\Property( property="next", example="https://current.resource?page=2"),
 *     ),
 *     @OA\Property( property="meta", type="object", description="Pagination meta data",
 *          @OA\Property( property="currentPage", example="1"),
 *          @OA\Property( property="from", example="1"),
 *          @OA\Property( property="lastPage", example="8"),
 *          @OA\Property( property="next", example="Ingo"),
 *          @OA\Property( property="links", type="object", description="Pagination links",
 *               @OA\Property( type="array", description="Pagination links", @OA\Items())
 *          ),
 *          @OA\Property( property="path", example="https://current.resource"),
 *          @OA\Property( property="perPage", example="10"),
 *          @OA\Property( property="to", example="10"),
 *          @OA\Property( property="total", example="77"),
 *     )
 * )
 */

class SchemaAnnotations {}
