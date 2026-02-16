<?php 

use Prado\Data\ActiveRecord\TActiveRecord;

class HabilitationRecord extends TActiveRecord
{
    const TABLE = 'habilitations';

    public $id;
    public $label;
    public $active;

   public static $RELATIONS = array(
    'profiles' => array(
        self::MANY_TO_MANY,
        'ProfileRecord',
        'profile_habilitation'
    ),
);

    

    public static function finder($className = __CLASS__)
    {
        return parent::finder($className);
    }
}




?>