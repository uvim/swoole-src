--TEST--
swoole_library/array/walk: usage variations - 'input' array with subarray
--SKIPIF--
<?php require __DIR__ . '/../../../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../../../include/bootstrap.php';

Swoole\Runtime::enableCoroutine();

/* Prototype  : bool array_walk(array $input, string $funcname [, mixed $userdata])
 * Description: Apply a user function to every member of an array
 * Source code: ext/standard/array.c
*/

/*
 * Testing array_walk() with an array having subarrays as elements
*/

echo "*** Testing array_walk() : array with subarray ***\n";

// callback function
/* Prototype : callback(mixed $value, mixed $key)
 * Parameters : $value - values in given 'input' array
 *              $key - keys in given 'input' array
 * Description : It prints the count of an array elements, passed as argument
 */
function callback($value, $key)
{
    // dump the arguments to check that they are passed
    // with proper type
    var_dump($key);  // key
    var_dump($value); // value
    echo "\n"; // new line to separate the output between each element
}

$input = [
    [],
    [1],
    [1, 2, 3],
    ["Mango", "Orange"],
    [[1, 2, 3]]
];

var_dump(array_walk($input, "callback"));

echo "Done"
?>
--EXPECT--
*** Testing array_walk() : array with subarray ***
int(0)
array(0) {
}

int(1)
array(1) {
  [0]=>
  int(1)
}

int(2)
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}

int(3)
array(2) {
  [0]=>
  string(5) "Mango"
  [1]=>
  string(6) "Orange"
}

int(4)
array(1) {
  [0]=>
  array(3) {
    [0]=>
    int(1)
    [1]=>
    int(2)
    [2]=>
    int(3)
  }
}

bool(true)
Done
