<?php 

Namespace App\Parsers;

Class TweetContentParser{

	protected $canonicalTweet, $originalText;

	function __construct($canonicalTweet){
		$this->canonicalTweet = $canonicalTweet;
		$this->originalText = $canonicalTweet->text;
	}

	function parse(){

		// remove Emojis. causing sql problems
		$this->originalText = self::removeEmoji($this->originalText);

		// replace t.co links with pretty links and make them linkable

		$numberOfUrls = count($this->canonicalTweet->entities->urls);
		
		$content =" ";
		
		if ($numberOfUrls > 0) {
			$parts = preg_split('#http(s)?://t\\.co/\\w+#',$this->originalText);
			$counter = 0;
			while ( $counter < $numberOfUrls) {
				$urlObject = $this->canonicalTweet->entities->urls[$counter];
				$expanded_url = $urlObject->expanded_url;
				$display_url = $urlObject->display_url;

				$content .= $parts[$counter];
				$content .= '<a href="' . $expanded_url . '">' . $display_url . '</a>';
				$this->lastUrl = $expanded_url;
				$counter++;
			}
			$content .= $parts[$counter];
		} else {
			$content = $this->originalText;
		}

		// remove Media URLs (if any)
		$content = preg_replace('#http(s)?://t\\.co/\\w+#', "", $content);

		// replace @words with twitter links to profiles
		$content = preg_replace("#@(\\w+)#", "<a href=\"http://twitter.com/$1\">@$1</a>", $content);

		// replace #Hashtags with twitter links to hashtags
		if(count($this->canonicalTweet->entities->hashtags) > 0){

			foreach ($this->canonicalTweet->entities->hashtags as $key => $hashtag) {

				$content = preg_replace('#('.$hashtag->text.')#', "<a href=\"http://twitter.com/hashtag/$1\">$1</a>", $content);

			}
		}

		//convert everything to utf8 (see dependency above)
		//$content = Encoding::toUTF8($content);

		//return [$content, $this->lastUrl];
	
		return $content;

	}

	public static function removeEmoji($text) {

		// source: http://stackoverflow.com/questions/12807176/php-writing-a-simple-removeemoji-function

	    $clean_text = "";

	    // Match Emoticons
	    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	    $clean_text = preg_replace($regexEmoticons, '', $text);

	    // Match Miscellaneous Symbols and Pictographs
	    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	    $clean_text = preg_replace($regexSymbols, '', $clean_text);

	    // Match Transport And Map Symbols
	    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	    $clean_text = preg_replace($regexTransport, '', $clean_text);

	    // Match Miscellaneous Symbols
	    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
	    $clean_text = preg_replace($regexMisc, '', $clean_text);

	    // Match Dingbats
	    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
	    $clean_text = preg_replace($regexDingbats, '', $clean_text);

	    return $clean_text;
	}
}



?>