<?php

declare(strict_types = 1);

namespace Modules\Product\Exceptions;

use Exception;
use Illuminate\Http\Response;

/**
 * Class ModelRelationMissingException
 * @package Modules\Product\Exceptions
 */
class ModelRelationMissingException extends Exception
{
    /**
     * @param string $modelName
     * @return static
     */
    public static function missingImagesRelation(string $modelName): self
    {
        return new static('Method images() not exists on ' . $modelName . ' class', Response::HTTP_NOT_FOUND);
    }
} 