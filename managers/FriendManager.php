<?php


class FriendManager
{
    private $userId;
    private $friends;
    private $mutuals;
    private $manager;
    private $allUsers;

    public function __construct()
    {
        include_once ('managers/UserManager.php');
        include_once('helpers/QueryBuilder.php');
        include_once ('managers/SessionManager.php');
        SessionManager::start();
        $this->manager = new UserManager();
        $this->allUsers = QueryBuilder::table('friends')->select()->toUsers();
        $this->userId = SessionManager::getAuthenticatedUser();
        $this->mutuals = $this->transform(QueryBuilder::table('my_friends')
            ->select()
            ->get());
        $this->friends = $this->mutuals[$this->userId];

    }

    public function addFriend($id) {
        QueryBuilder::table('my_friends')->insert(['friend_id_1'=> $this->userId, 'friend_id_2'  => $id])->execute();
    }
    public function removeFriend($id) {
        QueryBuilder::table('my_friends')->delete()->where(['friend_id_1'=> $this->userId, 'friend_id_2'  => $id])->execute();
    }
    public function paginate($page, $arr) {
        return array_slice($arr, $page == 1 ? 0 : $page* 6,6);

    }
    public function getPages() {
        return ceil($this->getFriendCount()/6);
    }
    public function  findMutualFriends($userId) {
        // Return empty array if user has no friends.
        return array_intersect($this->mutuals[$this->userId], $this->mutuals[$userId] !=  null ? $this->mutuals[$userId]: array());
    }
    public function getAllUsers() {
        return array_udiff($this->allUsers, $this->getFriends(),  function($a,$b){
            return $a->getId() - $b->getId();
        });
    }
    public function getFriendCount() {
        return count($this->friends);
    }
    public function getFriends() {
        $users = [];
        foreach ($this->friends as  $id){
            $users[] = $this->manager->findUserById($id);
        }
        return $users;
    }
    public function getMutualFriendCount($id) {
        return count($this->findMutualFriends($id));
    }


    // Helper function(s)
    private function transform($arr) {
        $mutualMap = [];
        // Initialize
        foreach ($arr as $data)  {
            $mutualMap[$data['friend_id_1']] = array();
        }
        // Add data
        foreach ($arr as $data)  {
            array_push($mutualMap[$data['friend_id_1']], $data['friend_id_2']);
        }
       return $mutualMap;
    }
}