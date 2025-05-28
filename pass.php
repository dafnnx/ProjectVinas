<?php
$password = 'Vinas2025';
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo  $hashedPassword;
//Una "password tipo hash" (o contraseña hash) es una contraseña que ha sido transformada a través de un algoritmo hash, lo que significa que se ha convertido en una representación de caracteres alfanuméricos de longitud fija y generalmente no reversible. Este proceso es una forma de proteger la contraseña original en una base de datos, ya que es muy difícil (y casi imposible) volver a obtener la contraseña original a partir de su hash. 
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
