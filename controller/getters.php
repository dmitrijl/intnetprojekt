<?php
//getters.php
//holds classes and functions for getting data
/***********************************
CLASSES
************************************/

class Category {
    public $id = 0;
	public $name = 'cats';
	public $threadCount = 0;
	
	//function __construct($id,$name,$threadCount) {
		
	//}
}

class Thread {
	public $threadID = 0;
    //public $category = 'cats';
	public $title = 'title';
    public $op = 'bunch of sticks';
	public $postCount = 0;
    public $timestamp = 'now';
    public $locked = false;
    public $sticky = false;
}

class Post {
	public $threadID = 0;
    public $postSucc = 1;
	public $postID = 0;
    public $poster = "intelligent person";
    public $message = 'No';
    public $timestamp = 'now';
}

class User {
    public $username = 'idrott';
	public $password = 'pass';
	public $group = 'user';
	public $avatar = 'avatars/cat.png';
	public $signature = 'The cake is a lie';
	public $postCount = 4;
}

/********************************************'
Functions
see getters.txt for info
*******************************************/
//from http://stackoverflow.com/questions/4323411/php-write-to-console
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}



function getCategories() {

	$cat1 = new Category();
	$cat1->id = 1; $cat1->name = 'Animals'; $cat1->threadCount=2;
	$cat2 = new Category();
	$cat2->id = 2; $cat2->name = 'Vikings'; $cat2->threadCount=1;
	$cat3 = new Category();
	$cat3->id = 3; $cat3->name = 'Computers'; $cat3->threadCount=1;

	$ret = array($cat1,$cat2,$cat3);
	return $ret;
}

function getThreads($category,$min,$max,$includestickies) {
	
	debug_to_console("Calling getThreads, parameters:");
	debug_to_console("Category: ".$category);
	debug_to_console("Min: ".$min.". Max: ".$max.". IncludeStickies: ".$includestickies.".");


	$t1 = new Thread();
	$t1->threadID = 1; $t1->title = 'TIL the sky is blue.'; $t1->op="roger";
	$t1->postCount = 2; $t1->timestamp = "2014-03-17-23-22"; $t1->locked=false; $t1->sticky=false; 
	
	$t2 = new Thread();
	$t2->threadID = 2; $t2->title = 'Need help'; $t2->op="terminator";
	$t2->postCount = 3; $t2->timestamp = "2014-03-17-13-14"; $t2->locked=false; $t2->sticky=false; 

	$ret = array($t1,$t2);
	return $ret;
}

function getStickiedThreads($category) {
	debug_to_console("Calling getStickiedThreads on thread: ".$category.".");

	$t2 = new Thread();
	$t2->threadID = 3; $t2->title = 'Rules'; $t2->op="roger";
	$t2->postCount = 1; $t2->timestamp = "2014-03-17-14-14"; $t2->locked=true; $t2->sticky=true; 
	
}

function getPosts($threadID,$min,$max) {
	debug_to_console("Calling getPosts, parameters:");
	debug_to_console("threadID: ".$threadID);
	debug_to_console("Min: ".$min.". Max: ".$max.".");

	$p1 = new Post();
	$p1->threadID = 1; $p1->postSucc = 1; $p1->postID = 1;
	$p1->poster = "roger"; $p1->message = "I live in London..."; $p1->timestamp="2014-03-17-13-11";
	
	$p2 = new Post();
	$p2->threadID = 1; $p2->postSucc = 2; $p2->postID = 2;
	$p2->poster = "terminator"; $p2->message = "hahahahaha\n\ngood one"; $p2->timestamp="2014-03-17-23-22";
}

function getUserInfo($name) {
	debug_to_console("Calling getUserInfo on username ".$name.".");

	$u = new User();
	if($name == "terminator") {
		$u->username='terminator';
		$u->group='user';
		$u->avatar='./avatars/anarchy.png';
		$u->signature='There is no problem that cannot be solved with explosives.';
		$u->postCount=4;
	} else {
		$u->username='roger';
		$u->group='moderator';
		$u->avatar='./avatars/TALogo.png';
		$u->signature='I am the best.';
		$u->postCount=3;
	}
	
	return $u;
}

function getUserGroup() {
	debug_to_console("Calling getUserGroup.");
	return "moderator";
}

function getUsername() {
	debug_to_console("Calling getUsername.");
	return "roger";
}
?>

