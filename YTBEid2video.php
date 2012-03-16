<?php
/* class YTBEid2video (alias: yt2vid)
 *
 *	@author: nax_hh
 *  @version: 0.1.0
 *
 *	Vars:
 *		$id 			video id
 *		$domains		youtube domains
 *		$FeedsApi		youtube Api feeds for videos
 *	
 *
 * 	public function parse($url);
 *		Parse an url and returns the ID.
 *		OR -1 if the ID is not a youtube video
 *
 * 	public function testID($id);
 *		Test if the id is a Youtube video
 *
 *	private function getID($urlData);
 *		Gets the ID from youtube.com domains
 *
 *	public function get($type, $opts);
 *		Gets data based on the type and options given
 *
 *	private function loadXML($url);
 *		Returns a DomDocument object to work with.
 *
 *
*/

class YTBEid2video {
	public $id;
	public $domains = array('youtube.com', 'www.youtube.com', 'youtu.be', 'www.youtu.be');
	public $FeedsApi = 'http://gdata.youtube.com/feeds/api/videos/';

	public function __construct($id) {
		$this->id =  $this->parse($id);
	}

	public function parse($url) {
		//is empty?
		if ( strlen($url) == 0 ) return -1;

		//parse the url
		$urlP = parse_url($url);

		//there is not a url!
		if ( count($urlP) == 1) {
			//check if it's a id
			return $this->testID($url);
		}

		//check if is youtu.be or youtube.com
		if ( in_array($urlP['host'], $this->domains ) ) {

			//if is youtu.be/www.youtu.be we have the id next to /
			if ($urlP['host'] == $this->domains[2] || $urlP['host'] == $this->domains[3] ) {
				return $this->testID(ltrim($urlP['path'],'/'));
			}


			//we get the id and test it!
			return $this->testID( $this->getID($urlP) );
		}

		//all else fails..
		return -1;
	}

	public function testID($id) {

		//don't check failed urls
		if ($id == -1) return -1;

		//maybe it's an id
		if( strpos($id,'/') === false ){
			//seems to be an id, we get test data
			$feed = @file_get_contents($this->FeedsApi.$id);

			//not a valid id
			if (strlen($feed) < 1) return -1;

			//well your id is valid :)
			return $id;
		}

		//you are just loosing our time...
		return -1;

	}

	private function getID($urlP) {
		//Get ID from youtube.com

		//no path = fake url
		if (!isset($urlP['path'])) return -1;

		//is embed?
		if( strpos($urlP['path'],'embed') == 1 ) {
			$all = explode('/',$urlP['path']) ;
			return end( $all);
		}

		//now is a normal youtube url.. get v= and return it
		parse_str($urlP['query']);
		return $v;
	}

	public function get($type, $opts = null) {

		switch ($type) {
			case 'embed':
				//default width/heigth
				$width = 560;
				$height = 349;
				//custom opts
				if (isset($opts['width'])) $width=$opts['width'];
				if (isset($opts['height'])) $height=$opts['height'];

				return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$this->id.'" frameborder="0" allowfullscreen></iframe>';
			break;
			
			case 'thumb':
				//default thumb
				$thumb = 'default.jpg';
				if (isset($opts['hq'])) $thumb = 'hqdefault.jpg';

				return 'http://img.youtube.com/vi/'.$this->id.'/'.$thumb;
			break;

			case 'title':
				$url = $this->FeedsApi. $this->id;
				$doc = $this->loadXML($url);

				return $doc->getElementsByTagName("title")->item(0)->nodeValue;

			case 'description':
				$url = $this->FeedsApi. $this->id;
				$doc = $this->loadXML($url);

				return $doc->getElementsByTagName("content")->item(0)->nodeValue;
			default: //no valid option
				return -1;
			break;
		}
	}

	private function loadXML($url) {
		$doc = new DomDocument;
		$doc->load($url);
		return $doc;

	}
}

class_alias('YTBEid2video', 'yt2vid');
?>