<?php

namespace App\Constants;

abstract class ValidationMessage
{
  private const ATTR = ':attribute';

  const REQUIRED = self::ATTR . '.isRequired';
  const MIN = self::ATTR . '.belowMin';
  const MAX = self::ATTR . '.aboveMax';
  const BETWEEN = self::ATTR . '.outOfRange';
  const TYPE = self::ATTR . '.invalidType';
  const DATE_FORMAT = self::ATTR . '.invalidDateFormat';
  const UUID = self::ATTR . '.invalidUuid';
  const EMAIL = self::ATTR . '.invalidEmail';
  const DIMENSIONS = self::ATTR . '.invalidDimensions';
  const EXISTS = self::ATTR . '.notExists';
}
