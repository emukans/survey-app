<?php


namespace AppBundle\Type;


use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class QuestionType extends AbstractEnumType
{
    const TEXT_TYPE = 'text';
    const NUMBER_TYPE = 'number';

    protected static $choices = [
        self::TEXT_TYPE   => 'Text',
        self::NUMBER_TYPE => 'Number'
    ];
}