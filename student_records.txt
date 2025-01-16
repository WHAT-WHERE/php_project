<?php
// Define the path to the text file
$file_path = 'student.txt';

// Initialize an empty array to store student data
$students = [];

// Open the file for reading
if (file_exists($file_path) && is_readable($file_path)) {
    $file = fopen($file_path, 'r');

    // Read each line of the file
    while (($line = fgets($file)) !== false) {
        // Trim any whitespace from the line
        $line = trim($line);

        // Split the line by the delimiter " : "
        $parts = explode(' : ', $line);

        // Ensure there are exactly 3 parts (Name, Password, Email)
        if (count($parts) == 3) {
            $students[] = [
                'name' => $parts[0],
                'password' => $parts[1],
                'email' => $parts[2]
            ];
        }
    }

    // Close the file
    fclose($file);
} else {
    echo "Error: The file is either non-existent or not readable.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student Information</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($student['password'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No student data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
