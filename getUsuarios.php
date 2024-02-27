<?php

    $user = $_GET['user'];
    $pwd = $_GET['pwd'];

	// Configuración de la base de datos
	$servername = "https://djm25.synology.me/phpmyadmin/";
	$username = $user;
	$password = $pwd; 
	$database = "cherryconnect";

	// Abrir conexión a la base de datos
	$conn = new mysqli($servername, $username, $password, $database);

	// Verificar conexión
	if ($conn->connect_error) {
	    die("Error de conexión a la base de datos: " . $conn->connect_error);
	}

	// Consulta
	$sql = "SELECT * FROM Usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuarios = array();
        while($row = $result->fetch_assoc()) {
    
            $usuario = array(
                "id" => $row["id"],
                "nombre" => $row["nombre"],
                "apellidos" => $row["apellidos"],
                "contraseña" => $row["contraseña"],
                "mail" => $row["mail"],
                "imagen" => $row["imagen"],
                "admin" => $row["admin"]
            );
            array_push($usuarios, $usuario);
        }
    
        echo json_encode($usuarios);
    } else {
        echo json_encode(["mensaje" => "No se encontraron Usuarios"]);
    }
    


	// Cerrar conexión a la base de datos
	$conn->close();
?>