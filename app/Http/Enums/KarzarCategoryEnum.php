<?php

namespace App\Http\Enums;


enum KarzarCategoryEnum: int
{

    use EnumToArray;

    case کارزار = 1;
    case نظرسنجی = 2;
    case استیضاح = 3;
    case تحقیق_تفحص = 4;


}
