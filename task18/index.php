<?php
const ROOT = __DIR__;

require ROOT . '/task17final/vendor/autoload.php';

class PrintPhpDocs
{


    /**
     * @throws ReflectionException
     */
    public function printDocs()
    {

        echo '<pre>';

        $potentialClasses = array_diff(scandir(ROOT . '/task17final/src'), ['.', '..']);

        foreach ($potentialClasses as $potentialClass) {
            $potentialClassName = substr($potentialClass, 0, -4);
            $class = "App\\" . $potentialClassName;

            $reflection = new ReflectionClass($class);
            $className = $reflection->getName();
            $classComment = preg_replace('$\/\*{2}|\*\/$', '', $reflection->getDocComment());

            $classNameContent = "$className ($classComment)<br>";
            echo $classNameContent;

            $properties = $this->decodeObject($reflection->getProperties());
            if (!empty($properties)) {
                echo 'Properties are: <br><br>';
                $this->getClassData($properties, $className, 'Property', $class);
            }

            $methods = $this->decodeObject($reflection->getMethods());
            if (!empty($methods)) {
                echo 'Methods are: <br><br>';
                $this->getClassData($methods, $className, 'Method', $class);
            }

        }
    }

    public function decodeObject($object)
    {
        $objectEncode = json_encode($object);
        return json_decode($objectEncode, true);
    }

    /**
     * @throws ReflectionException
     */
    private function getClassData(array $properties, string $className, string $type, string $class)
    {
        foreach ($properties as $property) {

            if ($className == $property['class']) {

                switch ($type) {

                    case 'Method':
                        $propertyData = new ReflectionMethod($class, $property['name']);
                        break;
                    case 'Property':
                        $propertyData = new ReflectionProperty($class, $property['name']);
                        break;
                    default:
                        die('Error');
                }
                echo "{$property['name']}";
                echo '<pre>';
                echo preg_replace('$\/\*{2}|\*\/$', '', $propertyData->getDocComment());
                echo '</pre>';
            }
        }
    }

}

$a = new PrintPhpDocs();
try {
    $a->printDocs();
} catch (ReflectionException $e) {
    throw new UnexpectedValueException('something wrong');
}
