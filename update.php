<?php

require "database.php";

// Handles POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["id"]) && $_POST["_method"] == "PUT") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $age = $_POST["age"];
    $id = $_GET["id"];

    try {
        $statement = $pdo->prepare(
            "UPDATE users SET first_name = :first_name, last_name = :last_name, age = :age where id = :id;"
        );
        $statement->execute(["first_name" => $first_name, "last_name" => $last_name, "age" => $age, "id" => $id]);
        echo "Updated the data";
    } catch(PDOException $e) {
        echo "<h4 style='color: red'>" . $e->getMessage() . "</h4>";
    }
}

// Handles GET request
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $statement = $pdo->prepare(
            "SELECT * FROM users where id = :id;"
        );
        $statement->execute(["id" => $id]);


        $results = $statement->fetchAll(PDO::FETCH_OBJ);
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
        <form action="/update.php?id=<?php echo $results[0]->id; ?>" method="POST">
            <table>
                <tr>
                    <input type="hidden" name="_method" value="PUT" />
                </tr>
                <tr>
                    <th><label for="first_name">First Name:</label></th>
                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $results[0]->first_name; ?>"></td>
                </tr>
                <tr>
                    <th><label for="last_name">Last Name:</label></th>
                    <td><input type="text" name="last_name" id="last_name" value="<?php echo $results[0]->last_name; ?>"></td>
                </tr>
                <tr>
                    <th><label for="age">Age:</label></th>
                    <td><input type="text" name="age" id="age" value="<?php echo $results[0]->age; ?>"></td>
                </tr>
            </table>
            <button type="submit">Save</button>
        </form>
        <a href="/read.php?show=all">Go Back</a>
    </body>
</html>