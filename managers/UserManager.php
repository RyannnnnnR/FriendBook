<?php


class UserManager
{
    private $users = null;
    public function __construct()
    {
        include_once('helpers/QueryBuilder.php');
        $this->users = QueryBuilder::table('friends')->select()->toUsers();
    }

    public function findUserByEmail($email, $pass) {
        foreach ($this->users as $user) {
            if($user->getEmail() == $email && $user->getPassword() == $pass){
                return $user;
            }
        }
        return null;
    }
    public function findUserById($id) {
        $tmp =  $this->users;
        $index  = 0;
        foreach ($tmp as $user) {
            if($user->getId() === $id){
                $needle = $user;
                unset($tmp[$index]);
                return $needle;
            }
            $index++;
        }
        return null;
    }
}