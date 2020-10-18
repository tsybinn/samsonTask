<?php
namespace Test3;

class newBase
{
    static private $count = 0;
    static private $arSetName = [];
    /**
     * @param string $name
     */
    function __construct(int $name = 0)
    {
        if (empty($name)) {
            while (array_search(self::$count, self::$arSetName) != false) {
                ++self::$count;
            }
            $name = self::$count;
        }
        $this->name = $name;
        self::$arSetName[] = $this->name;
    }
    protected $name;
    //*private $name;
    /**
     * @return string
     */
    public function getName(): string
    {
        return '*' . $this->name  . '*';
    }
    protected $value;
    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
        // added
        return $this;
    }
    /**
     * @return string
     */
    public function getSize()
    {
        $size = strlen(serialize($this->value));
        return $size;
       //* return strlen($size) + $size;
    }
  //    public function __sleep()
//    {
//      return ['value'];
//
//    }
    /**
     * @return string
     */
    public function getSave(): string
    {
        $value = serialize($this->value);
        //*$value = serialize($value);
          return $this->name . '|' . $this->getSize() . '|' . $value;
        //* return $this->name . ':' . sizeof($value) . ':' . $value;
    }
    /**
     * @return newBase
     */
    static public function load(string $value): newBase
    {
        $arValue = explode('|', $value);
      //*  $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1,strlen($arValue[2]))));
//*        ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
// *       + strlen($arValue[1]) + 1), $arValue[1]));
    }
}
class newView extends newBase
{
    private $type = null;
    private $size = 0;
    private $property = null;
    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        parent::setValue($value);
        $this->setType();
        $this->setSize();
        return $this;
    }
    public function setProperty($value)
    {
        $this->property = $value;
        return $this;
    }

    private function setType()
    {
        if (is_object($this->value)) {
           $this->type = get_class($this->value);

            if (strpos( $this->type, 'Test3\newBase') !== false) {
                $this->type =  'test';
            }
        } else{
            $this->type= gettype($this->value);
        }
    }

//    private function setType()
//    {
//        $this->type = gettype($this->value);
//    }

    private function setSize()
    {


        if (is_subclass_of($this->value, 'Test3\newBase')) {
            $this->size = parent::getSize();
        } if ($this->type == 'test') {
                       $this->size = parent::getSize()   +  strlen($this->property);
        } else {
            $this->size = strlen($this->value);
        }
    }

//    private function setSize()
//    {
//        if (is_subclass_of($this->value, "Test3\newView")) {
//            $this->size = parent::getSize() + 1 + strlen($this->property);
//        } elseif ($this->type == 'test') {
//            $this->size = parent::getSize();
//        } else {
//            $this->size = strlen($this->value);
//        }
//    }
    /**
     * @return string
     */
    public function __sleep()
    {
        return ['property'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if (empty($this->name)) {
            throw new Exception('The object doesn\'t have name');
        }
        return '"' . $this->name  . '": ';
    }
    /**
     * @return string
     */
    public function getType(): string
    {
        return ' type ' . $this->type  . ';';
    }
    /**
     * @return string
     */

    public function getSize(): string
    {
        return ' size ' . $this->size . ';';
    }
    public function getInfo()
    {
        try {
            echo $this->getName()
                . $this->getType()
                . $this->getSize()
                . "\r\n";
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getSave(): string
    {
//        if ($this->type == 'test') {
//        echo    $this->value = $this->value->getSave();
//        }

        return parent::getSave() ."|". serialize($this->property);
    }
//    public function getSave(): string
//    {
//        if ($this->type == 'test') {
//            $this->value = $this->value->getSave();
//        }
//        return parent::getSave() . serialize($this->property);
//    }
    /**
     * @return newView
     */
    static public function load(string $value): newBase
    {
        $arValue = explode('|', $value);
        //$arValue = explode(':', $value);
        return (new newView($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1,strlen($arValue[2]))))
            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1])+1+strlen($arValue[2])+1)));
            ;
//            return (new newBase($arValue[0]))
//            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
//                + strlen($arValue[1]) + 1), $arValue[1]))
//            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
//                + strlen($arValue[1]) + 1 + $arValue[1])))
            ;
    }
}

// rename in setType, to class  newView
//function gettype($value): string
//{
//    if (is_object($value)) {
//        $type = get_class($value);
//        do {
//            if (strpos($type, "Test3\newBase") !== false) {
//                return 'test';
//            }
//        } while ($type = get_parent_class($type));
//    }
//    return gettype($value);
//}

$obj = new newBase('12345');
$obj->setValue('text');

$obj2 = new \Test3\newView('09876');
//$obj2 = new \Test3\newView('09876');
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();

$save = $obj2->getSave();

$obj3 = newView::load($save);

var_dump($obj2->getSave() == $obj3->getSave());
