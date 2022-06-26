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
	echo "Your current followers are (" .  count($followers) . "): " . implode(', ', $followers) . PHP_EOL . PHP_EOL;
} else {
	$file = fopen($userName . ".txt", "r");
	$oldFollowers = explode(', ', fread($file, filesize($userName . ".txt")));
	fclose($file);
	$newFollowers = getFollowers($userName);
	$unfollowers = array_diff($oldFollowers, $newFollowers);
	$followers = array_diff($newFollowers, $oldFollowers);
	$file = fopen($userName . ".txt", "w");
	fwrite($file, implode(', ', $newFollowers));
	fclose($file);
	echo PHP_EOL . "Your current followers are (" .  count($newFollowers) . "): " . implode(', ', $newFollowers) . PHP_EOL . PHP_EOL;
	echo "You have been followed by (" .  count($followers) . "): " . implode(', ', $followers) .  PHP_EOL . PHP_EOL;
	echo "You have been unfollowed by (" .  count($unfollowers) . "): " . implode(', ', $unfollowers) . PHP_EOL . PHP_EOL;
	updateCache($userName);
}

function updateCache(string $userName, bool $notification = true): void {
	$file = fopen($userName . ".txt", "w");
	$followers = getFollowers($userName);
	fwrite($file, implode(', ', $followers));
	fclose($file);
	if ($notification) {
		echo PHP_EOL . "Your follower list has been updated!" . PHP_EOL . PHP_EOL;
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
