<?php

use Prado\Data\ActiveRecord\TActiveRecord;

class ProfileHabilitationRecord extends TActiveRecord
{
    const TABLE = 'profile_habilitation';
    
    public $id_profile;
    public $id_habilitation;
    
    public static function finder($className = __CLASS__)
    {
        return parent::finder($className);
    }
}
?>