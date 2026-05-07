<?php

namespace App\Enums;

enum OrderStatus : string
{
    case Successful = 'successful';
    case Failed = 'failed';
    case InDraft = 'in_draft';

}
