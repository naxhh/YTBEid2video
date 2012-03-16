YTBEid2Video
============

YTBEid2Video is a simply class to work with Youtube data.

Was developed by [@nax_hh](https://twitter.com/#!/nax_hh).
And now is in version 0.1.0


It gets all the data you need from a Youtube Video just giving the ID.

Parse url
---------

When you create your YTBEid2video object you give an id or a url.
The system automatically parse it and returns the id.

Note:
 It returns -1 when:
 * Wrong url
 * Wrong id
 * Video doesn't exists
 Make sure you get that return error on mind.

 	if ( ($video = new YTBEid2video($youtubeURL)) == 1 ) {
 		//show data
 	} else {
 		//some error
 	}


Show data
--------

So you just need to keep the id video in your database and all the data come frome
Youtube with the method get().

	$video->get($type, $opts);


Accepted types at the moment:

* title
* thumb
* description
* embed

The $opts are diferent for each type and some types don't use options.

* thumb
Thumb by default gives a small thumb.
If you want a High Quality thumb you need to pass the opt HQ to true.

	$video->get('thumb', Array('hq' => 1));

* embed
Embed returns the embed code for your website.
You can pass a custom  width and height.

By default
	$width = 560;
	$height = 349;

You can pass one or both parameters.

	$video->get('embed', Array('width' => 500, 'height' => 400));
	$video->get('embed', Array('width' => 500);


Alias
-----

We give an alias to the class named ''yt2vid''
You can change that alias when you want but the ''test.php'' don't work without it.

More Examples & Tests
---------------------

That's all for now but you can check for Tests and examples in ''test.php''