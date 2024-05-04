<?php

namespace App\Helper\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * @param object $object
     * @param object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseDefault(object $object = new \stdClass(), object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $response = [];
        $response['message'] = $message;
        $response['errors'] = $errors;
        $response['object'] = $object;

        $statusCode = array_key_exists($statusCode, Response::$statusTexts) ? $statusCode : Response::HTTP_UNPROCESSABLE_ENTITY;
        return response()->json($response, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseSuccess(array|object $object=[], array|object $errors = [], string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        if (is_array($object)) {
            $allData = new \stdClass();
            foreach ($object as $key => $value) {
                $allData->$key = $value;
            }

            $object = $allData;
        }

        $errors = new \stdClass();

        $statusCode = array_key_exists($statusCode, Response::$statusTexts) ? $statusCode : Response::HTTP_UNPROCESSABLE_ENTITY;

        return self::responseDefault($object, $errors, $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseError(array|object $object = [], array|object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        if (empty($message) || (is_string($message) && !filled($message))) {
            $message = trans("custom.defaults.failed");
        }

        if (is_array($errors)) {
            $allErrors = new \stdClass();
            foreach ($errors as $key => $value) {
                $allErrors->$key = $value;
            }

            $errors = $allErrors;
        }

        $object = new \stdClass();

        $statusCode = array_key_exists($statusCode, Response::$statusTexts) ? $statusCode : Response::HTTP_UNPROCESSABLE_ENTITY;

        return self::responseDefault($object, $errors, $message, $statusCode);

    }

    /**
     * @param string $errorMessage
     * @return JsonResponse
     */
    public static function responseCustomError(string $errorMessage = ""): JsonResponse
    {
        $errors = [
            "message" => [$errorMessage]
        ];

        return self::responseError([], $errors);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseUnAuthorizedErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        if (empty($errors)) {
            $errors = ["message" => [___("exceptions.exceptionErrors.unauthenticated")]];
        }
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseAccessDeniedErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_FORBIDDEN): JsonResponse
    {
        if (empty($errors)) {
            $errors = ["message" => [___("exceptions.exceptionErrors.accessDenied")]];
        }
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseNotFoundErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_NOT_FOUND): JsonResponse
    {
        if (empty($errors)) {
            $errors = ["message" => [___("exceptions.exceptionErrors.notFound")]];
        }
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseCustomErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_METHOD_NOT_ALLOWED): JsonResponse
    {
        if (empty($errors)) {
            $errors = ["message" => [$message]];
        }
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseValidationErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object|null $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseServerErrorException(array|object $object = [], array|object $errors = null, string $message = "", int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        if (empty($message) || (is_string($message) && !filled($message))) {
            $message = ___("exceptions.exceptionErrors.internalServerError");
        }
        if (empty($errors)) {
            $errors = ["message" => [___("exceptions.exceptionErrors.internalServerError")]];
        }
        return self::responseError($object, $errors !== null ? $errors : new \stdClass(), $message, $statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseSuccessDelete(array|object $object=[], array|object $errors = [], string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.delete_success");
        return self::responseSuccess(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseFailedDelete(array|object $object = [], array|object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.delete_failed");
        return self::responseError(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseSuccessUpdate(array|object $object=[], array|object $errors = [], string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.update_success");
        return self::responseSuccess(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseFailedUpdate(array|object $object = [], array|object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.update_failed");
        return self::responseError(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseSuccessShow(array|object $object=[], array|object $errors = [], string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.show_success");
        return self::responseSuccess(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseFailedShow(array|object $object = [], array|object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.show_failed");
        return self::responseError(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseSuccessStore(array|object $object=[], array|object $errors = [], string $message = "", int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.store_success");
        return self::responseSuccess(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }

    /**
     * @param array|object $object
     * @param array|object $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function responseFailedStore(array|object $object = [], array|object $errors = new \stdClass(), string $message = "", int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $message= filled($message) ? $message : trans_("custom.defaults.store_failed");
        return self::responseError(object:$object,errors:$errors,message:$message,statusCode:$statusCode);
    }
}
