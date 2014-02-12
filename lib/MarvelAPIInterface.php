<?php
class MarvelAPIInterface
{
	/*
	*	Variabelen
	*/

	private $_publicKey;
	private $_privateKey;

	private $_cacheExpireTime = 0;
	private $_cacheFolder = 'cache/';
	private $_cacheFileExtention = '.json';

	/*
	*	Private functies
	*/

	private function makeCall($url, $fileName)
	{
		$cacheFile = $this->_cacheFolder.$fileName.$this->_cacheFileExtention;

		if($this->isCached($cacheFile))
		{
			$response = file_get_contents($cacheFile);
		}
		else
		{
			$curl = curl_init();

			$url = $this->authenticateUrl($url);

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

	private function authenticateUrl($url)
	{
		return sprintf("%s?%s", $url, http_build_query(Array(
			'ts' => time(),
			'apikey' => $this->_publicKey,
			'hash' => md5(time().$this->_privateKey.$this->_publicKey)
		)));
	}

	/*
	*	Public functions
	*/

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

	public function getCharacterList($page=0)
	{
		return $this->makeCall('http://gateway.marvel.com:80/v1/public/characters', 'characters-'.$page);
	}
}