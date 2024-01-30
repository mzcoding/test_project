<?php

declare(strict_types=1);

namespace App\Enums;

enum TermRent: int
{
   case FOUR_HOURS = 4;
   case EIGHT_HOURS = 8;
   case TWELVE_HOURS = 12;
   case TWENTY_FOUR_HOURS = 24;

   public static function values(): array
   {
       return array_column(self::cases(), 'value');
   }
}
