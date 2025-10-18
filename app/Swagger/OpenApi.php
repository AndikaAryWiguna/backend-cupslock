<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Cupslock API Documentation",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk sistem Cupslock, meliputi autentikasi dan fitur utama aplikasi.",
 *     @OA\Contact(
 *         email="developer@cupslock.test",
 *         name="Cupslock Dev Team"
 *     )
 * ),
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local Development Server"
 * )
 */
class OpenApi
{
    // Kosong, hanya untuk menyimpan anotasi global Swagger
}
