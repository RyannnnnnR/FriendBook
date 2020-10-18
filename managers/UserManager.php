<?php


class UserManager
{
    private $users = null;
    public function __construct()
    {
        include_once('QueryBuilder.php');
        $this->users = QueryBuilder::table('friends')->select()->get();
    }

    public function findUser($email, $pass) {
        foreach ($this->users as $user) {
            if($user['friend_email'] == $email && $user['password'] == $pass){
                return $user['friend_id'];
            }
        }
        return -1;
    }
}