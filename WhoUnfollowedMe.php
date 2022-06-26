<?php

/**
 * @author: NhanAZ
 * @version: 1.0
 * @license: MIT
 */

declare(strict_types=1);

echo PHP_EOL . "Enter your Github username: ";
fscanf(STDIN, "%s", $userName);

if (!file_exists($userName . ".txt")) {
	$file = fopen($userName . ".txt", "w");
	$followers = getFollowers($userName);
	fwrite($file, implode(', ', $followers));
	fclose($file);
	echo PHP_EOL . "Your follower list has now been saved. Don't forget to check back often to see if anybody goes missing." . PHP_EOL . PHP_EOL;
	echo "Your current followers are: " . implode(', ', $followers) . PHP_EOL . PHP_EOL;
} else {
	$file = fopen($userName . ".txt", "r");
	$followers = fread($file, filesize($userName . ".txt"));
	fclose($file);
	echo  PHP_EOL . "Your followers are: " . $followers . PHP_EOL;
	$currentFollowers = getFollowers($userName);
	$newFollowers = array_diff($currentFollowers, explode(', ', $followers));
	if (count($newFollowers) > 0) {
		echo PHP_EOL . "New followers: " . implode(', ', $newFollowers) . PHP_EOL;
	} else {
		echo PHP_EOL . "No new followers." . PHP_EOL;
	}
	$unfollowers = array_diff(explode(', ', $followers), $currentFollowers);
	if (count($unfollowers) > 0) {
		echo PHP_EOL . "Unfollowers: " . implode(', ', $unfollowers) . PHP_EOL;
		// remove followers in the file and  update current followers to new followers file
		$file = fopen($userName . ".txt", "w");
		fwrite($file, implode(', ', $currentFollowers));
		fclose($file);
		echo PHP_EOL . "Your follower list has been updated!" . PHP_EOL . PHP_EOL;
	} else {
		echo PHP_EOL . "No unfollowers." . PHP_EOL . PHP_EOL;
	}
}

function getFollowers(string $userName): array {
	$fileName = "https://api.github.com/users/" . $userName . "/followers";
	$useIncludePath = false;
	$context = stream_context_create(array("http" => array(
		"header" => "User-Agent:Mozilla/5.0 (Linux; {Android Version}; {Build Tag etc.}) AppleWebKit/{WebKit Rev} (KHTML, like Gecko) Chrome/{Chrome Rev} Mobile Safari/{WebKit Rev}"
	)));
	$getFollowersInfo = json_decode(file_get_contents($fileName, $useIncludePath, $context));
	$followers = [];
	foreach ($getFollowersInfo as $follower) {
		$followers[] = $follower->login;
	}
	return $followers;
}
