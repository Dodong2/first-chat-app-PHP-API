<?php

class ChatController {

    public function create_chat() {
        global $conn;

        $name = $_POST['name'] ?? '';
        $message = $_POST['message'] ?? '';

        //Validate input
        if(empty($name) || empty($message)) {
            $response = ['success' => false, 'message' => 'name, and message cannot be empty'];
            echo json_encode($response);
            return;
        }

        // Insert data into the database
        $stmt = $conn->prepare('INSERT INTO todos (name, message) VALUES (?, ?)');

            // Check if preparation was successful
            if ($stmt === false) {
                $response = ['success' => false, 'message' => 'SQL prepare error: ' . $conn->error];
                echo json_encode($response);
                return;
            }

            $stmt->bind_param('sss', $name, $message);

            if($stmt->execute()) {
                $response = ['success' => true, 'message' => 'message created successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to create message: ' . $stmt->error];
            }

            $stmt->close();
            echo json_encode($response);
    }

       // Get all Todos
       public function get_chats() {
        global $conn;

        $result = $conn->query('SELECT * FROM messages');
        $messages = [];

        while($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        $response = ['success' => true, 'messages' => $messages];
        echo json_encode($response);
       }



}



?>