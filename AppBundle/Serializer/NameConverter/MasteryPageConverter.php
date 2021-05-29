<?php
// Nemanja Djokic - 496/2013
namespace Psi\AppBundle\Serializer\NameConverter;

class MasteryPageConverter extends AbstractNameConverter
{

    public function getTranslations()
    {
        return [
            'id' => 'externalId'
        ];
    }
}
