<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$users = [
    ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@email.com', 'edad' => 25],
    ['id' => 2, 'nombre' => 'María García', 'email' => 'maria@email.com', 'edad' => 30],
    ['id' => 3, 'nombre' => 'Carlos López', 'email' => 'carlos@email.com', 'edad' => 28]
];

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        if (isset($_GET['id'])) {
            $found = False;
            foreach ($users as $user) {
                if ($user['id'] == $_GET['id']) {
                    echo json_encode([
                        'estado' => 'Exito',
                        'data' => $user
                    ]);
                    $found = True;
                    break;
                }
            }
            if (!$found) {
                http_response_code(404);
                echo json_encode([
                    'estado' => 'Fallido',
                    'data' => 'No hay datos'
                ]);
            }

        } else {
            echo json_encode([
                'estado' => 'Exito',
                'data' => $users
            ]);
        }

        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        // Insert
        array_push($users, [
            'id' => 4,
            'nombre' => $data["nombre"],
            'email' => 'oliver@gmail.com',
            'edad' => $data['edad']
        ]);

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]);

        break;
}