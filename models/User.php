<?php


class User
{
    private $id;
    private $displayName;
    private $email;
    private $password;
    private $dateStarted;
    private $numOfFriends;

    /**
     * User constructor.
     * @param $id
     * @param $displayName
     * @param $email
     * @param $password
     * @param $dateStarted
     * @param $numOfFriends
     */
    public function __construct($id, $email, $password, $displayName, $dateStarted, $numOfFriends)
    {
        $this->id = $id;
        $this->displayName = $displayName;
        $this->email = $email;
        $this->password = $password;
        $this->dateStarted = $dateStarted;
        $this->numOfFriends = $numOfFriends;
    }


    public function getAvatarUrl() {
        return 'http://api.adorable.io/avatars/285/'.strtolower($this->displayName).'.png';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * @param mixed $dateStarted
     */
    public function setDateStarted($dateStarted)
    {
        $this->dateStarted = $dateStarted;
    }

    /**
     * @return mixed
     */
    public function getNumOfFriends()
    {
        return $this->numOfFriends;
    }

    /**
     * @param mixed $numOfFriends
     */
    public function setNumOfFriends($numOfFriends)
    {
        $this->numOfFriends = $numOfFriends;
    }



}