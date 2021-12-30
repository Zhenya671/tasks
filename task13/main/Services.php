<?php

abstract class Services
{

    protected int $costServices = 0;
    protected array $allCostServices;

    protected string $indent = '<br><br>';


    protected function setInfoServices(): array
    {

        return [
            'Warranty' => [
                'deadline' => '31.12.2021',
                'runQueue' => '',
                'cost' => 50
            ],
            'Delivery' => [
                'deadline' => '15:00 01.01.2022',
                'runQueue' => '',
                'cost' => 15
            ],
            'Install' => [
                'deadline' => '16:00 01.01.2022',
                'runQueue' => '',
                'cost' => 150
            ],
            'Configure' => [
                'deadline' => '17:00 01.01.2022',
                'runQueue' => '',
                'cost' => 25
            ],
        ];

    }

    protected function getInfoWarranty(): User
    {
        echo '<br>' . 'Warranty' . $this->indent;

        foreach ($this->setInfoServices()['Warranty'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->setInfoServices()['Warranty']['cost'];

        return $this;
    }

    protected function getInfoDelivery(): User
    {
        echo '<br>' . 'Delivery' . $this->indent;

        foreach ($this->setInfoServices()['Delivery'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->setInfoServices()['Delivery']['cost'];

        return $this;
    }

    protected function getInfoConfigure(): User
    {
        echo '<br>' . 'Configure' . $this->indent;

        foreach ($this->setInfoServices()['Configure'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->setInfoServices()['Configure']['cost'];

        return $this;
    }

    protected function getInfoInstall(): User
    {
        echo '<br>' . 'Install' . $this->indent;

        foreach ($this->setInfoServices()['Install'] as $infoAboutService) {
            echo $infoAboutService . '<br>';
        }

        $this->allCostServices[] = $this->setInfoServices()['Install']['cost'];

        return $this;
    }

    protected function getSumCostServices(): int
    {

        foreach ($this->allCostServices as $value) {
            $this->costServices += $value;
        }

        return $this->costServices;

    }

}