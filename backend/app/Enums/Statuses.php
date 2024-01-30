<?php

declare(strict_types=1);

namespace App\Enums;

enum Statuses: string
{
   case CREATED = 'created';
   case FAILED = 'failed';
   case COMPLETED = 'completed';

   public static function values(): array
   {
       return array_column(self::cases(), 'value');
   }
}
