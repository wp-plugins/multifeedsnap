=== MultiFeedSnap ===
Tags: Post,RSS
Contributors: Mr C
Tested on: 2.5.1
Stable tag: 0.1

MultiFeedsnap is a simple plugin that will render multilpe RSS feeds to your post or page. 
It is based on Paul Morley's FeedSnap. 
You can see an example of it here: http://www.colincaprani.com/links/related-feeds/

== Installation  ==
1. Download the Zip-Archive and extract all files into your wp-content/plugins/ directory.
2. If you want to change the number of posts displayed on each feed from the default of 5:
	- open the file multifeedsnap.php with a text editor;
	- edit the line indicated, changing $MAX_NO_POSTS to your desired number.
3. Go into your WordPress administration page, click on Plugins and activate it.

==  Useage ==
Enter the following tags in your post:

[feedsnap]feedurl[/feedsnap] 

where feedurl is the url of the feed you wish displayed. 

Multiple sets of tags are possible, seperated by whatever text you wish. 
MultiFeedSnap only replaces the [feedsnap] tags with the formatted feed data, 
and so all other formatting is retained.

Example:

Institution of Structural Engineers
[feedsnap]http://www.istructe.org/news/rss.asp[/feedsnap]

Richard Dawkins
[feedsnap]http://feeds.feedburner.com/richarddawkins[/feedsnap]