<?php 
/* 
Plugin Name: MultiFeedSnap 
Description: Plugin for displaying multiple RSS Feeds.
Version: 0.1 
Author: Colin Caprani 
Author URI: http://www.colincaprani.com 

This plugin is an extension of Paul Morley's FeedSnap
Paul Morley's website is down and so I have not been able to contact him for 
consent, though there is no license on FeedSnap.
It uses TextBetweenArray($s1,$s2,$s) posted by mvp at mvpprograms dot com at 
http://ie2.php.net/manual/en/function.strpos.php#72019.
It also uses the ideas at http://wordpress.pastebin.ca/276266.
*/ 

function multifeedsnap_function ($text)
{
  // Edit the next line to set the maximum number of posts from the feed
  $MAX_NO_POSTS = 5; 
  $text = str_replace('[feedsnap]','<feedsnap>',$text);
	$text = str_replace('[/feedsnap]','</feedsnap>',$text);
  $feedURL = TextBetweenArray('<feedsnap>','</feedsnap>',$text);
 
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
    		$atext .= "<p><b><a href=\"$item[link]\">$item[title]</a></b> <i>".$pubdate."</i><br>";
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