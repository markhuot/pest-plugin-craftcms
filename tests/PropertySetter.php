<?php

test('set private properties of object', function () {
   $object = new class() {
       private $prop1 = 1;
       private $prop2 = 2;
       public function props() {
           return $this->prop1 . $this->prop2;
       }
   };
   $setter = new \Pest\CraftCms\PropertySetter($object);
   $setter->setRaw([
       'prop1' => 'one',
       'prop2' => 'two'
   ]);
   expect($object->props())->toBe('onetwo');
});


test('set private properties of object inherited from parent class', function () {
    $object = new class() extends \yii\web\Response {};
    $setter = new \Pest\CraftCms\PropertySetter($object);
    $setter->setRaw([
        '_statusCode' => 999,
    ]);
    expect($object->getStatusCode())->toBe(999);
});


test('throws execption if property does not exist', function () {
    $object = new class() {};
    $setter = new \Pest\CraftCms\PropertySetter($object);
    $setter->setRaw([
        'blackbox' => 'value',
    ]);
})->throws("Unable to find property 'blackbox'.");
