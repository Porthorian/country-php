<?php declare(strict_types=1);

namespace Porthorian\Utility\Country;

class DatabaseDriver implements DatabaseDriverInterface
{
	private string $base_file;
	private string $main_json;

	public function __construct(string $base_dir = __DIR__.'/../iso3166', string $file = 'table.json')
	{
		$this->base_file = rtrim($base_dir, '/');
		$this->main_json = $file;
	}

	public function getAllContents() : array
	{
		$json = file_get_contents($this->base_file.'/'.$this->main_json);
		if ($json === false)
		{
			throw new DriverException('Failed to unable to read contents of database file.');
		}

		try
		{
			$decode = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
		}
		catch (ValueError|JsonException $e)
		{
			throw new DriverException('Failed to decode json contents.', 500, $e);
		}

		return $decode;
	}
}
