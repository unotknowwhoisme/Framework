<?php

namespace Citrus\Validator;

class Validator implements ValidatorInterface {
    public static function validate($data=[], $args=[]) : bool
    {
        foreach($args as $key=>$value) {
            foreach($value as $i) {
                $parameter = explode(':', $i);

                if($parameter[0] == 'required' && !isset($data[$key])) return false;

                if($parameter[0] == 'min') {
                    $len = intval($parameter[1]);

                    if(strlen($data[$key]) < $len) {
                        return false;
                    }
                }

                if($parameter[0] == 'max') {
                    $len = intval($parameter[1]);

                    if(strlen($data[$key]) > $len) {
                        return false;
                    }
                }

                if($parameter[0] == 'email' && !filter_var($data[$key], FILTER_VALIDATE_EMAIL)) return false;
            }
        }

        return true;
    }
}