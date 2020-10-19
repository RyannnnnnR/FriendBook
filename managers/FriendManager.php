<?php


class FriendManager
{
    private $userId;
    private $friends;
    private $mutuals;
    private $manager;

    public function __construct()
    {
        include_once ('managers/UserManager.php');
        include_once('helpers/QueryBuilder.php');
        include_once ('managers/SessionManager.php');
        SessionManager::start();
        $this->manager = new UserManager();
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
    public function paginate($page) {
        $ids = array_slice($this->friends, $page == 1 ? 0 : $page* 6,6);
        $users = [];
        foreach ($ids as  $id){
            $users[] = $this->manager->findUserById($id);
        }
        return $users;
    }
    public function getPages() {
        return ceil($this->getFriendCount()/6);
    }
    public function  findMutualFriends($userId) {
        return array_intersect($this->mutuals[$this->userId], $this->mutuals[$userId]);
    }

    public function getFriendCount() {
        return count($this->friends);
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