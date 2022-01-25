<?php

class User extends Products implements Methods
{

    protected array $requests;

    protected int $costProducts = 0;
    protected array $allCostProducts;

    protected int $costServices = 0;
    protected array $allCostServices;

    protected string $indent = '<br><br>';

    public function __construct($request = null, $request2 = null, $request3 = null, $request4 = null)
    {

        $this->requests[] = $request;
        $this->requests[] = $request2;
        $this->requests[] = $request3;
        $this->requests[] = $request4;

    }

    protected function getInfoTV(): User
    {

        echo '<br>' . 'TV' . $this->indent;

        foreach ($this->arrayProducts['TV'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->arrayProducts['TV']['cost'];

        return $this;
    }

    protected function getInfoLaptop(): User
    {

        echo '<br>' . 'Laptop' . $this->indent;
        foreach ($this->arrayProducts['Laptop'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->arrayProducts['Laptop']['cost'];

        return $this;
    }

    protected function getInfoMobilePhone(): User
    {
        echo '<br>' . 'MobilePhone' . $this->indent;

        foreach ($this->arrayProducts['MobilePhone'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->arrayProducts['MobilePhone']['cost'];

        return $this;
    }

    protected function getInfoFridges(): User
    {
        echo '<br>' . 'Fridge' . $this->indent;

        foreach ($this->arrayProducts['Fridges'] as $infoAboutProduct) {
            echo $infoAboutProduct . '<br>';
        }

        $this->showServices();
        $this->allCostProducts[] = $this->arrayProducts['Fridges']['cost'];

        return $this;
    }

    protected function getSumCostProducts(): int
    {

        foreach ($this->allCostProducts as $value) {
            $this->costProducts += $value;
        }

        return $this->costProducts;

    }

    protected function getInfoWarranty(): User
    {
        echo '<br>' . 'Warranty' . $this->indent;

        foreach ($this->arrayServices['Warranty'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->arrayServices['Warranty']['cost'];

        return $this;
    }

    protected function getInfoDelivery(): User
    {
        echo '<br>' . 'Delivery' . $this->indent;

        foreach ($this->arrayServices['Delivery'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->arrayServices['Delivery']['cost'];

        return $this;
    }

    protected function getInfoConfigure(): User
    {
        echo '<br>' . 'Configure' . $this->indent;

        foreach ($this->arrayServices['Configure'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->arrayServices['Configure']['cost'];

        return $this;
    }

    protected function getInfoInstall(): User
    {
        echo '<br>' . 'Install' . $this->indent;

        foreach ($this->arrayServices['Install'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->arrayServices['Install']['cost'];

        return $this;
    }

    protected function getSumCostServices(): int
    {

        foreach ($this->allCostServices as $value) {
            $this->costServices += $value;
        }

        return $this->costServices;

    }

    public function showProducts(): bool
    {

        foreach ($this->requests as $request) {
            for ($i = 0; $i <= count($this->requests) - 1; $i++) {
                if ($this->requests[$i] == 'TV' || $this->requests[$i] == 'Laptop' || $this->requests[$i] == 'mobilePhone' || $this->requests[$i] == 'Fridges') {

                    break;

                }

            }

            if ($request == 'TV') {

                $this->getInfoTV();

            } elseif ($request == 'Laptop') {

                $this->getInfoLaptop();

            } elseif ($request == 'MobilePhone') {

                $this->getInfoMobilePhone();

            } elseif ($request == 'Fridges') {

                $this->getInfoFridges();

            }

        }


        echo 'total cost of products: ' . $this->getSumCostProducts() . '$<br>';

        if ($this->costServices != 0) {

            echo 'total cost of services: ' . $this->costServices . '$';

        } else {

            echo 'total cost of services: ' . $this->getSumCostServices() . '$';

        }


        return true;
    }

    protected function showServices()
    {
        $this->getInfoWarranty()
            ->getInfoDelivery()
            ->getInfoInstall()
            ->getInfoConfigure();

    }

}