<?php
$password = 'VinasPassword';
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo $hashedPassword;
?>



<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'connectm_lasvinas');
define('DB_PASS', 'MSistemax23.');
define('DB_NAME', 'connectm_lasvinas');

//Crear conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Verificar conexión
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}

//Consulta para obtener todos los registros de la tabla activos
$sql = "SELECT * FROM activos";
$result = $conn->query($sql);

//Mostrar resultados
if ($result->num_rows > 0) {
    echo "<h2>Tabla de Activos</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
    //Encabezados de la tabla
    echo "<tr>";
    while ($field = $result->fetch_field()) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";

    //Filas de resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>" . htmlspecialchars($data) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "⚠️ No hay registros en la tabla 'activos'.";
}

//Cerrar conexión
$conn->close();
?>
