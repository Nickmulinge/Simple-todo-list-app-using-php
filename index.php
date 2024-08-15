<?php
include 'db.php';

// Add a task
if (isset($_POST['add'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    $conn->query($sql);
    header('location: index.php');
}

// Delete a task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
    header('location: index.php');
}

// Edit a task
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $sql = "UPDATE tasks SET task='$task' WHERE id=$id";
    $conn->query($sql);
    header('location: index.php');
}

// Fetch tasks
$tasks = $conn->query("SELECT * FROM tasks");

?>
a
<!DOCTYPE html>
<html>
<head>
    <title>To-Do List Application</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>To-Do List</h2>

    <form method="post" action="index.php">
        <input type="text" name="task" placeholder="New Task" required>
        <button type="submit" name="add">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = $tasks->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['task']; ?></td>
                    <td>
                        <form method="post" action="index.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="task" value="<?php echo $row['task']; ?>">
                            <button type="submit" name="edit">Edit</button>
                        </form>
                        <a href="index.php?del_task=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

