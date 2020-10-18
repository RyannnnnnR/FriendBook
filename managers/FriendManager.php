<?php


class FriendManager
{
    private $userId;
    private $friends;
    private $mutuals;

    public function __construct($userId)
    {
        include_once ('helpers/QueryBuilder.php');
        $this->userId = $userId;
        $this->mutuals = $this->transform(QueryBuilder::table('my_friends')
            ->select()
            ->get());
        $this->friends = $this->mutuals[$this->userId];
    }

    public function findFriends() {

    }
    public function paginate($page) {
        return array_slice($this->friends, $page * 6,6);
    }
    public function getPages() {
        return count($this->friends)/6;
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