<?php

namespace App\Shipping;

enum ShippingType: string
{
    case PostOffice = 'post_office';
    case Transport = 'transport';
    case StorePickup = 'store_pickup';

}