<?php

namespace App\Contracts\Interfaces\Controllers\Api\V1;

use App\Http\Requests\DepositTransferRequest;

interface DepositControllerInterface
{
    /**
     * transfer deposit.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/deposit/transfer",
     *     operationId="depositTransfer",
     *     tags={"Deposit"},
     *     summary="deposit",
     *     description="transfer deposit",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"base_user_id","target_user_id","currency_key","amount"},
     *                  @OA\Property(property="base_user_id", type="text"),
     *                  @OA\Property(property="target_user_id", type="text"),
     *                  @OA\Property(property="currency_key", type="text"),
     *                  @OA\Property(property="amount", type="text"),
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
    public function transfer(DepositTransferRequest $request);
}
