<?php

require_once 'db.php';

$contents = nl2br('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend risus id lorem aliquam eleifend. Integer ex lorem, egestas eget neque a, tincidunt sagittis elit. Praesent posuere porttitor elit, in mattis urna molestie eget. In congue aliquet sapien, non convallis eros facilisis bibendum. Pellentesque semper purus sed leo ornare feugiat. Duis quis vestibulum neque. Cras imperdiet egestas purus, et sodales metus lacinia eget. Morbi sagittis mollis ante id molestie. In sit amet fermentum ligula, sed efficitur ligula. Ut congue risus ac justo sodales lacinia. Aliquam ac orci quis leo accumsan condimentum.

Donec malesuada ligula ac porta auctor. Praesent convallis tortor magna, dignissim gravida nisl luctus nec. Vestibulum sit amet aliquet enim. Cras vel urna mi. Duis ut purus placerat ante egestas vestibulum a vel ipsum. Suspendisse congue dui risus, in tincidunt augue elementum vitae. Nunc mauris leo, efficitur sit amet purus ac, pulvinar vulputate nisl.

Aliquam erat volutpat. Nunc erat urna, luctus vel convallis ut, pharetra sed lorem. Donec imperdiet tincidunt eros sit amet tincidunt. Sed bibendum, massa eu posuere gravida, lorem enim varius quam, id semper leo diam vel justo. Nullam ut maximus nisl, et vehicula mauris. In mollis nisl ligula, in volutpat lectus sodales quis. Etiam aliquet sem vitae arcu molestie, fermentum tempus tortor accumsan. Duis aliquam erat dictum, pretium mi eget, egestas risus. Vestibulum metus nulla, tincidunt sed orci eget, pulvinar ornare dolor.

Vivamus gravida, odio a condimentum accumsan, odio felis fringilla ex, eu feugiat mauris lorem ac sem. Donec felis mauris, luctus et luctus vel, consectetur auctor enim. Cras non ornare sem. Donec in felis massa. Morbi lectus eros, tincidunt sed eleifend vel, congue sit amet mauris. Integer varius tortor eget mauris consectetur, a pharetra ligula pellentesque. Nullam semper porta odio sed volutpat. Cras tristique congue dui. Pellentesque tempor, mauris non convallis lacinia, augue mi posuere nisl, sed laoreet mi lacus vel erat. Aliquam tincidunt vel velit ut pellentesque. Cras imperdiet mauris at ipsum feugiat feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ullamcorper pellentesque tellus a ornare. Pellentesque quis arcu accumsan, pellentesque nisl in, varius erat. Interdum et malesuada fames ac ante ipsum primis in faucibus.

Aliquam sagittis elit eu nibh eleifend viverra. Maecenas fermentum nisl aliquet orci congue, ut dictum ante dignissim. Donec mollis est tortor, ut mattis nisi faucibus vel. Nunc eget faucibus tortor. Ut porttitor mi quam, nec auctor enim ultrices eget. Etiam mattis in justo a tincidunt. Sed dictum, sem non hendrerit congue, turpis eros mattis sapien, at laoreet massa orci at orci. Fusce ac justo eu justo aliquam maximus nec et ex. Vestibulum id fermentum diam, eget laoreet ligula. Donec venenatis lectus non massa vestibulum ultrices. Pellentesque vel cursus felis. Donec volutpat nisl vitae lectus elementum blandit. Cras iaculis accumsan efficitur. Nulla consequat leo nec interdum semper. Sed posuere interdum faucibus. Nullam ullamcorper mauris non euismod volutpat.

Nullam est quam, gravida nec metus ut, imperdiet placerat nunc. Etiam in augue in diam aliquam rutrum sed sit amet mauris. Morbi pellentesque nibh non dapibus ultricies. Vestibulum vel elit orci. Nam non lorem lorem. Fusce erat tellus, ornare eu leo sit amet, ornare malesuada tortor. Pellentesque at blandit lacus, nec auctor lorem. Sed rutrum molestie neque et sollicitudin. Vestibulum eget bibendum dui. Fusce ut mattis metus. Pellentesque at maximus turpis, eu hendrerit nulla. Aenean malesuada nisi est, non posuere est blandit ac. Nullam ante magna, rhoncus eget dictum a, laoreet vitae felis. Sed mollis faucibus velit, vel finibus magna varius at. Vivamus convallis tempus justo, vitae ultricies neque lobortis eget.');

$contents = explode('<br />'.PHP_EOL.'<br />'.PHP_EOL, $contents);

$articles = array();

$count_contents = count($contents);

for ($i = 0; $i < $count_contents; $i++) {

	$rand_year = rand(2014, 2015);
	$rand_month = sprintf('%1$02d', $rand_year == 2015 ? rand(1, 6) : rand(7, 12));
	$rand_day = sprintf('%1$02d', rand(1, 29));
	$rand_hour = sprintf('%1$02d', rand(0, 23));
	$rand_minute = sprintf('%1$02d', rand(0, 59));
	$rand_second = sprintf('%1$02d', rand(0, 59));

	$rand_date = $rand_year.'-'.$rand_month.'-'.$rand_day.' '.$rand_hour.':'.$rand_minute.':'.$rand_second;

	//echo $rand_date.'<br>';


	$article_text = str_replace(';', '.', $contents[$i]);
	$first_space_pos = strpos($article_text, ' ');
	$first_point_pos = strpos($article_text, '.');

	$article_name = substr($article_text, 0, $first_space_pos);
	$article_title = substr($article_text, $first_space_pos + 1, $first_point_pos - $first_space_pos);
	$article_content = substr($article_text, $first_point_pos + 2);

	//echo '<span style="color: red">'.$article_author.'</span><br>';
	//echo '<span style="color: blue">'.$article_title.'</span><br>';
	//echo '<span style="color: green">'.$article_text.'</span><br><br>';

	$articles[] = array(
		'name' => ucfirst($article_name),
		'content' => ucfirst(wordwrap($article_content, 100, PHP_EOL.PHP_EOL)),
		'date' => $rand_date,
	);
}


$query = $db->prepare('INSERT INTO article (name, content, creation_date) VALUES (:name, :content, :creation_date)');
$query->bindParam(':name', $article_name, PDO::PARAM_STR);
$query->bindParam(':content', $article_content, PDO::PARAM_STR);
$query->bindParam(':creation_date', $article_date, PDO::PARAM_STR);

foreach($articles as $key => $article) {

	$article_name = $article['name'];
	$article_content = $article['content'];
	$article_date = $article['date'];

	$query->execute();
}



?>