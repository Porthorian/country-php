<?php declare(strict_types=1);

namespace Porthorian\IsoCountry;

interface DatabaseDriverInterface
{
	public function getAllContents() : array;
}
