<?php

// Admin class for handling website all contents dynamically
class Admin{
    // Database class
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function addUser($params)
    {
        $query = "INSERT INTO users(email,pass) VALUES (?,?)";
        $result = $this->conn->Query($query, $params, true);
        return $result;
    }

    public function updateUser($params)
    {
        $query = "UPDATE users SET pass = ? WHERE email = ?";
        $result = $this->conn->Query($query, $params);
        return $result->rowCount();
    }

    public function getUser($email,$pass)
    {
        $query = "SELECT * FROM users WHERE email = ? AND pass = ?";
        $result = $this->conn->Query($query,[$email,$pass]);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = $this->conn->Query($query,[$email]);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data[0];
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function DeleteUser($id)
    {
        $query = "DELETE FROM users WHERE Id = ?";
        $result = $this->conn->Query($query,[$id]);
        return $result->rowCount();
    }

    public function addCompanyDetails($params)
    {
        $query = "INSERT INTO companyDetails(background) VALUES (?)";
        $result = $this->conn->Query($query, $params, true);
        return $result;
    }

    public function UpdateCompanyDetails($params)
    {
        $query = "UPDATE companyDetails SET background = ? WHERE Id = ?";
        $result = $this->conn->Query($query, $params);
        return $result->rowCount();
    }

    public function getCompanyDetails()
    {
        $query = "SELECT * FROM companyDetails";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function addCompanyContact($params)
    {
        $query = "INSERT INTO companyContact (contact, type) VALUES (?, ?)";
        $result = $this->conn->Query($query, $params, true);
        return $result;
    }

    public function DeleteCompanyContact($Id)
    {
        $query = "DELETE FROM companyContact WHERE Id = ?";
        $result = $this->conn->Query($query, [$Id]);
        return $result->rowCount();
    }


    public function getCompanyContacts()
    {
        $query = "SELECT * FROM companyContact";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function addCompanyAddress($params)
    {
        $query = "INSERT INTO companyAddresses (Street, City, State, PostalCode, Country) VALUES (?, ?, ?, ?, ?)";
        $result = $this->conn->Query($query, $params, true);
        return $result;
    }

    public function UpdateCompanyAddress($params)
    {
        $query = "UPDATE companyAddresses SET Street = ?, City = ?, State = ?, PostalCode = ?, Country = ? WHERE Id = ?";
        $result = $this->conn->Query($query, $params);
        return $result->rowCount();
    }

    public function getCompanyAddresses()
    {
        $query = "SELECT * FROM companyAddresses";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function addSocialMediaLink($params)
    {
        $query = "INSERT INTO SocialMediaLinks (Platform, ProfileLink) VALUES (?, ?)";
        $result = $this->conn->Query($query, $params, true);
        return $result;
    }

    public function deleteSocialMediaLink($Id)
    {
        $query = "DELETE FROM SocialMediaLinks WHERE Id = ?";
        $result = $this->conn->Query($query, [$Id]);
        return $result->rowCount();
    }

    public function getSocialMediaLinks()
    {
        $query = "SELECT * FROM SocialMediaLinks";
        $result = $this->conn->Query($query);
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

}
?>