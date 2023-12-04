<?php

class UserType
{
    const BACKEND = 1;
    const CUSTOMER = 2;

    const List = [
        self::BACKEND => "Backend",
        self::CUSTOMER => "Customer",
    ];
}