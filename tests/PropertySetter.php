<?php

test('set private properties for object', function () {
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
