<?php

require 'config.php';
require 'controller/chat.php';

$chatController = new ChatController();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $chatController->create_chat();
        break;
    case 'read':
        $chatController->get_chats();
        break;
    default:
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

?>