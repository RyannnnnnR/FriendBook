<?php


class FriendManager
{
    private $userId;
    private $friends;
    private $mutuals;
    private $manager;
    private $user;
    private $allUsers;

    public function __construct()
    {
        include_once ('managers/UserManager.php');
        include_once('helpers/QueryBuilder.php');
        include_once ('managers/SessionManager.php');
        $this->manager = new UserManager();
        $this->userId = SessionManager::getAuthenticatedUser();
        $this->allUsers = QueryBuilder::table('friends')->select()->toUsers();
        // Remove ourselves from list of available friends
        $this->allUsers = array_filter($this->allUsers, function($a) {
            return $a->getId() !== $this->userId;
        });
        $this->user = $this->manager->findUserById($this->userId);
        $this->mutuals = $this->transform(QueryBuilder::table('my_friends')
            ->select()
            ->get());
        $this->friends = isset($this->mutuals[$this->userId]) ? $this->mutuals[$this->userId] : array();

    }

    public function addFriend($id) {
        $count = $this->user->getNumOfFriends() + 1;
        QueryBuilder::table('friends')->update(['num_of_friends' => $count])->where('friend_id', '=', $this->userId)->execute();
        QueryBuilder::table('my_friends')->insert(['friend_id_1'=> $this->userId, 'friend_id_2'  => $id])->execute();
    }
    public function removeFriend($id) {
        $count = $this->user->getNumOfFriends() - 1;
        QueryBuilder::table('friends')->update(['num_of_friends' => $count])->where('friend_id', '=', $this->userId)->execute();
        QueryBuilder::table('my_friends')->delete()->where([['friend_id_1', '=', $this->userId], ['friend_id_2', '=', $id]])->execute();
    }
    public function paginate($page, $arr) {
        return array_slice($arr, ($page -1) * 6,6);

    }
    public function getPages($all = false) {
        return ceil(($all ? count($this->getAllUsers()) :$this->getFriendCount())/6);
    }
    public function getMutualFriendPages($id) {
        return ceil($this->getMutualFriendCount($id)/6);
    }
    public function  findMutualFriends($userId) {
        // Return empty array if user has no friends.
        return array_intersect(isset($this->mutuals[$this->userId])? $this->mutuals[$this->userId]: array(), isset($this->mutuals[$userId]) ? $this->mutuals[$userId]: array());
    }
    public function getAllUsers() {
        return array_udiff($this->allUsers, $this->getFriends(),  function($a,$b){

            return $a->getId() - $b->getId();
        });
    }
    public function getFriendCount() {
        if ($this->friends == null) return 0;
        return count($this->friends);
    }
    public function getFriends() {
        if ($this->friends == null) return array();
        $users = [];
        foreach ($this->friends as  $id){
            $users[] = $this->manager->findUserById($id);
        }
        return $users;
    }
    public function getMutualFriends($fId) {
        $users = [];
        foreach ($this->findMutualFriends($fId) as $id){
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