<?php

return [
    'exceptionErrors' => [
        'unauthenticated' => 'احراز هویت نشده!',/* 403 */
        'accessDenied' => 'شما به بخش مورد نظر دسترسی ندارید.',/*403*/
        'ApiKeyDeniedException' => 'api-key ارسال شده معتبر نیست',/*403*/
        'ApiKeyDeniedException_dont_exist' => 'api-key در هدر باید تنظیم شده باشد',/*403*/
        'ForbiddenDeviceException' => 'شما به بخش مورد نظر دسترسی ندارید',/*403*/
        'ForbiddenDeviceException_role' => 'این دستگاه اجازه ورود با این نقش را ندارد',/*403*/
        'ForbiddenDeviceException_block_device' => 'این دستگاه توسط مدیر بلاک شده است',/*403*/
        'notFound' => 'موردی یافت نشد.',/*404*/
        'internalServerError' => 'خطای داخلی سرور',/*500*/
    ]
];
