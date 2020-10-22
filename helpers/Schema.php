<?php


class Schema
{
    private static $errors = [];
    public static function init() {
        include_once ('QueryBuilder.php');
        self::$errors[] = QueryBuilder::create('friends',
            ['friend_id' => ['increment','pk'],
            'friend_email' => ['string=50', 'unique'],
            'password' => ['string=20'],
            'profile_name' =>['string=30'],
            'date_started' => ['date'],
            'num_of_friends' => ['integer',  'unsigned']])
            ->execute()->getErrors();
        self::$errors[] = QueryBuilder::create('my_friends',
            ['friend_id_1' => ['integer'],
            'friend_id_2' => ['integer']])
            ->execute()->getErrors();
        self::populateData();
    }
    public static function getErrors() {
        // Filter out empty strings
        return array_filter(self::$errors);
    }
    private static function populateData() {
        $animals  = ["Dingo", "Koala", "Tiger", "Lion", "Wombat", "Snake", "Mongoose", "Hedgehog", "Armadillo", "Hyena",
            "Bear", "Dog", "Panda", "Impala", "Walrus", "Turtle", "Giraffe", "Fox", "Canary", "Ram"];
        $index = 0;
        foreach ($animals as $animal) {
            QueryBuilder::table('friends')->insert(['friend_email' => self::generateEmail($index), 'password' => 'password', 'profile_name' => $animal, 'date_started' => date("Y-m-d"), 'num_of_friends' => rand(1, 100)], true)->execute();
            $index++;
        }
    }

    private static function generateEmail($index) {
        return "test".($index == 0 ? "" : $index) . "@test.com";
    }
}