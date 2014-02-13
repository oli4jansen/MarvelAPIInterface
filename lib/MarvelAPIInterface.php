<?php
class MarvelAPIInterface
{
	private $_publicKey;
	private $_privateKey;

	private $_cacheExpireTime = 0;
	private $_cacheFolder = 'cache/';
	private $_cacheFileExtention = '.json';

	private function makeCall($url, $data, $fileName)
	{
		$cacheFile = $this->_cacheFolder.$fileName.$this->_cacheFileExtention;

		if($this->isCached($cacheFile))
		{
			$response = file_get_contents($cacheFile);
		}
		else
		{
			$curl = curl_init();

			$url = $this->parseDataToUrl($url, $data);

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec($curl);
			curl_close($curl);

			file_put_contents($cacheFile, $response);
		}
		return $response;
	}

	private function isCached($cacheFile)
	{
		if($this->_cacheExpireTime > 0)
		{
			return file_exists($cacheFile) && (time() - $this->_cacheExpireTime < filemtime($cacheFile));
		}
		return FALSE;
	}

	private function parseDataToUrl($url, $data=Array())
	{
		$fullData = Array(
			'ts' => time(),
			'apikey' => $this->_publicKey,
			'hash' => md5(time().$this->_privateKey.$this->_publicKey)
		);
		$fullData = array_merge($fullData, $data);

		return sprintf("%s?%s", $url, http_build_query($fullData));
	}


	public function __construct($publicKey, $privateKey)
	{
		$this->_publicKey = $publicKey;
		$this->_privateKey = $privateKey;
	}

	public function configureCache($folder, $time)
	{
		$this->_cacheFolder = $folder;
		$this->_cacheExpireTime = $time;
	}

	// Get the full list of Marvel characters
	public function getCharacterList($pageNumber=0, $resultsPerPage=20)
	{
		$data = Array('offset' => $pageNumber*$resultsPerPage, 'limit' => $resultsPerPage);
		return $this->makeCall('http://gateway.marvel.com:80/v1/public/characters', $data, 'characters-page'.$pageNumber.'x'.$resultsPerPage);
	}

	// Get information about a specific Marvel character
	public function getCharacter($id)
	{
		return $this->makeCall('http://gateway.marvel.com:80/v1/public/characters/'.$id, Array(), 'character-'.$id);
	}

	// Get information about a specific Marvel comic
	public function getComic($id)
	{
		return $this->makeCall('http://gateway.marvel.com:80/v1/public/comics/'.$id, Array(), 'comic-'.$id);
	}

}