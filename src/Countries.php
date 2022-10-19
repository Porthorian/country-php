<?php declare(strict_types=1);

namespace Porthorian\Utility\Country;

use Exception;

class Countries
{
	private DatabaseDriverInterface $driver;

	private ?array $index = null;
	private array $alpha2_index = [];
	private array $alpha3_index = [];
	private array $m49_index = [];
	private array $continents_index = [];

	public function __construct(?DatabaseDriverInterface $driver = null)
	{
		$this->driver = $driver ?? new DatabaseDriver();
	}

	public function getByAlpha2(string $alpha2) : ?Country
	{
		return $this->find('alpha2', strtolower($alpha2));
	}

	public function getByAlpha3(string $alpha3) : ?Country
	{
		return $this->find('alpha3', strtolower($alpha3));
	}

	public function getByM49Code(string $m49_code) : ?Country
	{
		return $this->find('m49_code', strtolower($m49_code));
	}

	public function getByContinents(string $field_value) : array
	{

	}

	protected function find(string $field_name, string $field_value) : ?Country
	{
		$index_array = $this->getIndex($field_name);
		if ($index_array !== null)
		{
			return isset($this->index[$index_array[$field_value] ?? null]) ? new Country(...$this->index[$index_array[$field_value]]) : null;
		}

		foreach ($this->index as $attributes)
		{
			if (!isset($attributes[$field_name]))
			{
				throw new Exception('Invalid field name being searched.');
			}

			if ($attributes[$field_name] === $field_value)
			{
				return new Country(...$attributes);
			}
		}
		return null;
	}

	private function getIndex(string $field_name) : ?array
	{
		if ($this->index === null)
		{
			$this->buildIndex();
		}

		switch ($field_name)
		{
			case 'alpha2':
			return $this->alpha2_index;

			case 'alpha3':
			return $this->alpha3_index;

			case 'm49_code':
			return $this->m49_index;

			case 'continent':
			return $this->continents_index;
		}

		return null;
	}

	private function buildIndex() : void
	{
		$this->index = [];
		foreach ($this->driver->getAllContents() as $key => $content)
		{
			$this->index[$key] = $content;
			$this->alpha2_index[strtolower($content['alpha2'])] = $key;
			$this->alpha3_index[strtolower($content['alpha3'])] = $key;
			$this->m49_index[strtolower($content['m49_code'])] = $key;

			$lowered_continent = strtolower($content['continent']);
			if (!isset($this->continents_index[$lowered_continent]))
			{
				$this->continents_index[$lowered_continent] = [];
			}

			$this->continents_index[$lowered_continent][] = $key;
		}
	}
}
