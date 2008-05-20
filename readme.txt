=== MultiFeedSnap ===
Contributors: Dr C
Tags: Post,RSS
Requires at least: 2.5.0
Tested up to: 2.5.1
Stable tag: 1.1

MultiFeedsnap is a simple plugin that will render multiple RSS feeds to your post or page.

== Description ==

In preparing my site I wanted to have multiple RSS feeds on a single page. Not liking complexity, 
the simplest plugin I found was Paul Morley's FeedSnap which seems to be no longer supported. 
However, it only allows a single feed on each post or page. Therefore I rewrote the FeedSnap 
plugin to allow multiple feeds, removing its dependence on the lastRSS() parser, and (in my opinion)
simplifying the code somewhat.

MultiFeedsnap is based on Paul Morley's FeedSnap. Paul Morley's website is down and so I 
have not been able to contact him for consent, though there is no license on FeedSnap.

MultiFeedsnap  uses the function TextBetweenArray() posted by mvp at mvpprograms dot com at 
http://ie2.php.net/manual/en/function.strpos.php#72019.

MultiFeedsnap also uses the ideas at http://wordpress.pastebin.ca/276266.

MultiFeedSnap has been tested on WordPress 2.5.1 only.

The MultiFeedSnap website is: http://www.colincaprani.com/programming/multifeedsnap/

You can see an example of its use here: http://www.colincaprani.com/links/related-feeds/

Please leave some comments and suggestions for improvement. Thanks!

== Installation  ==

1. Download the Zip-Archive and extract all files into your wp-content/plugins/ directory.
2. Go into your WordPress administration page, click on Plugins and activate it.

From v1.1 you can choose how many posts from each feed you want to display using a tag option.
When the option is left out a default of 5 is used. However, if you want to change this default
number of posts:
	- open the file multifeedsnap.php with a text editor;
	- edit the line indicated, changing _$MAX\_NO\_POSTS_ to your desired number.

==  Usage ==
Enter the following tags in your post:

`[feedsnap]feedurl[/feedsnap]`

where feedurl is the url of the feed you wish displayed. 

To choose the number of posts you wish displayed from each feed (let's say 8), use:

`[feedsnap, 8]feedurl[/feedsnap]`

When the number of posts tag option is omitted, the default is used (set to 5 but can be changed
in the code as described in Installation). 

Multiple sets of tags are possible, separated by whatever content (html, text, etc.) you wish. 
MultiFeedSnap only replaces the [feedsnap] tags with the formatted feed data, and so all other 
formatting is retained.

Example:

`<p>------------------------------------------------------</p>
<h3>Digg.com</h3>
[feedsnap, 10]http://digg.com/rss/index.xml[/feedsnap]

<p>------------------------------------------------------</p>
<h3>Institution of Structural Engineers</h3>
[feedsnap, 2]http://www.istructe.org/news/rss.asp[/feedsnap]

<p>------------------------------------------------------</p>
<h3>Richard Dawkins</h3>
[feedsnap]http://feeds.feedburner.com/richarddawkins[/feedsnap]
<p>------------------------------------------------------</p>`

== Version History ==
v1.1
Added tag option for number of posts from each feed. This means no more hacking!
Any ideas for further extension? Let me know: www.colincaprani.com/programming/multifeedsnap/

v1.0.3
Added support for servers with _allow\_url\_fopen = Off_ using a call to Snoopy. 
Thanks to Brad (again!) for discovering this and persevering with it.

v1.0.2
Links now open in new windows. Thanks to Thomas for the suggestion.

v1.0.1
Added support for digg.com feeds using the information here:
http://hellaleet.blogspot.com/2007/04/parsing-diggs-rss-feeds.html
Thanks to Brad for spotting this.

v1.0
Initial release