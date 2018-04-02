<?Php
function convertMemory($size){
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function badCharHeuristic($str, $size, &$badchar)
{
	for ($i = 0; $i < 256; $i++)
		$badchar[$i] = -1;

	for ($i = 0; $i < $size; $i++)
		$badchar[ord($str[$i])] = $i;
}

function BoyerMoore($str, $pat) {

	//before
    $memory1 = memory_get_usage();
    $time1 = microtime_float();

	$m = strlen($pat);
	$n = strlen($str);
	$i = 0;

	badCharHeuristic($pat, $m, $badchar);

	$s = 0;
	while ($s <= ($n - $m))
	{
		$j = $m - 1;

		while ($j >= 0 && $pat[$j] == $str[$s + $j])
			$j--;

		if ($j < 0)
		{
			$arr[$i++] = $s;
			$s += ($s + $m < $n) ? $m - $badchar[ord($str[$s + $m])] : 1;

		}
		else
			$s += max(1, $j - $badchar[ord($str[$s + $j])]);
	}

	for ($j = 0; $j < $i; $j++)
	{
		$result[$j] = $arr[$j];
	}

	//after
    $time2 = microtime_float();
    $memory2 = memory_get_usage();

    $allTime = $time2 - $time1;
    $miliseconds = round($allTime * 1000);

    $allMemory = convertMemory($memory2 - $memory1);

    echo "<p>". "Find it , the position is $result[0]" . "<p>\n";
    echo "<p>". "Time is $allTime" . " seconds <p>\n";
    echo "Memory is $allMemory";

	return $result;
}

$text = 'pov3G9WqkFeyPIsRyN63q6ttoDGZtrGYhM7hfsJDeeb0ZBOnk3EZB2eCbdldLUej3aA508W9RCSB426ytGf9JldYoSewuKOPNLCJqjtTKs5p7B9r1gg3rqP3oTxnriHWyf0fhUFg0UwJ4eS0ha3SX5FHHJhJTUxxgqniRgvrPUGiQ8S9dqIMuM5ycDmfTbKs2WOb3YcNto4MrV3brFixZk3v7qVW1rnIOqJ5E3KP873hoVXToVdR6972f6i1TqwDG1uOwMvfKEJLjSXGecHu4O3UulUW76AdQQjU2BII1ImIiKPW11P082m9lIlnAx1WPwmsQtQjGBSBCCZwuMF5Wj0DXJEzbfXWhn78EfVSlqOsFhIR5KFMqUARzTNQ7Mquy93HH8q2b8GIbzBn3CS3lwVwyViqEr1yXCWqC0UXP0PbJ1NWAg1UmTFKd8g1Lo6GymX31SqyFC3Uv74hbwPUv4XIUAdl79zHSRa9EM8VQ8IszogdQdIBZqAZFvmyDKThGDdbEMZV6Eac98Xi5DSjRNnZzW1BISwXQzWbVaelV0hititndBlcWo5tJXyOYaBW2jSusbambangMbTAPeQeCbKfrNHyEW4ggYEwTArJaF23uGKGM0c5InS7CQyJ8WmL95EQnuZU9UrB51q2Y3admTRdyPyMJ4m5H4pXQzFEADHzbovvpLZxbIDdLCG6mtUngxpJeATGGCXrB6bb9rZle0kph9bIdAFjp7GwGkWL1d0xruwxC4JSBLZLqt0kXOqb6HZF7ELcdrN0brgKA6ikvY6b5B5kDLGfYLseS1D2dj1JA0MHVsSBlJIXFXqxwfVn85EZtqm9pKbheAp7lcEcfwcoCwgbyEqKA87r6W54r5MUqexnWs64wkOHlgghYBD872qsd1ma7KH96VAyghlfnghb5fZ3NJN9gZ94qtGVwpr8vCSF90Tb9dMQudt2ACzEXjfks5p69Bg5HCBhuGILQzriqDp85ZSNuyCJy4bX7VeNXkD';

$pattern = 'bambang';

BoyerMoore($text, $pattern);


?>