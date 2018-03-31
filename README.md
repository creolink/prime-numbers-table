#Objective#

Write a program that prints out a multiplication table of the first 10 prime numbers.
The program must run from the command line and print one table to STDOUT.
The first row and column of the table should have the 10 primes, with each cell containing the product of the primes for the corresponding row and column.

**Notes**

• Consider complexity. How fast does your code run? How does it scale?

• Consider cases where we want N primes.

• Do not use the Prime class from stdlib (write your own code).

• Write tests. Try to demonstrate TDD/BDD.

--------------

#Installation#

```php composer.phar install```

By default you need 'php-gmp' / 'php7.0-gmp' extension, but you can disable this in composer.json file.
This library works also without this extension.

Please look at: AppBundle\Factory\NextPrimeNumberFactory

--------------

#Configuration#

In app/parameters.yml you need to configure 'prime_numbers_presenter' parameter.
Parameter is used to presenter factory.

Possible values ***'table'*** or ***'list'***.

--------------

#Usage#

```php bin/console app:prime-table --quantity=10```

Possible argument:

 ***start***: First number for prime number generator

 example:
  To get 10 prime numbers starting from 20 use
  ```php bin/console app:prime-table --quantity=10 20```


Possible options:

 ***--quantity***: Quantity of numbers for prime number generator.

 ***--last***: Last prime number for multiplication.
   '--last' option breaks prime number generator on the biggest number before chosen value

example:
  To get numbers ending with 40 use
  ```php bin/console app:prime-table --last=40```

Please use '--help' for more informations.

--------------

# Tests / Code style #

Tests:
```
make test
```

PHPUnit:
```
make phpunit
```

Behat:
```
make behat
```

PHPCS:
```
make phpcs
```

--------------

# Results - table #

```
php bin/console app:prime-table --quantity=10
```

```
+----+----+----+-----+-----+-----+-----+-----+-----+-----+-----+
|    | 2  | 3  | 5   | 7   | 11  | 13  | 17  | 19  | 23  | 29  |
+----+----+----+-----+-----+-----+-----+-----+-----+-----+-----+
| 2  | 4  | 6  | 10  | 14  | 22  | 26  | 34  | 38  | 46  | 58  |
| 3  | 6  | 9  | 15  | 21  | 33  | 39  | 51  | 57  | 69  | 87  |
| 5  | 10 | 15 | 25  | 35  | 55  | 65  | 85  | 95  | 115 | 145 |
| 7  | 14 | 21 | 35  | 49  | 77  | 91  | 119 | 133 | 161 | 203 |
| 11 | 22 | 33 | 55  | 77  | 121 | 143 | 187 | 209 | 253 | 319 |
| 13 | 26 | 39 | 65  | 91  | 143 | 169 | 221 | 247 | 299 | 377 |
| 17 | 34 | 51 | 85  | 119 | 187 | 221 | 289 | 323 | 391 | 493 |
| 19 | 38 | 57 | 95  | 133 | 209 | 247 | 323 | 361 | 437 | 551 |
| 23 | 46 | 69 | 115 | 161 | 253 | 299 | 391 | 437 | 529 | 667 |
| 29 | 58 | 87 | 145 | 203 | 319 | 377 | 493 | 551 | 667 | 841 |
+----+----+----+-----+-----+-----+-----+-----+-----+-----+-----+
```

--------------

# Results - list #

```
php bin/console app:prime-table --quantity=3
```

```
Numbers: 2 * 2, multiplication: 4
Numbers: 2 * 3, multiplication: 6
Numbers: 2 * 5, multiplication: 10
Numbers: 3 * 2, multiplication: 6
Numbers: 3 * 3, multiplication: 9
Numbers: 3 * 5, multiplication: 15
Numbers: 5 * 2, multiplication: 10
Numbers: 5 * 3, multiplication: 15
Numbers: 5 * 5, multiplication: 25

```

