<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 6:50 PM
 */
class FlickrImage{
    private $id = null;
    private $owner = null;
    private $secret = null;
    private $server = null;
    private $farm = null;
    private $title = null;
    private $ispublic = null;
    private $isfriend = null;
    private $isfamily = null;

    public function __construct($id, $owner, $secret, $server, $farm, $title, $ispublic, $isfriend, $isfamily) {
        $this->id = $id;
        $this->owner = $owner;
        $this->secret = $secret;
        $this->server = $server;
        $this->farm = $farm;
        $this->title = $title;
        $this->ispublic = $ispublic;
        $this->isfriend = $isfriend;
        $this->isfamily = $isfamily;
    }


    public static function from_array(array $raw_array) {
        return new FlickrImage(
            array_key_exists("id", $raw_array)?$raw_array['id'] : null,
            array_key_exists("owner", $raw_array)?$raw_array['owner']: null,
            array_key_exists("secret", $raw_array)?$raw_array['secret']: null,
            array_key_exists("server", $raw_array)?$raw_array['server']: null,
            array_key_exists("farm", $raw_array)?$raw_array['farm']: null,
            array_key_exists("title", $raw_array)?$raw_array['title']: null,
            array_key_exists("ispublic", $raw_array)?$raw_array['ispublic']: null,
            array_key_exists("isfriend", $raw_array)?$raw_array['isfriend']: null,
            array_key_exists("isfamily", $raw_array)?$raw_array['isfamily']: null
        );
    }

    public function get_thumbnail_url() {
        return "https://farm{$this->farm}.staticflickr.com/{$this->server}/{$this->id}_{$this->secret}_t.jpg";

    }

    public function get_image_url() {
        return "https://farm{$this->farm}.staticflickr.com/{$this->server}/{$this->id}_{$this->secret}.jpg";
    }

}
