<?php

namespace App\Contracts\Interfaces\Controllers\Api\V1;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

interface AuthControllerInterface
{
    /**
     * login.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/login",
     *     operationId="login",
     *     tags={"Auth"},
     *     summary="login",
     *     description="login",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"email","password"},
     *                  @OA\Property(property="email", type="text"),
     *                  @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *
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
    public function login(LoginUserRequest $request);

    /**
     * register.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/register",
     *     operationId="register",
     *     tags={"Auth"},
     *     summary="register",
     *     description="register",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"email","password"},
     *                  @OA\Property(property="email", type="text"),
     *                  @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *
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
    public function register(RegisterUserRequest $request);

    /**
     * refresh.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/v1/refresh",
     *     operationId="refresh",
     *     tags={"Auth"},
     *     summary="refresh",
     *     description="refresh",
     *
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
    public function refresh();

    /**
     * get-me.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/v1/get-me",
     *     operationId="get-me",
     *     tags={"Auth"},
     *     summary="get-me",
     *     description="get-me",
     *
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
    public function getMe();

    /**
     * logout.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/logout",
     *     operationId="logout",
     *     tags={"Auth"},
     *     summary="logout",
     *     description="logout",
     *
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
    public function logout();
}
