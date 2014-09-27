<?php

namespace User;

use Event\EventEntity;
use Talk\TalkCommentEntity;
use Talk\TalkEntity;

class UserEntity
{
    private $data;

    /**
     * Create new UserEntity
     *
     * @param stdclass $data Model data retrieved from API
     */
    public function __construct($data)
    {
        $this->data = $data;

        if (isset($this->data->events)) {
            foreach ($this->data->events as &$event) {
                $event = new EventEntity($event);
            }
        }
        if (isset($this->data->talks)) {
            foreach ($this->data->talks as &$talk) {
                $talk = new TalkEntity($talk);
            }
        }
        if (isset($this->data->comments)) {
            foreach ($this->data->comments as &$comment) {
                $comment = new TalkCommentEntity($comment);
            }
        }
    }

    /**
     * Getter for username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->data->username;
    }
    
    /**
     * Getter for full_name
     *
     * @return mixed
     */
    public function getFullName()
    {
        return $this->data->full_name;
    }

    /**
     * Getter for email_hash
     *
     * @return mixed
     */
    public function getEmailHash()
    {
        return (isset($this->data->email_hash)) ? $this->data->email_hash : md5('');
    }
    
    /**
     * Getter for twitter_username
     *
     * @return mixed
     */
    public function getTwitterUsername()
    {
        return $this->data->twitter_username;
    }
    
    /**
     * Getter for uri
     *
     * @return mixed
     */
    public function getUri()
    {
        return $this->data->uri;
    }
    
    /**
     * Getter for verbose_uri
     *
     * @return mixed
     */
    public function getVerboseUri()
    {
        return $this->data->verbose_uri;
    }
    
    /**
     * Getter for website_uri
     *
     * @return mixed
     */
    public function getWebsiteUri()
    {
        return $this->data->website_uri;
    }
    
    /**
     * Getter for talks_uri
     *
     * @return mixed
     */
    public function getTalksUri()
    {
        return $this->data->talks_uri;
    }
    
    /**
     * Getter for attended_events_uri
     *
     * @return mixed
     */
    public function getAttendedEventsUri()
    {
        return $this->data->attended_events_uri;
    }

    public function getTalks()
    {
        return $this->data->talks;
    }

    public function getEvents()
    {
        return $this->data->events;
    }

    public function getComments()
    {
        return $this->data->comments;
    }
}
