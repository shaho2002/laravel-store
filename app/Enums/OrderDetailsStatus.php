<?php

namespace App\Enums;

enum OrderDetailsStatus : string
{
    case Sent = 'sent';
    case Canceled = 'canceled';
    case InProgress = 'in_progress';

}
