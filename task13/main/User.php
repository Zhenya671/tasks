<?php

class User extends Products implements Methods
{

    protected array $requests;

    public function __construct($request = null, $request2 = null, $request3 = null, $request4 = null)
    {

        $this->requests[] = $request;
        $this->requests[] = $request2;
        $this->requests[] = $request3;
        $this->requests[] = $request4;

    }

    public function showProducts(): bool
    {

        foreach ($this->requests as $request) {
            for ($i = 0; $i<= count($this->requests)-1; $i++) {
                if ($this->requests[$i] == 'TV'|| $this->requests[$i] == 'Laptop'|| $this->requests[$i] == 'mobilePhone'|| $this->requests[$i] == 'Fridges') {

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