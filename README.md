YTBEid2Video
============

YTBEid2Video is a function to work with Youtube data.

Was developed by <unknow> and refactored by @nax_hh.
Now is a function, tomorrow i want it to be a Class with more options.


It gets all the data you need from a Youtube Video just giving the ID.

Parse url
---------

You can parse youtube url too. And get the id from that url.

    youtube_data('http://www.youtube.com/watch?v=7OPADWu3pYo&list=UU7H0-heDAtEJL2tJ99t7UPA&index=13&feature=plcp');

Returns '7OPADWu3pYo'

Get data
--------

So you just need to keep the id video in your database and all the data come frome
Youtube with this function.

    $thumb = youtube_data('7OPADWu3pYo', 'thumb'); //returns the thumb of the video.
    $title = youtube_data('7OPADWu3pYo', 'title'); //returns the title.
    $embed = youtube_data('7OPADWu3pYo', 'embed'); //returns the embed code.


