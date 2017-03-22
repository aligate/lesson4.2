<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Список дел</title>
<style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    
    table th {
        background: #eee;
    }
</style>

<h1>Список дел на сегодня</h1>
<div style="float: left">
    <form action= "tasks.php" method="POST">
        <input type="text" name="description" placeholder="Описание задачи" value="" />
        <input type="submit" name="save" value="Добавить" />
    </form>
</div>
<div style="float: left; margin-left: 20px;">
    <form method="POST">
        <label for="sort">Сортировать по:</label>
        <select name="sort_by">
            <option value="date_added">Дате добавления</option>
            <option value="is_done">Статусу</option>
            <option value="description">Описанию</option>
        </select>
        <input type="submit" name="sort" value="Отсортировать" />
    </form>
</div>
<div style="clear: both"></div>

<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
    </tr>
	<?php foreach( $array as $arr =>$item):?>
<tr>
  <td><b><?= htmlspecialchars($item['description']); ?></b></td>
  <td><?= $item['date_added']; ?></td>
	<?php if($item['is_done'] == 1): ?>
  <td><span style='color: green;'>Выполнено</span></td>
	<?php else : ?>
	<td><span style='color: orange;'>В процессе</span></td>
	<?php endif; ?>
  <td>
        <a href='?id=<?= $item['id']; ?>&action=edit'>Изменить</a>
        <a href='?id=<?= $item['id']; ?>&action=done'>Выполнить</a>
        <a href='?id=<?= $item['id']; ?>&action=delete'>Удалить</a>
    </td>
</tr>
	<?php endforeach; ?>
</table>
</body>
</html>