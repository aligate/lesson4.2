<?php
header("Content-Type: text/html; charset=utf-8");

try
{
	$pdo = new PDO('mysql:host=localhost;dbname=global', 'root', '');
}
catch (PDOException $e)
{
	
	echo "Невозможно подключиться к Базе данных";
}


if(strpos( $_SERVER['REQUEST_URI'], '?' ) === false ){
	
$array = [];

if( $_POST['save'] )
	
	{
		// Добавление нового задания
		$desc = trim(addslashes($_POST['description']));
		$sql = "INSERT INTO tasks (description) VALUES (?)";
		$stmt = $pdo ->prepare($sql);
		$stmt->bindParam(1, $desc, PDO::PARAM_STR);
		$stmt->execute();
		header('Location:'.$_SERVER['PHP_SELF']);
	
		
	} 
elseif($_POST['change'])
	{
		//Редактирование задания
		$desc = trim(addslashes($_POST['description']));
		$id = $_POST['id'];
		$sql = "UPDATE tasks SET description = ? WHERE id = ? ";
		$stmt = $pdo ->prepare($sql);
		$stmt->bindParam(1, $desc, PDO::PARAM_STR);
		$stmt->bindParam(2, $id, PDO::PARAM_INT);
		$stmt->execute();
		header('Location:'.$_SERVER['PHP_SELF']);
	}
elseif($_POST['sort'])
	{
		// Сортировка заданий по заданным полям
		$data = $_POST['sort_by'];
		$query = "SELECT * FROM tasks ORDER BY {$data}";
		$stmt = $pdo->query($query);
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Подключаем файл с HTML шаблоном view1.php
		include_once 'view1.php';
		
		
	}
else
	{
		// Вывод заданий по умолчанию
		$query = "SELECT * FROM tasks";
		$stmt = $pdo->query($query);
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Подключаем файл с HTML шаблоном view1.php
		include_once 'view1.php';
		
	}
	
}	
		
	$action = trim(addslashes($_GET['action']));
	$id = trim(addslashes($_GET['id']));
	
	switch($action)
	{
		
		case "delete": 
						$sql = "DELETE FROM tasks WHERE id = :id";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['id' => $id ]);
						header('Location:'.$_SERVER['PHP_SELF']);
						break;
		case "done":
						$sql = "UPDATE tasks SET is_done = 1 WHERE id = :id";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['id' => $id ]);
						header('Location:'.$_SERVER['PHP_SELF']);
						break;
		case "edit":	
						$sql = "SELECT id, description, is_done FROM tasks WHERE id = :id";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['id' => $id ]);
						$array = $stmt->fetch(PDO::FETCH_ASSOC);
						// Подключаем файл с HTML шаблоном view2.php
						include_once 'view2.php';
						break;
		case "cancel":
						header('Location:'.$_SERVER['PHP_SELF']);
						break;
		
	}

?>


