<?php

declare(strict_types=1);

namespace App\Http\Annotations;

use OpenApi\Annotations as OA;

/**
 * @OA\Response(
 *     response="200",
 *     description="Request completed successfully",
 *     @OA\JsonContent(ref="#/components/schemas/Body200")
 * )
 *
 * @OA\Response(
 *     response="400",
 *     description="Input data error",
 *      @OA\JsonContent(
 *        required={"success", "message"},
 *        @OA\Property(
 *          property="success",
 *          type="boolean",
 *          description="Successful request",
 *          example="false"
 *        ),
 *        @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Status Description",
 *          example="Input parameters are not as expected"
 *        ),
 *        @OA\Property(
 *          property="errors",
 *          type="array",
 *          description="List errors",
 *          @OA\Items(
 *              type="object",
 *              @OA\Property(
 *                  property="key",
 *                  type="string",
 *                  description="Key",
 *                  example="field"
 *              ),
 *          ),
 *          example={"field" : "Field field must be a number"}
 *        )
 *     )
 * )
 *
 * @OA\Response(
 *     response="403",
 *     description="Access error",
 *      @OA\JsonContent(
 *        required={"success", "message"},
 *        @OA\Property(
 *          property="success",
 *          type="boolean",
 *          description="Successful request",
 *          example="false"
 *        ),
 *        @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Status Description",
 *          example="Access error!"
 *        ),
 *     )
 * )
 *
 * @OA\Response(
 *     response="404",
 *     description="Method not found",
 *      @OA\JsonContent(
 *        required={"success", "message"},
 *        @OA\Property(
 *          property="success",
 *          type="boolean",
 *          description="Successful request",
 *          example="false"
 *        ),
 *        @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Status Description",
 *          example="The called method was not found"
 *        ),
 *     )
 * )
 *
 * @OA\Response(
 *     response="500",
 *     description="Server error",
 *      @OA\JsonContent(
 *        required={"success", "message"},
 *        @OA\Property(
 *          property="success",
 *          type="boolean",
 *          description="Successful request",
 *          example="false"
 *        ),
 *        @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Status Description",
 *          example="An internal error has occurred! Please contact your administrator."
 *        ),
 *     )
 * )
 */

class ResponseAnnotations {}
