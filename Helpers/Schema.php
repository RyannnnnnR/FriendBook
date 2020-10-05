<?php


class Schema
{
    const FRIEND_COLUMNS = ['friend_id' => ['increment', 'integer', 'pk'],
        'friend_email' => ['string=50'],
        'password' => ['string=20'],
        'profile_name' =>['string=30'],
        'date_started' => ['date'],
        'num_of_friends' => ['integer',  'unsigned']];
}