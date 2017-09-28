<?php

namespace App\Models\Api;

abstract class ApiModel implements \JsonSerializable
{
    protected $data = [];

    /**
     * Access data using dot syntax.
     *
     * @param string $key
     * @return void
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        throw new \InvalidArgumentException("$key does not exist in model data");
    }

    public function toArray($flat = true)
    {
        if ($flat) {
            return $this->data;
        }

        $array = [];
        foreach ($this->data as $key => $value) {
            array_set($array, $key, $value);
        }

        return $array;        
    }

    public function toJson()
    {
        return $this->jsonSerialize();
    }

    public function jsonSerialize()
    {
        return $this->toArray(false);
    }
}
