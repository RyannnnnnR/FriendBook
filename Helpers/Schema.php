<?php


class Schema
{
    public static function init() {
        include_once ('QueryBuilder.php');
        QueryBuilder::create('friends',
            ['friend_id' => ['increment','pk'],
            'friend_email' => ['string=50'],
            'password' => ['string=20'],
            'profile_name' =>['string=30'],
            'date_started' => ['date'],
            'num_of_friends' => ['integer',  'unsigned']])->execute();
        QueryBuilder::create('my_friends',
            ['friend_id_1' => ['integer'],
            'friend_id_2' => ['integer']])->execute();
    }
}