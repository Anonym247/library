<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponder
{
    /**
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function response(string $message, mixed $data = [], int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        $body['message'] = $message;

        if ((is_array($data) && count($data) > 0) || $data) {
            $body['content'] = $data;
        }

        return response()->json($body, $code);
    }
}
