<?php require_once("user.php");
	require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Zadania</title>
	<style>
	body {
		font-family: 'Noto Sans', sans-serif;
	}
	pre {
		font-size: 12px;
		background-color: #cecece;
		overflow:auto;
	}
	</style>
</head>
<body>
	<h2>Zadanie 1</h2>
	<p>Stwórz odpowiednią klasę 'User' a także metodę/metody, dzięki której/którym
		pobierzesz dane użytkownika z adresu:
		https://jsonplaceholder.typicode.com/users/1</p>
	<h3>Rozwiązanie:</h3>
	<p>Poniżej znajduje się tablica z pobranymi danymi z powyższego linku.</p>
	<pre>
	<?php
		$user = new User(1);
		var_dump($user);
	?>
	</pre>
	<h2>Zadanie 2</h2>
	<p>Utwórz metodę 'getDomain', dzięki której będziemy mogli pobierać z obiektu
	użytkownika tylko domenę z adresu email.</p>
	<h3>Rozwiązanie:</h3>
	<p>Poniżej znajduje się domena z adresu email użytkownika o id = 1.</p>
	<pre>
		<?php var_dump($user->getDomain($user->user_data['email']));?>
	</pre>
	<h2>Zadanie 3</h2>
	<p>Utwórz funkcję 'getPersonData’, która wyświetli dane osoby w formacie
	JSON, wygeneruje dla niego kod QR (jako dane przyjmij wygenerowany JSON).
	<h3>Rozwiązanie:</h3>
	<p>Poniżej znajdują się dane użytkownika w formacie JSON. Kod QR wygenerowany przy użyciu Google Charts. (https://developers.google.com/chart/infographics/docs/qr_codes?csw=1)</p>
	<pre>
		<?php echo $user->getPersonData(); ?>
	</pre>
	Kod QR:
	<?php $user->generateQR(); ?>
	<h2>Zadanie 4</h2>
	<p>Utwórz programowalnie bazę danych MySql i zapisz wyniki tj. email i liczbę
	wystąpień w tablicy – jeśli domena występuje więcej niż raz w drugim polu
	utwórz licznik i go zwiększ.</p>
	<pre>
	<?php 
		//utworz instancje klasy ze wszystkimi uzytkownikami
		$users = new User();

		$domains = array();

		//dodaj i zlicz wystąpienia takich samych domen w mailach uzytkowników
		foreach($users->user_data as $u) {
			$domain = $user->getDomain($u['email']);
			if(array_key_exists($domain, $domains)){
				$domains[$domain] = $domains[$domain] + 1;
			} else {
				$domains += array($domain => 1);
			}
		}

		var_dump($domains);
		$db = new Database($domains);
	?>
	</pre>
	<br>
	<h4>Wykonanie: Marcel Milczarek dla Smartbees w ramach procesu rekrutacyjnego. 17.03.2021</h4>
	<h5>Wszystkie powyższe zadania działają przy wykorzystaniu php w wersji 8.0.3</h5>
</body>
</html>