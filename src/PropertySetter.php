<?php

namespace Pest\CraftCms;

class PropertySetter
{
    protected $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function setRaw(array $props) {
        $findProperty = function (\ReflectionClass $ref, string $property) {
            while ($ref && !$ref->hasProperty($property)) {
                $ref = $ref->getParentClass();
            }

            return $ref->getProperty($property);
        };

        foreach ($props as $key => $value) {
            $ref = new \ReflectionClass($this->object);
            $propertyRef = $findProperty($ref, $key);
            if ($propertyRef->isPrivate()) {
                $propertyRef->setAccessible(true);
            }
            $propertyRef->setValue($this->object, $value);
            if ($propertyRef->isPrivate()) {
                $propertyRef->setAccessible(false);
            }
        }
    }
}
