# PHP universal identifiers
## Generate unique identifiers for your PHP primitives, arrays and objects

This tiny composer package provides a `universal_identifier()` global function, which can be used to generate sha256 identifiers for values and arrays/objects.
These identifiers can be used to easily compare configurations both in code and in database queries, without having to manually sort and compare every items and sub-items inside an array or an object.

## Getting started
To get started, simply require the package via Composer:

```
composer require emileperron/universal-identifier
```

Once that's done, you can start using the `universal_identifier` function in your project. Here's a very brief overview of the library's usage and functionalities:

**Usage with primitives:**
```php
<?php
// This will output the string's identifier: "de719c460cc38eddfb39fe286882a042be247e5d091fd8e4aed01daf9d3a5513"
echo universal_identifier("my string");

// Same thing goes for all primitives;
echo universal_identifier(150); // "7d3c18bc20c238917421291209ad0d17c83be19e4c214abcf09160af2949f591"
echo universal_identifier(0.55f); // "1c3d577cd8a09945100ac46c061835db1691907bc40f01931d5083ec7fb69def"
// etc...
```

**Usage with arrays:**
```php
<?php
$yourArray = [
	"foo" => "bar",
	"foos" => [
		"bar1", 
		"bar2"
	],
	"anotherKey" => "value",
];

// This will output the array's identifier: "7ef0675c80dd9ae9f9fed4a786f8c0641d14a646cc580de1690f62a803e54f89"
echo universal_identifier($yourArray);

// Even if you change the order of the array's keys, the identifier will remain the same (this does not apply to numerically-indexed arrays, where the order actually matters).
// Ex.:
ksort($yourArray);
// This will still output the same identifier: "7ef0675c80dd9ae9f9fed4a786f8c0641d14a646cc580de1690f62a803e54f89"
echo universal_identifier($yourArray);
```

## Contributing
Feel free to submit pull requests on [the GitHub repository](https://github.com/EmilePerron/array-identifier) if you want to add functionalities or suggest improvements to this library. I will look them over and merge them as soon as possible.

You can also submit issues if you run into problems but don't have time to implement a fix.

## Supporting
Finally, if you use the library and would like to support me, here are the ways you can do that:

- Saying thanks directly on Twitter: [@cunrakes](https://twitter.com/cunrakes)
- Giving this repository a star [on GitHub](https://github.com/EmilePerron/array-identifier)
- Taking a look at my other projects [on my website](https://www.emileperron.com)
- [Buying me a cup of tea](https://www.buymeacoffee.com/EmilePerron) ☕️
