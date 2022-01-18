<?php

use JetBrains\PhpStorm\ArrayShape;

class TestCLI
{

    public array $arrayOfCommands;
    public array $arguments;

    public function __construct($argv)
    {
//        $this->getLogs();
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
            'date' => '-d',
            $this->getLogs() => '-t',
            $this->getHelpData() => '-h'
        ];
    }

    public function getHelpData(): string
    {
        return "For get more information of commands write -h\n\n
        -t  command return types of actions in task 17 logger\n\n
        -d  command return dates of committed actions in task 17 logger\n\n";
    }

    public function getLogs(): string
    {
    $returnString ='';
        $fd = fopen(__DIR__.'/task17final/logger.log', 'r');
        while(!feof($fd))
        {

            $array = explode(' ', fgets($fd));
            $returnString =  " $array[0] ";


//            print_r($array);

//            $str = htmlentities(fgets($fd));
//            echo $str;
        }

        fclose($fd);

        return $returnString;
    }

}

$var = new TestCLI($argv);

