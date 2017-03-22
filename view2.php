<html>
  <head>
    <meta charset="utf-8">
    <title>Редактирование</title>
  </head>
  <body>
	<h2>Редактирование заданий</h2>

   <form action = "tasks.php" method = 'POST'>
		<input type ='text' name='description' size = '50' value ='<?= htmlspecialchars($array['description']); ?>' >
		<input type ='hidden' name='id' value ='<?= $array['id']; ?>' >
		<input type="submit" name="change" value="Изменить" />
	</form>
	
	<p style ="color: blue; font-size:20px;"><a href="?action=cancel">Или вернуться к списку заданий</p>
  </body>
</html>
