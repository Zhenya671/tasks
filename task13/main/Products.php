<?php

abstract class Products extends Services
{

    protected int $costProducts = 0;
    protected array $allCostProducts;

    protected function setInfoProducts(): array
    {

        return [
            'TV' => [
                'name' => 'coolTV',
                'manufactures' => 'samsung',
                'release_date' => '11.12.2013',
                'cost' => 1550
            ],
            'Laptop' => [
                'name' => 'coolLaptop',
                'manufactures' => 'samsung',
                'release_date' => '11.12.2014',
                'cost' => 200
            ],
            'MobilePhone' => [
                'name' => 'coolMobilePhone',
                'manufactures' => 'samsung',
                'release_date' => '11.12.2015',
                'cost' => 500
            ],
            'Fridges' => [
                'name' => 'coolFridge',
                'manufactures' => 'samsung',
                'release_date' => '11.12.2016',
                'cost' => 2000
            ],
        ];

    }

    protected function getInfoTV(): User
    {

        echo '<br>' . 'TV' . $this->indent;

        foreach ($this->setInfoProducts()['TV'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->setInfoProducts()['TV']['cost'];

        return $this;
    }

    protected function getInfoLaptop(): User
    {

        echo '<br>' . 'Laptop' . $this->indent;
        foreach ($this->setInfoProducts()['Laptop'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->setInfoProducts()['Laptop']['cost'];

        return $this;
    }

    protected function getInfoMobilePhone(): User
    {
        echo '<br>' . 'MobilePhone' . $this->indent;

        foreach ($this->setInfoProducts()['MobilePhone'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->setInfoProducts()['MobilePhone']['cost'];

        return $this;
    }

    protected function getInfoFridges(): User
    {
        echo '<br>' . 'Fridge' . $this->indent;

        foreach ($this->setInfoProducts()['Fridges'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->setInfoProducts()['Fridges']['cost'];

        return $this;
    }

    protected function getSumCostProducts(): int
    {

        foreach ($this->allCostProducts as $value) {
            $this->costProducts += $value;
        }

        return $this->costProducts;

    }

}