<?php

require "database.php";

// Create new user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $first_name = $_POST["first_name"];
    // $last_name = $_POST["last_name"];
    // $age = $_POST["age"];f
    $first_name = trim(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));
    $age = trim(filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT));

    try {
        $statement = $pdo->prepare(
            "INSERT INTO users (first_name, last_name, age) VALUES (:first_name, :last_name, :age);"
        );
        $statement->execute(["first_name" => $first_name, "last_name" => $last_name, "age" => $age]);
        echo "INSERT user: {$first_name} {$last_name}";


        $id = $pdo->lastInsertId();

        // show one means to show one user instead of all and $id is what number user it is
        echo "<script>location.href='/read.php?show=all'</script>";


    } catch(PDOException $e) {
        echo "<h4 style='color: red'>" . $e->getMessage() . "</h4>";
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Simple Crud</title>
    </head>
    <body>
        <form action="/create.php" method="POST">
            <table>
                <tr>
                    <th><label for="first_name">First Name:</label></th>
                    <td><input type="text" name="first_name" id="first_name" value=""></td>
                </tr>
                <tr>
                    <th><label for="last_name">Last Name:</label></th>
                    <td><input type="text" name="last_name" id="last_name" value=""></td>
                </tr>
                <tr>
                    <th><label for="age">Age:</label></th>
                    <td><input type="text" name="age" id="age" value=""></td>
                </tr>
            </table>
            <button type="submit">Save</button>
        </form>
    </body>
</html>