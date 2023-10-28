<?php

namespace App\Contracts\Interfaces\Controllers\Api\V1;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

interface PaymentControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/v1/payments",
     *     operationId="getListPayment",
     *     tags={"Payment"},
     *     summary="summary",
     *     description="get list of Payment",
     *
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=201,description="Successful operation"),
     *     @OA\Response(response=202,description="Successful operation"),
     *     @OA\Response(response=204,description="Successful operation"),
     *     @OA\Response(response=400,description="Bad Request"),
     *     @OA\Response(response=401,description="Unauthenticated"),
     *     @OA\Response(response=403,description="Forbidden"),
     *     @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function index();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/v1/payments/{id}",
     *     operationId="showPayment",
     *     tags={"Payment"},
     *     summary="payment",
     *     description="get payment info",
     *      @OA\Parameter(
     *          name="id",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function show(Payment $payment);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/payments",
     *     operationId="storePayment",
     *     tags={"Payment"},
     *     summary="payment",
     *     description="store payment",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"amount","currency_key"},
     *                  @OA\Property(property="amount", type="text"),
     *                  @OA\Property(property="currency_key", type="text"),
     *            ),
     *        ),
     *    ),
     *
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function store(StorePaymentRequest $request);

    public function update(Request $request, Payment $payment);

    public function destroy(Payment $payment);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Patch(
     *     path="/api/v1/payments/{id}/reject",
     *     operationId="rejectPayment",
     *     tags={"Payment"},
     *     summary="payment",
     *     description="reject payment",
     *      @OA\Parameter(
     *          name="id",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function reject(Payment $payment);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Patch(
     *     path="/api/v1/payments/{id}/approved",
     *     operationId="approvedPayment",
     *     tags={"Payment"},
     *     summary="payment",
     *     description="approved payment",
     *      @OA\Parameter(
     *          name="id",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function approve(Payment $payment);
}
