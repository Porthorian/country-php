<?php declare(strict_types=1);

namespace Porthorian\IsoCountry;

use Iterator;
use Countable;

class Countries implements Iterator, Countable
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

	public function getByContinent(string $field_value) : ?array
	{
		$continent = $this->getIndex('continent')[strtoupper($field_value)] ?? null;
		if ($continent === null)
		{
			try
			{
				$continent = $this->getIndex('continent')[CountryFactory::getIsoContinentCode($field_value)] ?? null;
			}
			catch (CountryException)
			{
				return null;
			}
		}

		$countries = [];
		foreach ($continent as $country_index)
		{
			$countries[] = new Country(...$this->index[$country_index]);
		}
		return $countries;
	}

	public function findAll(string $field_name, string $field_value) : array
	{
		if ($this->index === null)
		{
			$this->buildIndex();
		}

		$field_name = strtolower($field_name);
		$countries = [];
		foreach ($this->index as $attributes)
		{
			if (!isset($attributes[$field_name]))
			{
				throw new CountryException('Invalid field name being searched.');
			}

			if (stripos($attributes[$field_name], $field_value) !== false)
			{
				$countries[] = new Country(...$attributes);
			}
		}

		return $countries;
	}

	protected function find(string $field_name, string $field_value) : ?Country
	{
		$index_array = $this->getIndex($field_name);

		return isset($this->index[$index_array[$field_value] ?? null]) ? new Country(...$this->index[$index_array[$field_value]]) : null;
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

			$continent_code = CountryFactory::getIsoContinentCode($content['continent']);
			if (!isset($this->continents_index[$continent_code]))
			{
				$this->continents_index[$continent_code] = [];
			}

			$this->continents_index[$continent_code][] = $key;
		}
	}

	////
	// Iterator Interface
	////

	public function current() : Country
	{
		return new Country(...$this->index[$this->cursor]);
	}

	public function key() : int
	{
		return $this->cursor;
	}

	public function next() : void
	{
		$this->cursor++;
	}

	public function valid() : bool
	{
		return $this->cursor < $this->count();
	}

	public function rewind() : void
	{
		if ($this->index === null)
		{
			$this->buildIndex();
		}

		$this->cursor = 0;
	}

	////
	// Countable Interface
	////

	public function count() : int
	{
		if ($this->index === null)
		{
			$this->buildIndex();
		}

		return count($this->index);
	}
}
