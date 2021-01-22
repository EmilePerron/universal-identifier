<?php

/**
 * Generates a unique sha256 identifier for a primitive value, array or object.
 * For associative arrays, the original order of the keys is not taken into account.
 * 
 * @param mixed $source
 * @return string
 */
function universal_identifier($source): string
{
	if (is_array($source) || is_object($source)) {
		$sortedArray = (array)$source;
		ksort($sortedArray);
	
		foreach ($sortedArray as $key => $value) {
			if (is_array($value) || is_object($value)) {
				$sortedArray[$key] = universal_identifier($value);
			} else if (!is_numeric($value) && !is_string($value)) {
				$sortedArray[$key] = serialize($value);
			}
		}
		
		$identifier = hash('sha256', serialize($sortedArray));
	} else {
		$identifier = hash('sha256', serialize($source));
	}

	return $identifier;
}