<?php
class Contact {
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    // Add new contact message
    public function addContactMessage($params)
    {
        $query = "INSERT INTO ContactMessages (Name, Email, Subject, Message) VALUES (?, ?, ?, ?)";
        return $this->conn->Query($query, $params, true);
    }

    // Get all messages
    public function getAllMessages()
    {
        $query = "SELECT * FROM ContactMessages ORDER BY CreatedAt DESC";
        return $this->conn->Query($query);
    }

    // Get a single message by ID
    public function getMessageById($messageId)
    {
        $query = "SELECT * FROM ContactMessages WHERE MessageID = ?";
        return $this->conn->Query($query, [$messageId], false);
    }

    // delete a single message by ID
    public function Delete($messageId)
    {
        $query = "DELETE FROM ContactMessages WHERE MessageID = ?";
        return $this->conn->Query($query, [$messageId]);
    }

    // Get messages by Status
    // Status('New', 'Read', 'Replied')
    public function getMessageByStatus($status)
    {
        $query = "SELECT * FROM ContactMessages WHERE Status = ?";
        return $this->conn->Query($query, [$status], false);
    }

    // Update message status (e.g., mark as Read or Replied)
    public function updateMessageStatus($messageId, $status)
    {
        $query = "UPDATE ContactMessages SET Status = ? WHERE MessageID = ?";
        return $this->conn->Query($query, [$status, $messageId]);
    }
}
?>
