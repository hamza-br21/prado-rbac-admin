<?php
use Prado\Data\ActiveRecord\TActiveRecord;

class ProfileRecord extends TActiveRecord
{
    const TABLE = 'profiles';

    public $id;
    public $label;
    public $active;
    
   public static $RELATIONS = array(
    'users' => array(self::HAS_MANY, 'UserRecord', 'id_profile'),

    'habilitations' => array(
        self::MANY_TO_MANY,
        'HabilitationRecord',
        'profile_habilitation'
    ),
);



    public static function finder($className = __CLASS__)
    {
        return parent::finder($className);
    }
}
