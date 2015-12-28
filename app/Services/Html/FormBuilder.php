<?php

namespace App\Services\Html;

class FormBuilder extends \Collective\Html\FormBuilder
{
    /**
     * Get the action for a "route" option.
     *
     * @param  array|string $options
     *
     * @return string
     */
    protected function getRouteAction($options)
    {
        if (is_array($options)) {
            return call_user_func_array([$this->url, 'route'], $options);
        }

        return $this->url->route($options);
    }
}
