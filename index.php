<?php include 'header.php'; ?>

<?php
require 'varDump.php';
$list = file_get_contents('list.json');
$todos = json_decode($list, true);


?>
<main>
    <div class="container mt-3">
        <form action="new_todo.php" method="post" class="card">
            <h2 class="card-header">To Do List</h2>
            <div class="card-body">
                <div class="form-group" style="display:flex; gap:10px">
                    <input type="text" name="item" class="form-control" placeholder="Enter your toDo here😎">
                    <button type="submit" class="btn btn-info">Send</button>
                </div>
            </div>
            <div class="card-footer">
                <?php foreach ($todos as $todoName => $item): ?>
                    <ul style="list-style:none;">
                        <li>
                            <form action="change_checkbox.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="todo_name" value="<?php echo $todoName; ?>">
                                <input type="checkbox" name="" id="" <?php echo $item['completed'] ? "checked" : ''; ?>>
                            </form>
                            <?php echo $todoName . " => " . array_values($item)[0]; ?>
                            <form action="delete.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="todo_name" value="<?php echo $todoName; ?>">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </li>
                    </ul>
                <?php endforeach; ?>

            </div>
        </form>
    </div>
</main>

<script>
    const checkboxes = document.querySelectorAll('input[type=checkbox]');
    checkboxes.forEach(ch => {
        ch.onclick = function () {
            this.parentNode.submit();
        }
    })
</script>
<?php include 'footer.php'; ?>