<?php
class StdDB extends SQLite3 {
    function __construct() {
        $this->open('api_stdinfo.db');
    }
}