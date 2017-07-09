![build](https://travis-ci.org/elkaadka/Specification.svg?branch=master)

# Specification design pattern

Implementation of  the "Specification" design pattern.
 
The Goal of this pattern is to have separate classes of logic in order to do
condition composition without rewriting and maintaining the conditions at different places.

## How to 

All the classes should extend Kanel/Specification (abstract class) 

```
$isAvailable = new isProductAvailable(); 
$isShippable = new isProductShippable();
$isOnSale = new isProductOnSale();
```

Then perform a composition of specification

```
$specification = $isAvailable->and($isOnSale)->xor($isShippable);

if ($specification->isSatisfiedBy($product)) {

}
```

## Available operators :

- and
- or
- xor
- not


If you look for another implementation of  the specification design pattern look at <b>kanel/specifications2</b>