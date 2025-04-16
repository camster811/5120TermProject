<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Database Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.clear {
            background-color: #f44336;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bookstore Database Interface - by Cameron Stanford</h1>
        <p>Enter your SQL query below or <a href="sample_queries.php" style="color: #4CAF50;">view sample queries</a>:
        </p>

        <form method="post" action="">
            <div class="form-group">
                <textarea name="query" id="query" placeholder="Enter SQL query here..."><?php
                if (isset($_GET['query'])) {
                    echo stripslashes(htmlspecialchars_decode($_GET['query']));
                } elseif (isset($_POST['query'])) {
                    echo stripslashes(htmlspecialchars_decode($_POST['query']));
                }
                ?></textarea>
            </div>
            <div class="buttons">
                <button type="submit" name="submit">Execute Query</button>
                <button type="submit" name="clear" class="clear">Clear</button>
            </div>
        </form>

        <div class="result">
            <?php
            if (isset($_POST['clear'])) {
                // Clear the query by redirecting to the page without query parameters
                echo "<p>Query cleared.</p>";
                echo "<script>window.location.href = 'index.php';</script>";
                exit;
            } elseif (isset($_POST['submit']) && !empty($_POST['query'])) {
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bookstore";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
                }

                // Get the query
                $query = stripslashes(trim($_POST['query']));

                // Check if the query is a DROP statement
                if (preg_match('/^\s*DROP\s+/i', $query)) {
                    echo "<p class='error'>DROP statements are not allowed.</p>";
                } else {
                    // Execute the query
                    try {
                        $result = $conn->query($query);

                        // Check if query was successful
                        if ($result === TRUE) {
                            // For INSERT, UPDATE, DELETE, CREATE, etc.
                            if (preg_match('/^\s*INSERT\s+/i', $query)) {
                                echo "<p class='success'>Row Inserted. Affected rows: " . $conn->affected_rows . "</p>";
                            } elseif (preg_match('/^\s*UPDATE\s+/i', $query)) {
                                echo "<p class='success'>Table Updated. Affected rows: " . $conn->affected_rows . "</p>";
                            } elseif (preg_match('/^\s*DELETE\s+/i', $query)) {
                                echo "<p class='success'>Row(s) Deleted. Affected rows: " . $conn->affected_rows . "</p>";
                            } elseif (preg_match('/^\s*CREATE\s+/i', $query)) {
                                echo "<p class='success'>Table Created.</p>";
                            } elseif (preg_match('/^\s*ALTER\s+/i', $query)) {
                                echo "<p class='success'>Table Altered.</p>";
                            } else {
                                echo "<p class='success'>Query executed successfully.</p>";
                            }
                        } elseif ($result) {
                            // For SELECT queries
                            echo "<p class='success'>Query executed successfully.</p>";

                            // Get number of rows
                            $rowCount = $result->num_rows;
                            echo "<p>Number of rows retrieved: $rowCount</p>";

                            // Display results in a table
                            if ($rowCount > 0) {
                                echo "<table>";

                                // Table header
                                echo "<tr>";
                                $fieldInfo = $result->fetch_fields();
                                foreach ($fieldInfo as $field) {
                                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                                }
                                echo "</tr>";

                                // Table data
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    foreach ($row as $value) {
                                        echo "<td>" . htmlspecialchars(isset($value) ? $value : "NULL") . "</td>";
                                    }
                                    echo "</tr>";
                                }

                                echo "</table>";
                            } else {
                                echo "<p>No results found.</p>";
                            }

                            // Free result set
                            $result->free();
                        } else {
                            echo "<p class='error'>Error: " . $conn->error . "</p>";
                        }
                    } catch (Exception $e) {
                        echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
                    }
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>

</html>
