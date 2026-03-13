<?php

abstract class Vehicle
{
    protected int $id;
    protected string $brand;
    protected string $model;
    protected int $daily_rate;
    protected int $is_available;

    public function __construct(string $brand, string $model, int $daily_rate, int $is_available){
        $this->brand = $brand;
        $this->model = $model;
        $this->daily_rate = $daily_rate;
        $this->is_available = $is_available;
        
    }

    abstract public function calculateInsurance();

    public function setId(int $id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getBrand(){
        return $this->brand;
    }

    public function getModel(){
        return $this->model;
    }

    public function getDailyRate(){
        return $this->daily_rate;
    }

    public function getIsAvailable(){
        return $this->is_available;
    }
}