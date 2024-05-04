<?php

if (!function_exists('generate_random_unique_code_user')) {
    function generate_random_unique_code_user(): int
    {
        $code = '';
        $id_user_creator = set_user_creator_id() ?? null;
        $min_random_code = config_(key: 'configs.authentication.users.min_random_code_user', title: 'کمترین مقدار کد کاربر(min)');
        $max_random_code = config_(key: 'configs.authentication.users.max_random_code_user', title: 'بیشترین مقدار کد کاربر(max)');
        $random_int = rand($min_random_code, $max_random_code);
        $code = $id_user_creator ? $random_int . $id_user_creator : $random_int;
        $code = intval($code);
        $is_code_unique = \Modules\Authentication\Entities\User::check_unique_code($code);
        return $is_code_unique ? $code : generate_random_unique_code_user();
    }
}

if (!function_exists('set_user_creator_id')) {
    function set_user_creator_id($user = null)
    {
        $user = $user ?? auth()?->user() ?? null;
        return $user?->id ?? null;
    }
}

// todo should be delete
if (!function_exists('set_user_creator')) {
    function set_user_creator($user = null)
    {
        $user = $user ?? auth()?->user() ?? null;
        return $user?->id ?? null;
    }
}

if (!function_exists('user_have_permission')) {
    function user_have_permission($permission, $user = null, array|collection $permissions = null): bool
    {
        if (!is_null($permissions) && is_null($permission)) {
            # $permissions
            // todo
            dd("not work yet");
        }
        /** @var \Modules\Authentication\Entities\User $user */
        $user = $user ?? auth()?->user() ?? null;
        // todo should be change
        $permissions_id = \Modules\Authorization\Services\PermissionService::convertPermissionToId($permission);
        return $user && $user->hasPermissionTo($permissions_id);
    }
}

if (!function_exists('user_have_role')) {
    function user_have_role($roles = [], $user = null): bool
    {
        if (is_string($roles)) {
            $roles = [$roles];
        }
        /** @var Modules\Authentication\Entities\User $user */
        $user = $user ?? auth()?->user() ?? null;
        return \Modules\Authorization\Services\RoleService::userHaveRoles(user: $user, roles: $roles);
    }
}

if (!function_exists('update_or_create_permissions')) {
    function update_or_create_permissions($permissions = [])
    {
        $permissions = !empty($permissions) ? $permissions : \Modules\Authorization\Entities\PermissionEnum::cases();
        foreach ($permissions as $permission) {
            $permission_value = $permission->value;
            (new \Modules\Authorization\Http\Repositories\PermissionRepository)->create(['name' => $permission_value]);
        }
    }
}

if (!function_exists('response_default')) {
    function response_default($data = [], $message = '', $status = \Symfony\Component\HttpFoundation\Response::HTTP_OK/* 200 */, $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [];
        $response['message'] = $message ?? '';
        $response['errors'] = $errors ?? [];
        $response['data'] = $data ?? null;

        # set and validate status_code
        $status = array_key_exists($status, \Symfony\Component\HttpFoundation\Response::$statusTexts) ? $status : /* 200 */
            \Symfony\Component\HttpFoundation\Response::HTTP_OK;

        return response()->json($response, $status);
    }
}

if (!function_exists('mobile')) {
    function mobile(string $mobile): bool|int
    {
        return (bool)preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $mobile) || (bool)preg_match('/^(9){1}[0-9]{9}+$/', $mobile);
        // return preg_match('/(09)[0-9]{9}/', $mobile);
    }
}

if (!function_exists('password')) {
    function password(string $password): bool|int
    {
        return preg_match('/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password);
    }
}

if (!function_exists('telephone')) {
    function telephone(string $telephone): bool|int
    {
        return preg_match('/(0)[0-9]{9}/', $telephone);
    }
}

if (!function_exists('send_sms')) {
    function send_sms(string|int $mobile, string $message = null): bool
    {
        try {
            \Illuminate\Support\Facades\Log::info('send_sms', [$mobile, $message]);
            //return \Modules\Sms\Services\Sms::sendSMSAsTemp($mobile, $message, 'otp');
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }
}

if (!function_exists('is_string_english')) {
    function is_string_english(string $string, $strict = false): bool|int
    {
        $result = preg_match('/[^A-Za-z0-9]/', $string);
        return !$strict ? $result : $result && !is_string_persian($string);
    }
}

if (!function_exists('is_string_persian')) {
    function is_string_persian(string $string, $strict = false): bool|int
    {
        $result = preg_match('/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]/', $string);
        return !$strict ? $result : $result && !is_string_english($string);
    }
}

if (!function_exists('random_string')) {
    function random_string($length = 10, $start_with = '', $end_with = ''): string
    {
        $start_with = filled($start_with) ? $start_with . "_" : $start_with;
        $end_with = filled($end_with) ? "_" . $end_with : $end_with;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $start_with . $randomString . $end_with;
    }
}

if (!function_exists('between')) {
    function between($number, $min, $max, $equal = true): bool
    {
        if ($equal) {
            if ($number < $min) return false;
            if ($number > $max) return false;
        } else {
            if ($number <= $min) return false;
            if ($number >= $max) return false;
        }
        return true;
    }
}

if (!function_exists('flatten')) {
    function flatten(array $array): array
    {
        $return = array();
        array_walk_recursive($array, function ($a) use (&$return) {
            $return[] = $a;
        });
        return $return;
    }
}
