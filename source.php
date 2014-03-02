<?php
/**
* shoutbox_pun
*
* https://github.com/andrewmichaelsmith/shoutbox_pun
*
*
* Copyright (c) 2012 Andrew Smith
*
* Dual licensed under the MIT and GPL licenses:
*   http://www.opensource.org/licenses/mit-license.php
*   http://www.gnu.org/licenses/gpl.html
*/

define("MAX_PAGES", 5);

ob_start("ob_gzhandler");
header("Cache-Control: no-cache");
header("Content-type: text/xml");  
define('FORUM_ROOT', '../../');

define('FORUM_QUIET_VISIT', 1);


require FORUM_ROOT.'include/common.php';


if($_GET['add'] && ($forum_user['id']!=1)) {
 $query = array(
  'SELECT' => 'u1.username as attacker, u2.username as victim, sum(k.mark)',
  'FROM'   => 'pun_karma AS k',
  'JOINS'  => array(
                array(
                 'LEFT JOIN' => 'users as u1',
                 'ON'        => 'k.user_id=u1.id'
                ),
                array(
                 'LEFT JOIN' => 'posts AS p left join users u2 on u2.id = p.poster_id',
                 'ON'        => 'p.id = k.post_id'
                )
               ),
  'GROUP BY' => 'u1.username, u2.username'

		);
		
 $result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

  while ($s = $forum_db->fetch_assoc($result))
  {
   echo $s;
  }


	

}
