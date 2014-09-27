<?php
namespace User;

use Application\BaseApi;
use Talk\TalkEntity;

class UserApi extends BaseApi
{

    public function __construct($config, $accessToken, UserDb $userDb)
    {
        parent::__construct($config, $accessToken);
        $this->userDb = $userDb;
    }

    /**
     * Retrieve user information from the API
     *
     * @param  string $url User's URI
     * @return UserEntity user data or false
     */
    public function getUser($url, $params = array())
    {
        $params = array_merge($params, array('verbose' => 'yes'));

        $result = $this->apiGet($url, $params);

        if ($result) {
            $data = json_decode($result);
            if ($data) {
                if (isset($data->users) && isset($data->users[0])) {
                    $user = new UserEntity($data->users[0]);
                    return $user;
                }

            }
        }
        return false;
    }

    /**
     * Retrieve talks for a given user from the API
     *
     * @param $url      string User's talk URI
     * @return array    Array of TalkEntity
     */
    public function getTalks($url)
    {
        $result = $this->apiGet($url, array('verbose' => 'yes'));

        if ($result) {
            $data = json_decode($result);
            if ($data) {
                $talks = array();
                foreach ($data->talks as $talk) {
                    $talks[] = new TalkEntity($talk);
                }

                return $talks;
            }
        }

        return false;
    }
}
