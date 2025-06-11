<?php

namespace Utilities;

class Asset
{
	private $urlBuilder;
	private $asset;
	private $pathFile;
	private $keyAdminUrl;

	public function __construct($urlBuilder, $asset, $pathFile, $keyAdminUrl)
	{
		$this->urlBuilder = $urlBuilder;
		$this->asset = $asset;
		$this->pathFile = $pathFile;
		$this->keyAdminUrl = $keyAdminUrl;
	}

	public function get($assetPath)
	{
		$assetPath = trim($assetPath, '/');

		return $this->urlBuilder->build($this->asset.'/'.$assetPath);
	}

	public function getAssetForAdmin($assetPath)
	{
		$url = rtrim(str_replace($this->keyAdminUrl, '', $this->urlBuilder->getBaseUrl()), '/');
		$assetPath = trim($assetPath, '/');

		return $url.'/'.$this->asset.'/'.$assetPath;
	}

	public function getAssetForHome($assetPath)
	{
		$url = rtrim(str_replace($this->keyAdminUrl, '', $this->urlBuilder->getBaseUrl()), '/');
		$assetPath = trim($assetPath, '/');

		return $url.'/'.$this->asset.'/'.$assetPath;
	}

	public function getFileExternal($path)
	{
		$url = $this->urlBuilder->getBaseUrl();
		$urlParts = explode($this->keyAdminUrl, $url);
		$url = $urlParts[0];

		return $url.$this->pathFile.'/'.trim($path, '/');
	}

	public function getOutsideFile($fileName)
	{
		return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . $this->asset . DIRECTORY_SEPARATOR . $fileName;
	}

	public function getOutsideSuperFile($fileName)
	{
		return dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . $this->pathFile . DIRECTORY_SEPARATOR . $fileName;
	}
}

?>