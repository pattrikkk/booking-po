<?php

namespace lib;

class DB
{
    private $host = "localhost";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    private $dbName = "booking";

    private \PDO $connection;

    public function __construct(
        string $host = "",
        int $port = 3306,
        string $username = "",
        string $password = "",
        string $dbName = ""
    )
    {
        if(!empty($host)) {
            $this->host = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($username)) {
            $this->username = $username;
        }

        if(!empty($password)) {
            $this->password = $password;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function register(string $firstName, string $lastName, string $email, string $password, string $phone): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (firstName, lastName, email, password, phone) VALUES (:firstName, :lastName, :email, :password, :phone)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":phone", $phone);
        return $stmt->execute();
    }

    public function emailExists(string $email): bool
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return !empty($result);
    }

    public function login(string $email, string $password): bool
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(empty($result)) {
            return false;
        }
        return password_verify($password, $result["password"]);
    }

    public function getFirstName(string $email): string
    {
        $sql = "SELECT firstName FROM user WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result["firstName"];
    }

    public function getLastName(string $email): string
    {
        $sql = "SELECT lastName FROM user WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result["lastName"];
    }

    public function getUserId(string $email): int
    {
        $sql = "SELECT id FROM user WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result["id"];
    }

    public function createListing(string $name, string $location, string $description, int $rooms, int $beds,  string $amenities, int $price, int $publishedBy) {
        $sql = "INSERT INTO listing (name, location, description, rooms, beds, amenities, price, publishedBy) VALUES (:name, :location, :description, :rooms, :beds, :amenities, :price, :publishedBy)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":rooms", $rooms);
        $stmt->bindParam(":beds", $beds);
        $stmt->bindParam(":amenities", $amenities);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":publishedBy", $publishedBy);
        return $stmt->execute();
    }

    public function getListings(): array
    {
        $sql = "SELECT * FROM listing";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getListing(int $id): array {
        $sql = "SELECT * FROM listing WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getCreatorOfListing(int $id): array {
        $sql = "SELECT * FROM user WHERE id = (SELECT publishedBy FROM listing WHERE id = :id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}