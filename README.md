# Assert

Assert is a simple set of assertions to help validate inputs, results, and
business logic. Inspired by the thoughts of [TigerBeetle](https://tigerbeetle.com/blog/2023-12-27-it-takes-two-to-contract) 
and [NASA’s Power of 10 Rules for Safety-Critical Code](https://en.wikipedia.org/wiki/The_Power_of_10:_Rules_for_Developing_Safety-Critical_Code),
this library aims to painfully enforce the validity in order to fail without the
ability to subvert the issue.

## Why not just `assert()`?
`assert()` is a (*deprecated as of 8.3*) built-in PHP method, designed for
debugging, that will either throw an exception or omit a warning. `assert-php`
is designed to throw exceptions only and to purposefully fail your production code
in the cases of invalid expectations.

## Usage
Usage of this library is simple: call one of the methods from the `Assert` class
to validate your expectations. Do not attempt to try/catch these assertions, and
instead, allow your program to truly fail in these cases. Using the `that()` 
method provides the best readability in my opinion.

```php
// assert that the size of the $records array is greater than zero
Assert::that('array' === gettype($records));
Assert::that(sizeof($records) > 0);
```

### Examples

```php
public function fill(array $values): array
{
    Assert::that(sizeof($value) > 0);
    Assert::that(sizeof($values) === sizeof(array_filter($values, fn ($value) => is_int($value))));

    // logic can now perform on an array with values of integers
}

public function save(Contact[] $contacts): int
{
    foreach ($contacts as $contact) {
        Assert::that($contact->isValid());
        Assert::that(null === $contact->id);
    }

    // logic can now perform on an array of valid Contacts without a record id
}
```

### All Assertions
```php
<?php

use Jlaswell/Assert/Assert;

Assert::that('this' !== 'that');
Assert::isTrue(true);
Assert::isFalse(false);

```

