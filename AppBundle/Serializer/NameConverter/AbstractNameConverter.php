<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Serializer\NameConverter;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

abstract class AbstractNameConverter implements NameConverterInterface
{

    abstract public function getTranslations();

    public function denormalize($propertyName): string
    {
        $translations = $this->getTranslations();
        if (isset($translations[$propertyName])) {
            return $translations[$propertyName];
        }
        return $propertyName;
    }

    public function normalize($propertyName): string
    {
        $reverseMap = array_flip($this->getTranslations());
        if (isset($reverseMap[$propertyName])) {
            return $reverseMap[$propertyName];
        }
        return $propertyName;
    }
}
