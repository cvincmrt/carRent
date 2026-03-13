<?php

namespace App;

class Sedan extends Vehicle
{
    private int $is_luxury;

    public function __construct(string $brand, string $model, int $daily_rate, int $is_available, int $is_luxury){
        parent::__construct($brand, $model, $daily_rate, $is_available);
        $this->is_luxury = $is_luxury;
    }

    public function calculateInsurance()
    {
        if($this->is_luxury){
            $insurance = ($this->daily_rate * 0.05) + 20;
            return $insurance;
        }else{
            $insurance = ($this->daily_rate * 0.05);
            return $insurance;
        }
    }

    public function getIsLuxury(){
        return $this->is_luxury;
    }

    public function setIsLuxury(int $is_luxury){
        $this->is_luxury = $is_luxury;
    }
}