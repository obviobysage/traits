<?php

namespace ObvioBySage\Traits;

trait IsGettable
{
    /**
     * Make protected attributes read-only.
     *
     * @param  string $offset
     * @return mixed
     */
    public function __get($offset)
    {
        return $this->{$offset} ?? null;
    }

    /**
     * Make protected attributes empty()'able.
     *
     * @param  string $offset
     * @return bool
     */
    public function __isset($offset)
    {
        return isset($this->{$offset}) && empty($this->{$offset}) === false;
    }
}
