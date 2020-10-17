<?php


class UserManager
{
    private $users;

    public function __construct()
    {
        include_once ('QueryBuilder.php');
        $this->users = QueryBuilder::table('friends')->select()->get();
    }

    public function findUser($email, $pass) {

    }
}