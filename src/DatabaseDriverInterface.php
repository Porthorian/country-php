<?php declare(strict_types=1);

namespace Porthorian\Utility\Country;

interface DatabaseDriverInterface
{
	public function getAllContents() : array;
}
