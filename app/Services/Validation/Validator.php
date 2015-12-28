<?php

namespace App\Services\Validation;

class Validator extends \Illuminate\Validation\Validator
{
    /**
     * Validate that an attribute contains only alphabetic characters.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function validateAlpha($attribute, $value)
    {
        // オリジナルのバリデーションから多バイト文字を除外
        return is_string($value) && preg_match('/^[\pL\pM]+$/', $value);
    }

    /**
     * Validate that an attribute contains only alpha-numeric characters.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function validateAlphaNum($attribute, $value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        // オリジナルのバリデーションから多バイト文字を除外
        return preg_match('/^[\pL\pM\pN]+$/', $value);
    }

    /**
     * Validate that an attribute contains only alpha-numeric characters, dashes, and underscores.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function validateAlphaDash($attribute, $value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        // オリジナルのバリデーションから多バイト文字を除外
        return preg_match('/^[\pL\pM\pN_-]+$/', $value);
    }
}
