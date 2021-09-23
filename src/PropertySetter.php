<?php

namespace Pest\CraftCms;

class PropertySetter
{
    protected $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function setRaw(array $props)
    {
        foreach ($props as $key => $value) {
            $ref = new \ReflectionClass($this->object);
            $property = $this->findReflectionPropertyDeep($ref, $key);

            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $property->setValue($this->object, $value);
        }
    }

    private function findReflectionPropertyDeep(\ReflectionClass $ref, string $property) : \ReflectionProperty
    {
        while ($ref && !$ref->hasProperty($property)) {
            $ref = $ref->getParentClass();
        }
        if ($ref === false) {
            throw new \InvalidArgumentException("Unable to find property '{$property}'.");
        }

        return $ref->getProperty($property);
    }



}
