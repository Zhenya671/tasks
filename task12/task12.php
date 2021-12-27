<?php

class Calculator {

    protected int $firstArgument;
    protected int $secondArgument;
    protected string $string = '';

    protected int $answer;


    public function __construct($firstArgument, $secondArgument){

        $this->firstArgument = $firstArgument;
        $this->secondArgument = $secondArgument;

    }

    public function __toString(): string
    {

        return $this->string. " = " . $this->answer;

    }


    public function actionAddition(): Calculator
    {
        $a = $this->firstArgument;
        $b = $this->secondArgument;

        $this->string .= $a. " + " .$b;
        $this->answer = $a + $b;


        return $this;
    }

    public function actionSubtraction(): Calculator
    {

        $a = $this->firstArgument;
        $b = $this->secondArgument;

        $this->string .= $a. " - " .$b;
        $this->answer = $a - $b;

        return $this;

    }

    public function actionMultiplication(): Calculator
    {

        $a = $this->firstArgument;
        $b = $this->secondArgument;

        $this->string .= $a. " * " .$b;
        $this->answer = $a * $b;

        return $this;

    }

    public function actionDivision()
    {
        $a = $this->firstArgument;
        $b = $this->secondArgument;

        if ($b == 0) {
            echo 'second argument cant be 0';
            return false;
        }

        $this->string .= $a. " / " .$b;
        $this->answer = $a / $b;
        return $this;
    }

    public function actionDivideBy(int $equal)
    {
        if ($equal == 0) {

            echo 'second argument cant be 0';
            return false;

        }

        $this->string = "(" . $this->string. ")" . " / " .$equal;
        $this->answer /= $equal;
        return $this;

    }

    public function actionMultiplicationBy(int $equal): Calculator
    {

        $this->string = "(" . $this->string. ")" . " * " .$equal;
        $this->answer *= $equal;
        return $this;

    }

    public function actionAdditionBy(int $equal): Calculator
    {

        $this->string = "(" . $this->string. ")" . " + " .$equal;
        $this->answer += $equal;
        return $this;

    }

    public function actionSubtractionBy(int $equal): Calculator
    {

        $this->string = "(" . $this->string. ")" . " - " .$equal;
        $this->answer -= $equal;
        return $this;

    }

}

$object = new Calculator(6,2);

echo $object
    ->actionAddition()
        ->actionMultiplicationBy(2)
        ->actionSubtractionBy(1)
        ->actionMultiplicationBy(3)
        ->actionDivideBy(5);

