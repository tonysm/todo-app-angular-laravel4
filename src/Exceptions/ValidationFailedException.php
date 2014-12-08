<?php

namespace App\Exceptions;

use Illuminate\Validation\Validator;

class ValidationFailedException extends \InvalidArgumentException
{
    /**
     * @var \Illuminate\Validation\Validator
     */
    private $validator;

    function __construct(Validator $validator)
    {
        $this->validator = $validator;

        parent::__construct("Invalid arguments");
    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

} 