<?php
class PostManager {
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function addPost($params, $images)
    {
        $query = "INSERT INTO Posts (Title, Description,catagory) VALUES (?, ?, ?)";
        $result = $this->conn->Query($query, $params, true);
        
        if ($result) {
            $postId = $result;
            $this->uploadImages($postId, $images);
            return $postId;
        }

        return false;
    }

    public function getPosts()
    {
        $query = "SELECT * FROM Posts";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function getPost($Id)
    {
        $query = "SELECT * FROM Posts WHERE Id = ?";
        $result = $this->conn->Query($query,[$Id]);
        $data = $result->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function getPostCatagory()
    {
        $query = "SELECT DISTINCT catagory FROM Posts";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    private function uploadImages($postId, $images)
    {
        $targetDir = "../../uploads/";
        foreach ($images['tmp_name'] as $key => $tmp_name) {
            $fileName = time() . "_" . basename($images['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $query = "INSERT INTO PostImages (PostId, ImagePath) VALUES (?, ?)";
                $this->conn->Query($query, [$postId, $fileName]);
            }
        }
    }

    public function getPostImage($postId)
    {
        $query = "SELECT * FROM PostImages WHERE PostId = ?";
        $result = $this->conn->Query($query,[$postId]);
        $data = $result->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function getPostImages($postId)
    {
        $query = "SELECT * FROM PostImages WHERE PostId = ?";
        $result = $this->conn->Query($query,[$postId]);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function deletePost($Id)
    {
        // Fetch all image paths for the post
        $query = "SELECT ImagePath FROM PostImages WHERE PostId = ?";
        $result = $this->conn->Query($query, [$Id]);
        $images = $result->fetchAll(PDO::FETCH_COLUMN);

        // Delete images from the folder
        $targetDir = "../../uploads/";
        foreach ($images as $image) {
            $filePath = $targetDir . $image;
            if (file_exists($filePath)) {
                unlink($filePath); // Remove the image file
            }
        }

        // Delete images from database
        $query = "DELETE FROM PostImages WHERE PostId = ?";
        $this->conn->Query($query, [$Id]);

        // Delete the post
        $query = "DELETE FROM Posts WHERE Id = ?";
        $result = $this->conn->Query($query, [$Id]);

        return $result->rowCount();
    }
}



?>