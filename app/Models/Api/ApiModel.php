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

    final protected function toTimeString($seconds)
    {
        if (is_null($seconds) || !is_int($seconds) || $seconds == 0) {
            return "0h 0m";
        }
        
        // get the hours and minutes
        $hours = intdiv($seconds, 3600);
        $minutes = intdiv($seconds, 60) % 60;

        return "{$hours}h {$minutes}m";
    }

    // magic method to allow getting strings of any 'time' methods
    public function __call($name, $arguments)
    {
        if(strpos($name, 'Time') && ends_with($name, 'String')) {
            $method = substr($name, 0, strpos($name, 'String'));
            if (method_exists($this, $method)) {
                return $this->toTimeString($this->$method($arguments));
            }
        }
    }
}
