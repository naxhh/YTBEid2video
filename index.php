<?php
/*
 *	WARNING
 *		This is an old deprecated file.
 *		We keep for those who just want a little function
 *		But we recommend the YTBEid2video class
 * 
 *  Coded by: <unknow>
 *  Refactored by: @nax_hh
 *  Version: 0.0.2
 *
 * 
 * function youtube data
 *  get youtube id or thumb
 *	Params:
 *		$url
 *			Video url or just the id
 *		$return
 *			The data you want to get from the url/id
 *			Default: nothing (returns the id)
 *		$width
 * 			The width for the video embed
 * 			Default: No width
 * 		$height
 * 			The height for the video embed
 *			Default: No height
 */
function youtube_data($url,$return='',$width='',$height='') {
	$urls = parse_url($url);

	//url is http://youtu.be/xxxx
	if($urls['host'] == 'youtu.be'){
		$id = ltrim($urls['path'],'/');
	}
	//url is http://www.youtube.com/embed/xxxx
	else if(strpos($urls['path'],'embed') == 1){
		$id = end(explode('/',$urls['path']));
	}
	//url is xxxx only
	else if(strpos($url,'/')===false){
		$id = $url;
	}
	//http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
	//url is http://www.youtube.com/watch?v=xxxx
	else{
		parse_str($urls['query']);
	$id = $v;
	}
	//return embed iframe
	if($return == 'embed'){
		return '<iframe width="'.($width?$width:560).'" height="'.($height?$height:349).'" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
	}
	//return normal thumb
	else if($return == 'thumb'){
		return 'http://img.youtube.com/vi/'.$id.'/default.jpg';
	}
	//return hqthumb
	else if($return == 'hqthumb'){
		return 'http://img.youtube.com/vi'.$id.'/hqdefault.jpg';
	}
	//return title
	else if ($return == 'title') {
		$url = "http://gdata.youtube.com/feeds/api/videos/". $id;
		$doc = new DOMDocument;
		$doc->load($url);
		return $doc->getElementsByTagName("title")->item(0)->nodeValue;
	}
	// else return id
	else{
		return $id;
	}
}
?>