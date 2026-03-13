<?php

namespace App;

class Truck extends Vehicle
{
    private int $max_load;

    public function __construct(string $brand, string $model, int $daily_rate, int $is_available, int $max_load){
        parent::__construct($brand, $model, $daily_rate, $is_available);
        $this->max_load = $max_load;
    }

    public function calculateInsurance(){
        $insurance = ($this->daily_rate * 0.10) + ($this->max_load * 5);
        return $insurance;
    }
    
    public function getMaxLoad(){
        return $this->max_load;
    }

    public function setMaxLoad(int $max_load){
        $this->max_load = $max_load;
    }
}