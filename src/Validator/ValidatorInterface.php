<?php

namespace Citrus\Validator;

interface ValidatorInterface {
    public static function validate($data=[], $args=[]) : bool;
}