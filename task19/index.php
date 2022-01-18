<?php

use JetBrains\PhpStorm\ArrayShape;

class TestCLI
{

    public array $arrayOfCommands;
    public array $arguments;

    public function __construct($argv)
    {
//        var_dump($this->getDateAction());
//        $this->getDateAction();
        $this->arguments = $argv;

        $this->setArrayOfCommands();
        $this->run();
    }


    public function run()
    {

        foreach ($this->arguments as $item) {

            if (in_array($item, $this->arrayOfCommands)) {

                $arr = array_flip($this->arrayOfCommands);
                echo "\n\n" . $arr[$item] . "\n\n";

            }

        }

    }

    #[ArrayShape(['date' => "string", 'typeOfAction' => "string", 'help' => "string"])]
    public function setArrayOfCommands(): array
    {
        return $this->arrayOfCommands = [
            $this->getDateAction() => '-d',
            $this->getTypeAction() => '-t',
            $this->getHelpData() => '-h'
        ];
    }

    public function getHelpData(): string
    {
        return "For get more information of commands write -h\n\n
        -t  command return types of actions in task 17 logger\n\n
        -d  command return dates of committed actions in task 17 logger\n\n";
    }


    public function getDateAction(): string
    {

        $returnArray = [];
        $fd = fopen(__DIR__ . '/task17final/logger.log', 'r');
        while (!feof($fd)) {

            $array = explode(' ', fgets($fd));
            print_r($array);
            $returnArray[] = $array[2] . ' ' . $array[3];

        }

        fclose($fd);
        $returnString = '';

        for ($i = 0; $i <= count($returnArray) - 1; $i++) {
            $returnString .= $i + 1 . '. ' . $returnArray[$i] . "\n";
        }
        return $returnString;
    }


    public function getTypeAction(): string
    {
        $returnArray = [];
        $fd = fopen(__DIR__ . '/task17final/logger.log', 'r');
        while (!feof($fd)) {

            $array = explode(' ', fgets($fd));
            $returnArray[] = $array[0];

        }

        fclose($fd);
        $returnString = '';

        for ($i = 0; $i <= count($returnArray) - 1; $i++) {
            $returnString .= $i + 1 . '. ' . $returnArray[$i] . "\n";
        }
        return $returnString;
    }
}

$var = new TestCLI($argv);

