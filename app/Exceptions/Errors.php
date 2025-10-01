<?php

namespace App\Exceptions;

// use App\Exceptions\ApiException;

class Errors
{
    public static function InternalServerError($systemMessage = 'Internal Server Error', $message = 'Internal Server Error')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'INTERNAL_SERVER_ERROR', statusCode: 500, systemMessage: $systemMessage);
    }

    public static function ResourceNotFound($systemMessage = 'Resource Not Found', $message = 'Resource Not Found')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'RESOURCE_NOT_FOUND', statusCode: 404, systemMessage: $systemMessage);
    }

    public static function ResourceAlreadyExists($systemMessage = 'Resource Already Exists', $message = 'Resource Already Exists')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'RESOURCE_ALREADY_EXISTS', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function UnAcceptableOperation($systemMessage = 'Unacceptable Operation', $message = 'Unacceptable Operation')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'UNACCEPTABLE_OPERATION', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function NotAuthenticated($systemMessage = 'Not Authenticated', $message = 'Not Authenticated')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'NOT_AUTHENTICATED', statusCode: 403, systemMessage: $systemMessage);
    }

    public static function NotVerified($systemMessage = 'User is not verified', $message = 'User is not verified')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'NOT_VERIFIED', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function InvalidResetToken($systemMessage = 'The token used to reset is invalid', $message = 'The token used to reset is invalid')
    {
        throw new ApiException(systemMessage: $systemMessage, error: 'INVALID_RESET_TOKEN', statusCode: 400, message: __('errors.' . $message));
    }

    public static function InvalidData($systemMessage = 'Given Data is Invalid', $message = 'Given Data is Invalid')
    {
        throw new ApiException(systemMessage: $systemMessage, error: 'INVALID_DATA', statusCode: 400, message: __('errors.' . $message));
    }

    public static function MissingData($systemMessage = 'There\'s missing Data', $message = 'There\'s missing Data')
    {
        throw new ApiException(systemMessage: $systemMessage, error: 'MISSING_DATA', statusCode: 400, message: __('errors.' . $message));
    }

    public static function ResetCodeIsInvalid($systemMessage = 'The reset code is not valid', $massage = 'The reset code is not valid')
    {
        throw new ApiException(systemMessage: $systemMessage, error: 'RESET_CODE_INVALID', statusCode: 400, message: __('errors.' . $massage));
    }

    public static function InvalidCredentials($message = 'invalid credentials', $systemMessage = 'invalid credentials')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'INVALID_CREDENTIALS', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function NotAuthorized($message = 'You are not authorized', $systemMessage = 'You are not authorized')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'NOT_AUTHORIZED', statusCode: 403, systemMessage: $systemMessage);
    }

    public static function RelatedResourceExisted($message = 'There is a related resource', $systemMessage = 'There is a related resource')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'RELATED_RESOURCE_EXISTED', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function TemplateNotFound($message = 'Template Not Found', $systemMessage = 'Template Not Found')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'TEMPLATE_NOT_FOUND', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function InvalidCoupon($message = 'Invalid Coupon', $systemMessage = 'Invalid Coupon')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'INVALID_COUPON', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function InvalidCouponValue($message = 'Invalid Coupon Value', $systemMessage = 'Invalid Coupon Value')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'INVALID_COUPON_VALUE', statusCode: 400, systemMessage: $systemMessage);
    }

    public static function InvalidOperation($message = 'Invalid Operation', $systemMessage = 'Invalid Operation')
    {
        throw new ApiException(message: __('errors.' . $message), error: 'INVALID_OPERATION', statusCode: 403, systemMessage: $systemMessage);
    }
}
