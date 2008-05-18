<?php 
/* 
Plugin Name: MultiFeedSnap 
Plugin URI: http://www.colincaprani.com/wordpress/2008/05/multifeedsnap/
Description: Plugin for displaying multiple RSS Feeds.
Version: 1.0.2 
Author: Colin Caprani 
Author URI: http://www.colincaprani.com 
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.

  Copyright 2008 Colin Caprani (email: info@colincaprani.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function multifeedsnap_function ($text)
{
  // Edit the next line to set the maximum number of posts from the feed
  $MAX_NO_POSTS = 5; 
  $text = str_replace('[feedsnap]','<feedsnap>',$text);
	$text = str_replace('[/feedsnap]','</feedsnap>',$text);
  $feedURL = TextBetweenArray('<feedsnap>','</feedsnap>',$text);
  
  ini_set('user_agent', 'Anything here'); // so we can parse digg.com feeds
  //  see: http://hellaleet.blogspot.com/2007/04/parsing-diggs-rss-feeds.html 
  $iFeeds = count($feedURL);  // Find out how many feeds on the page
  for ($i = 0; $i < $iFeeds; $i++)
  {
    $atext = ""; // reset replacement for string between feedsnap brackets
  
  	// Try to load and parse RSS file
  	if( fopen($feedURL[$i],'r') )
    {
      require_once(ABSPATH . WPINC . '/rss-functions.php');
      $rs = fetch_rss($feedURL[$i]);
  	  $items = $rs->items;
      $count = min(count($items),$MAX_NO_POSTS);
      for ($j = 0; $j < $count; $j++)
      {
        $item = $items[$j];
        $pubdate = substr($item['pubdate'], 0, 16);
        if($pubdate != "")
          $pubdate = " - " . $pubdate;
    		$atext .= "<p><b><a href=\"$item[link]\" target=\"_blank\">$item[title]</a></b> <i>".$pubdate."</i><br>";
    		$atext .= html_entity_decode($item[description]); //.'<a href="'.$item['link'].'"> more...</a>'
    		$atext .= "</p>";
      }
    }
  	else 
    {
      $atext .= "Error: It's not possible to reach RSS file...\n";
    }
 
    // this finds the particular feed between the feedsnap brackets and replaces
    // it with the assembled feed text
  	$text = str_replace("<feedsnap>".$feedURL[$i]."</feedsnap>",$atext,$text);
	}  	
  return $text;
}

function TextBetweenArray($s1,$s2,$s)
{
  $myarray=array();
  $s1=strtolower($s1);
  $s2=strtolower($s2);
  $L1=strlen($s1);
  $L2=strlen($s2);
  $scheck=strtolower($s);

  do{
  $pos1 = strpos($scheck,$s1);
  if($pos1!==false){
    $pos2 = strpos(substr($scheck,$pos1+$L1),$s2);
    if($pos2!==false){
      $myarray[]=substr($s,$pos1+$L1,$pos2);
      $s=substr($s,$pos1+$L1+$pos2+$L2);
      $scheck=strtolower($s);
      }
        }
  } while (($pos1!==false)and($pos2!==false));
  return $myarray;
}

add_filter('the_content','multifeedsnap_function');

?>