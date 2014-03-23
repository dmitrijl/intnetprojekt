<?php
/***********************************
CLASSES
************************************/
class Category {
	public $id;
	public $name;
	public $numThreads;

	function __construct($id,$name,$numthreads) {
		$this->id = $id;
		$this->name = $name;
		$this->numThreads = $numthreads;
	}
}

class Thread {
	public $threadID;
	public $category;
	public $title;
	public $op;
	public $postCount;
	public $timestamp;
	public $locked;
	public $sticky;
	
	function __construct($threadID, $category, $title, $op, $postCount, $timestamp, $locked, $sticky) {
		$this->threadID = $threadID;
		$this->category = $category;
		$this->title = $title;
		$this->op = $op;
		$this->postCount = $postCount;
		$this->timestamp = $timestamp;
		$this->locked = $locked;
		$this->sticky = $sticky;
	}
	
}

class Post {
	public $threadID;
	public $postSucc;
	//public $postID;
	public $poster;
	public $message;
	public $timestamp;
	
	function __construct($threadID, $postSucc, $poster, $message, $timestamp) {
		$this->threadID = $threadID;
		$this->postSucc = $postSucc;
		//$this->postID = $postID;
		$this->poster = $poster;
		$this->message = $message;
		$this->timestamp = $timestamp;
	}
}

class User {
	public $username;
	public $password;
	public $salt;
	public $admin;
	public $avatar;
	public $signature;
	public $postCount;
	
	function __construct($username,$password,$salt,$admin,$avatar,$signature,$postCount) {
		$this->username = $username;
		$this->password = $password;
		$this->salt = $salt;
		$this->admin = $admin;
		$this->avatar = $avatar;
		$this->signature = $signature;
		$this->postCount = $postCount;
	}
}

class SavedThread {
	public $title;
	public $message;
	
	function __construct($title,$message) {
		$this->title = $title;
		$this->message = $message;
	}
}

?>
