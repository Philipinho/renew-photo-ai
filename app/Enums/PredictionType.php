<?php

namespace App\Enums;

enum PredictionType: string
{
    const RESTORE = "restore";
    const DELETE = "deleted";
    const ARCHIVE = "archived";
}
