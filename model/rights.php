<?php

/*actions:
0.createPost
1.createThread
2.deleteThread
3.stickyThread
4.lockThread
5.editAllPosts
6.deletePost
7.banUser
*/

/*
Groups:
0.guest
1.user
2.bannedUser
3.moderator
4.admin

*/



function canDeleteThread($group) {
	return hasRights($group,2);
}

function canStickyThread($group) {
	return hasRights($group,3);
}

function canLockThread($group) {
	return hasRights($group,4);
}

function hasRights($group,$action) {
	if($group == null) $group = "guest";

	$access = array(
		"guest" => array(false,false,false,false,false,false,false,false), //guest
		"user" => array(true,true,false,false,false,false,false,false), //user
		"bannedUser" => array(false,false,false,false,false,false,false,false), //bannedUser
		"moderator" => array(true,true,true,true,true,false,true,false), //moderator
		"administrator" => array(true,true,true,true,true,true,true,true) //admin
	);

	return $access[$group][$action];
}

?>