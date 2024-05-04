<?php

return [
    'defaults' => [
        'success' => 'با موفقیت انجام شد',
        'failed' => 'خطایی رخ داده است',
        'store_success' => 'داده ی مورد نظر با موفقیت ذخیره شد',
        'store_failed' => 'خطایی رخ داد و ذخیره انجام نشد',
        'show_success' => 'داده مورد نظر با موفقیت یافت شد',
        'show_failed' => 'خطایی رخ داد و داده یافت نشد',
        'index_success' => 'لیست اطلاعات به شرح زیر است',
        'index_failed' => 'خطایی رخ داد',
        'delete_success' => 'با موفقیت حذف انجام شد',
        'delete_failed' => 'خطایی رخ داد و حذف انجام نشد',
        'destroy_success' => 'با موفقیت حذف انجام شد',
        'destroy_failed' => 'خطایی رخ داد و حذف انجام نشد',
        'update_success_list' => 'ویرایش اطلاعات با موفقیت انجام شد',
        'update_success' => 'ویرایش با موفقیت انجام شد',
        'update_failed' => 'ویرایش به خطا خورد و انجام نشد',
        'update_failed_list' => 'ویرایش اطلاعات به خطا خورد و انجام نشد',
        'upload_failed' => 'آپلود فایل نجام نشد',
        'user_creator_id' => 'شناسه کاربر ایجاد کننده',
        'not_found' => 'اطلاعات خواسته شده یافت نشد',
        'fields' => [
            'user_creator_id' => 'شناسه کاربر ایجاد کننده',
            'created_at' => 'تاریخ ایجاد',
            'updated_at' => 'تاریخ ویرایش',
            'deleted_at' => 'تاریخ حذف',
            'lat' => 'عرض جغرافیایی',
            'Latitude' => 'عرض جغرافیایی',
            'lng' => 'طول جغرافیایی',
            'Longitude' => 'طول جغرافیایی',
            'touch' => 'touch',
            'detach' => 'detach',
        ],
        'exceptions' => [
            '500' => 'خطا در سرور',
            '403' => 'شما اجازه دسترسی به این بخش را ندارید',
        ],
    ],
    'validation' => [
        'username' => 'قالب :attribute شما نادرست است',
        'national_code' => 'کد ملی وارد شده معتبر نیست',
        'just_string_english' => 'فیلد :attribute فقط میتواند شامل حرف انگلیسی باشد',
        'update_unique' => 'فیلد :attribute باید منحصر به فرد باشد، نام انتخاب شده قبلا استفاده شده است.',
    ],
    'users' => [
        'messages' => [
            'expired_time_api_key' => 'توکن شما منقضی شده است',
            'excel_users_success' => 'ثبت کاربران با موفقیت انجام شد',
            'resend_otp_success' => 'کد تایید برای شما ارسال شد',
            'otp_success' => 'کد تایید برای شما ارسال شد',
            'otp_check_allow_send_code' => 'چند دقیقه دیگر امتحان کنید',
            'otp_check_mobile_exist_in_cache' => 'تا به حال برای این موبایل کدی ارسال نشده است',
            'register_success' => 'کد تایید برای شما ارسال شد',
            'login_unauthorized' => 'نام کاربری یا رمز عبور مطابقت ندارد',
            'login_forbidden' => 'شما مجوز ورود به این پنل را ندارید',
            'user_not_active' => 'کاربر فعال نیست، با پشتیبانی تماس بگیرید',
            'profile' => 'اطلاعات کاربر لاگین شده',
            'my_permissions' => 'لیست سطوح دسترسی کاربر لاگین شده',
            'logout' => 'کاربر با موفقیت خارج شد',
        ],
        'fields' => [
            'id' => 'شناسه کاربر',
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'full_name' => 'نام و نام خانوادگی',
            'father' => 'نام پدر',
            'national_code' => 'کد ملی',
            'gender' => 'جنسیت',
            'birthday' => 'تاریخ تولد',
            'username' => 'نام کاربری',
            'password' => 'رمز عبور',
            'status' => 'وضعیت کاربر',
            'avatar' => 'عکس پروفایل',
            'mobile' => 'تلفن همراه',

            'file' => 'فایل اکسل',
        ]
    ],
    'sliders' => [
        'messages' => [
            # 'expired_time_api_key' => 'توکن شما منقضی شده است',
        ],
        'fields' => [
            'id' => 'شناسه اسلایدر',
            'title' => 'عنواان',
            'link' => 'لینک',
            'text' => 'متن',
            'status' => 'وضعیت اسلایدر',
            'advertise_id' => 'شناسه جدول آگهی',
            # 'user_creator_id'=>'',
            # 'created_at'=>'',
            # 'updated_at'=>'',
            # 'deleted_at'=>'',

            'image' => 'عکس',
        ]
    ],
    'visits' => [
        'messages' => [
        ],
        'fields' => [
            'id'=>'شناسه گزارش ویزیت',
            'title'=>'عنوان گزارش',
            'start'=>'زمان شروع',
            'end'=>'زمان پایان',
            'stay'=>'زمان توفق',
            'customer_id'=>'شناسه فروشگاه(صنف)',
            'market_id'=>'شناسه تامین کننده',
            'status_result'=>'نتیجه ویزیت',
            'user_creator_id'=>'شناسه کاربر ثبت',
            # 'created_at'=>'',
            # 'updated_at'=>'',
            # 'deleted_at'=>'',
        ]
    ],
    'votes' => [
        'messages' => [
            '' => '',
        ],
        'fields' => [
            'score' => 'امتیاز',
            'comment' => 'کامنت',
            'customer_id' => 'شناسه فروشگاه',
        ]
    ],
    'consumers' => [
        'solicitations' => [
            'messages' => [
                '' => '',
            ],
            'fields' => [
                'id' => 'شناسه جدول درخواست ها',
                'advertises_id' => 'شناسه جدول آگهی',
                'user_creator_id' => 'شناسه کاربر ثبت کننده درخواست',
                'user_editor' => 'شناسه آخرین کاربر ویرایش کننده درخواست',
                'title' => 'عنوان درخواست',
                'description' => 'توضیح درخواست',
                'status_release' => 'وضعیت انتشار',
            ]
        ],
        'searches' => [
            'messages' => [
                '' => '',
            ],
            'fields' => [
                'id' => 'شناسه جدول جستجو',
                'search' => 'متن جستجو',
                'rate' => 'تعداد دفعات جستجو',
                'status' => 'وضعیت',
                'is_success' => 'نتیجه جستجو',
                'is_pin' => 'پین شده',
                'location_point' => 'مختصات جغرافیایی',
                # 'user_editor' => 'شناسه آخرین کاربر ویرایش کننده',
                'user_creator_id' => 'شناسه جدول اشخاص(کاربران)',
                'role_id' => 'شناسه نقش',
                'customer_id' => 'شناسه صنف',
                'tag' => 'برچسب',
            ]
        ],
    ],
    'notes' => [
        'messages' => [
            'message_one' => '',
        ],
        'fields' => [
            'id' => 'شناسه جدول یادداشت',
            'market_id' => 'شناسه تامین کننده',
            'customer_id' => 'شناسه اصناف',
            'note' => 'یادداشت',
            'image' => 'عکس',
            'audio' => 'صدا',
            'video' => 'ویدیو',
            'file' => 'فایل',
        ]
    ],
    'language_lines' => [
        'messages' => [
        ],
        'fields' => [
            'id' => 'شناسه جدول language_lines',
            'group' => 'گروه',
            'key' => 'کلید ترجمه',
            'text' => 'متن ترجمه',
        ]
    ],
    'user_mobiles' => [
        'messages' => [
        ],
        'fields' => [
            'id' => 'شناسه جدول موبایل',
            'mobile' => 'تلفن همراه',
        ],
        'mobiles' => 'لیست تلفن همراه',
    ],
    'configs' => [
        'messages' => [
        ],
        'fields' => [
            'key' => 'کلید',
            'value' => 'ارزش',
            'title' => 'عنوان',
        ]
    ],
    'markets' => [
        'market_locations' => [
            'messages' => [
                'id' => '',
            ],
            'fields' => [
                'id' => 'شناسه جدول ردیابی',
                'market_id' => 'شناسه مارکت',
                'user_creator_id' => 'شناسه جدول اشخاص(کاربران)',
                'location_point' => 'مختصات جغرافیایی',
            ],
        ],
        'messages' => [
        ],
        'fields' => [
            'id' => 'شناسه تامین کننده',
        ],
        'exclusive_codes' => [
            'customer_already_exist' => 'کد اختصاصی این صنف قبلا در سیستم ثبت شده است.',
        ]
    ],
    'devices' => [
        'messages' => [
            // 'otp_success' => 'کد تایید برای شما ارسال شد',
        ],
        'fields' => [
            'id' => 'شناسه جدول دستگاه',
            'user_id' => 'شناسه کاربر',
            'role_id' => 'شناسه نقش کاربر',
            'device_id' => 'شناسه یکتا دستگاه',
            'operation_system' => 'نام سیستم عامل',
            'extra_data' => 'اطلاعات اضافی از دستگاه',
            'status' => 'وضعیت',
        ]
    ],
    'role_groups' => [
        'messages' => [
            // 'register_success' => 'کد تایید برای شما ارسال شد',
        ],
        'fields' => [
            'id' => 'شناسه گروه',
            'name' => 'نام گروه',
            'group_id' => 'شناسه والد گروه',
            'user_creator_id' => 'شناسه کاربر ایجاد کننده',
        ]
    ],
    'publicContent' => [
        'platform_not_exist' => 'پلتفرمی با این مشخصات وجود ندارد.',
        'item_already_exist' => 'این مورد قبلا ثبت شده است.',
        'item_with_application_id_already_exist' => 'این مورد قبلا با این اپلیکیشن ثبت شده است.',
    ],
    'customer' => [
        'fields' => [
            'id' => 'شناسه صنف',
        ],
        'user_with_mobile_already_exist' => 'کاربری با این شماره تلفن قبلا در سیستم ثبت شده است.',
        'invalid_working_hours' => 'ساعات کاری را به درستی وارد کنید.',
        'store_failed_user' => 'هنگام ذخیره اطلاعات کاربر خطایی رخ داد و ذخیره انجام نشد.',
        'store_failed_working_hours' => 'هنگام ذخیره ساعات کاری خطایی رخ داد و ذخیره انجام نشد.',
        'store_failed_customer_image' => 'هنگام ذخیره عکس ها خطایی رخ داد و ذخیره انجام نشد.',
        'store_failed_phones' => 'هنگام ذخیره تلفن ثابت خطایی رخ داد و ذخیره انجام نشد.',
        'store_failed_further_information' => 'هنگام ذخیره اطلاعات تکمیلی خطایی رخ داد و ذخیره انجام نشد.',
        'update_failed_working_hours' => 'هنگام ویرایش ساعات کاری خطایی رخ داد و ذخیره انجام نشد.',
        'update_failed_customer_image' => 'هنگام ویرایش عکس ها خطایی رخ داد و ذخیره انجام نشد.',
        'update_failed_phones' => 'هنگام ویرایش تلفن ثابت خطایی رخ داد و ذخیره انجام نشد.',
        'update_failed_further_information' => 'هنگام ویرایش اطلاعات تکمیلی خطایی رخ داد و ذخیره انجام نشد.',
        'update_failed_temporary_management' => 'هنگام ویرایش اطلاعات مدیریت موقت خطایی رخ داد و ذخیره انجام نشد.',
        'invalid_default_general_telephone' => 'شماره تلفن پیشفرض عمومی نامعتبر است.',
        'invalid_factor_general_telephone' => 'شماره تلفن پیشفرض فاکتورها نامعتبر است.',
        'invalid_user_id_for_personnel' => 'کاربر وارد شده برای پرسنل نامعتبر است.',
        'personnel_already_exist' => 'این پرسنل قبلا برای این فروشنده ثبت شده است.',
        'not_access_to_remove_personnel' => 'شما مجاز به حذف این پرسنل نیستید.',
    ],
    'invoice' => [
        'cart'=>[
            'failed_cart_process' => 'هنگام پردازش سبد خرید خطایی رخ داد.',
            'failed_add_advertisement_to_cart' => 'هنگام افزودن آگهی به سبد خرید خطایی رخ داد.',
            'discount_code_accepted_successfully' => 'کد تخفیف با موفقیت اعمال شد.',
            'cart_not_found' => 'سبد خرید با این مشخصات یافت نشد.',
            'invalid_delivery_date_or_delivery_time' => 'تاریخ ارسال یا زمان ارسال نامعتبر است.',
            'insufficient_inventory' => 'موجودی کالا کافی نیست.',
            'minimum_count_big_than_count' => 'تعداد درخواستی از حداقل تعداد خرید کمتر است.',
            'maximum_count_less_than_count' => 'تعداد درخواستی از حداکثر تعداد خرید بیشتر است.',
            'insufficient_related_product_inventory' => 'موجودی کالای وابسته کافی نیست.',
            'not_access_to_delete_related_advertisement' => 'به دلیل وابستگی این آگهی به :advertisements امکان حذف وجود ندارد.',
        ],
        'main'=>[
            'failed_register_invoice_process' => 'هنگام پردازش ثبت فاکتور خطایی رخ داد.',
            'invalid_advertisement_order_ratio' => 'تعداد وارد شده به دلیل نا هماهنگی با تعداد تامین کننده نامعتبر است.',
            'not_complete_delivery_information' => ' به دلیل ناقص بودن اطلاعات ارسال سبد خرید، ثبت فاکتور ممکن نمی باشد.',
            'not_found' => ' فاکتوری با این مشخصات وجود ندارد.',
            'invoice_item_not_found' => ' سفارشی با این مشخصات وجود ندارد.',
            'customer_not_found' => ' فروشنده با این مشخصات وجود ندارد.',
            'invoice_data_not_match' => 'این فاکتور برای این فروشنده و این تامین کننده نمی باشد.',
            'customer_info_not_complete' => 'مشخصات فروشنده تکمیل نیست .',
            'failed_edit_invoice_process' => 'هنگام پردازش  ویرایش فاکتور خطایی رخ داد.',
        ],
        'payments'=>[
            'invoice_data_not_match' => 'این فاکتور برای این تامین کننده نمی باشد.',
        ],
        'rejected_invoice_items'=>[
            'not_found' => ' سفارشی با این مشخصات وجود ندارد.',
        ],
        'merge'=>[
            'invalid_customer_ids' => 'اصناف فاکتور ها با یکدیگر خوانایی ندارند.',
            'invalid_closed_statuses' => 'یکی از فاکتور ها وضعیت بسته شده دارد.',
            'successfully' => 'ادغام فاکتور ها با موفقیت انجام شد.',
        ]

    ],
    'authorization' => [
        'roles' => [
            'messages' => [
            ],
            'fields' => [
                'id' => 'شناسه نقش',
                'name' => 'نام نقش(به انگلیسی)',
                'persian_name' => 'نام نقش(به فارسی)',

                'touch' => 'touch',
                'detach' => 'detach',

                'withs' => 'جداول رابط',
                'with' => 'جدول اضافی',

                'roles' => 'لیست نقش ها',
            ]
        ],
        'permissions' => [
            'messages' => [],
            'fields' => [
                'permissions_list' => 'لیست شناسه های سطح دسترسی',
                'id' => 'شناسه سطح دسترسی',
                'name' => 'نام سطح دسترسی(به انگلیسی)',
                'tag' => 'برچسب',
                'parent' => 'شناسه پدر(سطح دسترسی پدر)',
                'persian_name' => 'نام سطح دسترسی(به فارسی)',

                'touch' => 'touch',
                'detach' => 'detach',

                'permissions' => 'لیست سطح دسترسی ها',
                'file' => 'فایل اکسل',
            ]
        ],
        'role_groups' => [
            'messages' => [
                // 'register_success' => 'کد تایید برای شما ارسال شد',
            ],
            'fields' => [
                'id' => 'شناسه گروه',
                'name' => 'نام گروه',
                'persian_name' => 'نام فارسی گروه',
                'group_id' => 'شناسه والد گروه',
                'user_creator_id' => 'شناسه کاربر ایجاد کننده',

                'touch' => 'touch',
                'detach' => 'detach',
            ]
        ],
    ],
    'polymorphism' => [
        'images' => [
            'messages' => [
                'image_valid' => '',
            ],
            'fields' => [
                'title' => 'title',
                'original_name' => 'original_name',
                'image' => 'image',
                'type' => 'type',
                'url' => 'url',
                'is_cover' => 'is_cover',
                'is_public' => 'is_public',
                'is_water_mark' => 'is_water_mark',
                'created_at' => 'created_at',
                'updated_at' => 'updated_at',
            ]
        ],
        'audios' => [
            'messages' => [
                'audio_valid' => '',
            ],
            'fields' => [
                'title' => 'title',
                'original_name' => 'original_name',
                'audio' => 'audio',
                'type' => 'type',
                'url' => 'url',
                'created_at' => 'created_at',
                'updated_at' => 'updated_at',
            ]
        ],
        'videos' => [
            'messages' => [
                'video_valid' => '',
            ],
            'fields' => [
                'title' => 'title',
                'original_name' => 'original_name',
                'video' => 'video',
                'type' => 'type',
                'url' => 'url',
                'created_at' => 'created_at',
                'updated_at' => 'updated_at',
            ]
        ],
        'files' => [
            'messages' => [
                'file_valid' => '',
            ],
            'fields' => [
                'title' => 'title',
                'original_name' => 'original_name',
                'file' => 'file',
                'type' => 'type',
                'url' => 'url',
                'created_at' => 'created_at',
                'updated_at' => 'updated_at',
            ]
        ],
    ],
];
