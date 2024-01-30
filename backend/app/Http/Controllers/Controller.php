<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API Documentation (Product service)",
 *     version="1.0.0",
 *     description="This is the way.",
 *
 *     @OA\Contact(
 *         name="Stanislav Boyko",
 *         email="mzcoding@gmail.com"
 *     ),
 * )
 *
 * @OA\Server(
 *     description="Dev server",
 *     url="http://localhost:8000/"
 * )
 * @OA\Server(
 *     description="Stage server",
 *     url=" http://localhost:8000/"
 * )
 * @OA\Server(
 *     description="Production server",
 *     url=""
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
