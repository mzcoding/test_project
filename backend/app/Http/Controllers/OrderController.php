<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Statuses;
use App\Enums\TypeProduct;
use App\Events\OrderEvent;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersCollection;
use App\Models\Order;
use Carbon\CarbonImmutable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

final class OrderController extends Controller
{
    /**
     * @OA\GET (
     *     path="/api/v1/orders",
     *     summary="List all orders ",
     *     tags={"Orders"},
     *     description="Get all orders",
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
     * @return OrdersCollection
     */
    public function index(): OrdersCollection
    {
        return new OrdersCollection(Order::all());
    }

    /**
     * @OA\POST (
     *     path="/api/v1/orders",
     *     summary="Create new order ",
     *     tags={"Orders"},
     *     description="Create new order",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *       request="OrderRequest",
     *       @OA\JsonContent(
     *           type="object",
     *           required={"productId", "term_rent"},
     *           @OA\Property( property="product_id", type="int", description="product id ", example="5"),
     *           @OA\Property( property="type", type="string", description="product id ", example="8"),
     *           @OA\Property( property="term_rent", type="int", description="rental period", example="8"),
     *       )
     *     ),
     *     @OA\Response(
     *       response="200", description="Success result",
     *       @OA\JsonContent(
     *         allOf={
     *          @OA\Schema( ref="#/components/schemas/OrderResource" )
     *         }
     *       )
     *     )
     * )
     *
     * @param OrderRequest $request
     * @return OrderResource
     * @throws Exception
     */
    public function store(OrderRequest $request): OrderResource
    {
        $authUser = Auth::user();
        if ($authUser === null) {
            throw new Exception(__('We could not find user'), 404);
        }

        $status = Statuses::CREATED->value;
        $isRent = false;
        $termRent = $termRentAt =  null;

        if ($request->getType() === TypeProduct::RENT->value) {
            $status = Statuses::COMPLETED->value;
            $isRent = true;

            $termRent = $request->getTermRent();
            $termRentAt = CarbonImmutable::now()->addHours($request->getTermRent());
        }

        $order = $authUser->orders()->create([
            'product_id' => $request->getProduct(),
            'status' => $status,
        ]);

        // fair event about new order
        event(new OrderEvent($order, [
            'is_rent' => $isRent,
            'term_rent' => $termRent,
            'term_rent_at' => $termRentAt
        ]));

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * Todo: In Active method
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order): OrderResource
    {
        throw new Exception('');
    }

    /**
     * @OA\Delete (
     *     path="/api/v1/orders",
     *     summary="Delete order ",
     *     tags={"Orders"},
     *     description="Delete order",
     *     @OA\Response(
     *       response="200", description="Success result",
     *       @OA\JsonContent(
     *         allOf={
     *          @OA\Schema( ref="#/components/schemas/Body200" )
     *         }
     *       )
     *     ),
     *     @OA\Response(
     *        response="500", description="Server error"
     *      ),
     * )
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        try {
            $order->orderStatus()->delete();
            $order->delete();

            return response()->json('success');
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
