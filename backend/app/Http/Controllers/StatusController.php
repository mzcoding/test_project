<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRentRequest;
use App\Http\Resources\StatusResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Services\Contracts\OrderCode;
use App\Services\Contracts\Rent;
use OpenApi\Annotations as OA;

final class StatusController extends Controller
{
   protected OrderCode $orderCode;
   protected Rent $rent;

   public function __construct(OrderCode $orderCode, Rent $rent)
   {
       $this->orderCode = $orderCode;
       $this->rent = $rent;
   }

    /**
     * @OA\GET (
     *     path="/api/v1/status/check/{hashCode}",
     *     summary="Check status order by code",
     *     tags={"Orders"},
     *     description="Check status order by code",
     *     @OA\Response(
     *       response="200", description="Success result",
     *       @OA\JsonContent(
     *         allOf={
     *          @OA\Schema( ref="#/components/schemas/Body200" )
     *         }
     *       )
     *     ),
     *     @OA\Response(
     *        response="404", description="Resource not found"
     *      ),
     * )
     *
     * @param string $hashCode
     * @return StatusResource
     * @throws \Exception
     */
    public function checkStatus(string $hashCode): StatusResource
    {
        $status = $this->orderCode->getOrderByCode($hashCode);

        if ($status === null) {
            throw new \Exception(__('Status not found'), 404);
        }

        return new StatusResource($status);
    }

    /**
     * @OA\PUT (
     *     path="/status/rent/{order}/update",
     *     summary="Update rent",
     *     tags={"Orders"},
     *     description="Update rent",
     *     @OA\Response(
     *       response="200", description="Success result",
     *       @OA\JsonContent(
     *         allOf={
     *          @OA\Schema( ref="#/components/schemas/Body200" )
     *         }
     *       )
     *     ),
     *     @OA\Response(
     *        response="404", description="Resource not found"
     *      ),
     * )
     *
     * @param UpdateRentRequest $request
     * @param Order $order
     * @return StatusResource
     * @throws \Exception
     */
    public function updateRent(UpdateRentRequest $request, Order $order): StatusResource
    {
        if ($order->orderStatus->is_rent === true) {
             $status = $this->rent->updateRent($order, $request->getTermRent());

             return new StatusResource($status);
        }

        throw new \Exception(__('This product can not for rent'), 400);
    }
}
