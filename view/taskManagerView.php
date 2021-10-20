<?php 
    $title = "Gestionnaire de tâches";
    ob_start();
?>

<div class="todoList">
    <p class="user"><?= "Bonjour ".$_SESSION['first_name']." ".$_SESSION['last_name'] ?></p>
    <h1 class="title">Todo List</h1>
    <div class="taskList">
        <?php
            while($task = $request->fetch()) {
        ?>
                <div id="<?= $task['id'] ?>" class="task">
                    <p class="label"><?= $task['label'] ?></p>
                    <i class="far fa-edit"></i>
                    <i class="fas fa-trash-alt"></i>
                </div>
        <?php
            }
        ?>
    </div>
    <form class="todoForm" action="index.php?page=todolist" method="POST">
        <input type="text" placeholder="Ajouter une nouvelle tâche" class="addTask" name="task">
    </form>
    <a href="/deconnexion"><button class="deco">Deconnexion</button></a>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');
?>          