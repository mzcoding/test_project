<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UsersCollection;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

final class UserController extends Controller
{
    /**
     * @OA\GET (
     *     path="/api/v1/users",
     *     summary="Get a list of users ",
     *     tags={"Users"},
     *     description="Get all users",
     *     @OA\Response(
     *       response="200", description="Success result",
     *       @OA\JsonContent(
     *         allOf={
     *          @OA\Schema( ref="#/components/schemas/Body200" )
     *         }
     *       )
     *     )
     * )
     *
     * @param Request $request
     * @return UsersCollection
     *
     */
    public function __invoke(Request $request): UsersCollection
    {
        return new UsersCollection(User::all());
    }
}
