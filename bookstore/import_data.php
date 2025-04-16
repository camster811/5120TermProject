<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to import CSV data
function importCSV($conn, $tableName, $csvFile) {
    echo "Importing data into $tableName from $csvFile...<br>";
    
    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, ",");
        $columns = implode(", ", $header);
        $rowCount = 0;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $values = array();
            foreach ($data as $key => $value) {
                // Convert date format if necessary
                if (in_array($header[$key], array('OrderDate', 'ShippedDate')) && !empty($value)) {
                    $date = DateTime::createFromFormat('m/d/Y', $value);
                    if ($date) {
                        $value = $date->format('Y-m-d'); // Convert to MySQL DATE format
                    }
                }

                if ($value === "NULL") {
                    $values[] = "NULL";
                } else {
                    $values[] = "'" . $conn->real_escape_string($value) . "'";
                }
            }
            $valueString = implode(", ", $values);

            // Escape table name with backticks
            $sql = "INSERT INTO `$tableName` ($columns) VALUES ($valueString)";
            
            if ($conn->query($sql) === TRUE) {
                $rowCount++;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        }
        fclose($handle);
        echo "Imported $rowCount rows into $tableName.<br><br>";
    } else {
        echo "Could not open file: $csvFile<br>";
    }
}

// Import data from CSV files
// Import in order to respect foreign key constraints
importCSV($conn, "Subject", "data/db_subject.csv");
importCSV($conn, "Supplier", "data/db_supplier.csv");
importCSV($conn, "Book", "data/db_book.csv");
importCSV($conn, "Shipper", "data/db_shipper.csv");
importCSV($conn, "Customer", "data/db_customer.csv");
importCSV($conn, "Employee", "data/db_employee.csv");
importCSV($conn, "Order", "data/db_order.csv");
importCSV($conn, "OrderDetail", "data/db_order_detail.csv");

echo "Data import completed!";

// Close connection
$conn->close();
?>
