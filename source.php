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


if($forum_user['id']!=1) {
 $query = "select
              u1.username as attacker,
              u2.username as vitcim,
              sum(k.mark)
          from
              pun_karma k 
                  left join users u1 on (k.user_id = u1.id)
                  left join posts p on p.id = k.post_id left join users u2 on u2.id = p.poster_id
          group by
              u1.username, u2.username";
		
 $result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

  while ($s = $forum_db->fetch_assoc($result))
  {
   echo $s;
  }


	

}
