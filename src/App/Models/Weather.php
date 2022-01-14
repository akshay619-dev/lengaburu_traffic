<?php

namespace App\Models;

use App\Models\Traits\HasName;

class Weather
{
    use HasName;

    private $effect;

    /**
     * 
     * @var string
     * @var int
     */
    function __construct($name, $effect)
    {
        $this->name = $name;
        $this->effect = $effect;
    }

    /**
     * @return int
     */
    public function getEffect()
    {
        return $this->effect;
    }
}
