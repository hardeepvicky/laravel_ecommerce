<?php

namespace App\StaticClasses;

class UserType
{
    const BACKEND = "backend";
    const CUSTOMER = "customer";

    const List = [
        self::BACKEND => "Backend",
        self::CUSTOMER => "Customer",
    ];
}
