<?php

namespace lib;

class DB
{
    private $host = "db";
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

    public function updateListing(int $id, string $name, string $location, string $description, int $rooms, int $beds,  string $amenities, int $price, int $publishedBy) {
        $sql = "UPDATE listing SET name = :name, location = :location, description = :description, rooms = :rooms, beds = :beds, amenities = :amenities, price = :price, publishedBy = :publishedBy WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
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

    public function deleteListing(int $id) {
        $sql = "DELETE FROM listing WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function checkReservationOverlap(int $listingId, string $dateFrom, string $dateTo): bool {
        $sql = "SELECT * FROM reservation WHERE listingId = :listingId AND ((dateFrom <= :dateFrom AND dateTo >= :dateFrom) OR (dateFrom <= :dateTo AND dateTo >= :dateTo))";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":listingId", $listingId);
        $stmt->bindParam(":dateFrom", $dateFrom);
        $stmt->bindParam(":dateTo", $dateTo);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return !empty($result);
    }

    public function createReservation(int $userId, int $listingId, string $dateFrom, string $dateTo, string $message, int $adults, int $children): bool {
        $sql = "INSERT INTO reservation (userId, listingId, dateFrom, dateTo, message, adults, children) VALUES (:userId, :listingId, :dateFrom, :dateTo, :message, :adults, :children)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":listingId", $listingId);
        $stmt->bindParam(":dateFrom", $dateFrom);
        $stmt->bindParam(":dateTo", $dateTo);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":adults", $adults);
        $stmt->bindParam(":children", $children);
        return $stmt->execute();
    }

    public function getListingReservations(int $listingId): array {
        $sql = "SELECT dateFrom, dateTo FROM reservation WHERE listingId = :listingId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":listingId", $listingId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservations(int $userId): array {
        $sql = "SELECT * FROM reservation WHERE userId = :userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservationsForListing(int $listingId): array {
        $sql = "SELECT * FROM reservation WHERE listingId = :listingId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":listingId", $listingId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function checkReservationOwner(int $reservationId, int $userId): bool {
        $sql = "SELECT * FROM reservation WHERE id = :reservationId AND userId = :userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return !empty($result);
    }

    public function getReservationOwner(int $reservationId): array {
        $sql = "SELECT * FROM user WHERE id = (SELECT userId FROM reservation WHERE id = :reservationId)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function changeReservationStatus(int $reservationId, int $status) {
        $sql = "UPDATE reservation SET approved = :status WHERE id = :reservationId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->bindParam(":status", $status);
        return $stmt->execute();
    }

    public function getListingFromReservationID(int $reservationId): array {
        $sql = "SELECT * FROM listing WHERE id = (SELECT listingId FROM reservation WHERE id = :reservationId)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteReservation(int $reservationId) {
        $sql = "DELETE FROM reservation WHERE id = :reservationId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":reservationId", $reservationId);
        return $stmt->execute();
    }

    public function filterReservations(String $city, String $dateFrom, String $dateTo, int $adults, int $children, int $rooms, bool $listingsbyme): array {
        $city = "%" . $city . "%";
        $sql = "SELECT * FROM listing 
        WHERE location LIKE :city 
        AND rooms >= :rooms 
        AND id NOT IN (
            SELECT listingId FROM reservation 
            WHERE (
                STR_TO_DATE(:dateFrom, '%d.%m.%Y') <= dateTo 
                AND STR_TO_DATE(:dateTo, '%d.%m.%Y') >= dateFrom
            )
            OR (
                STR_TO_DATE(:dateFrom, '%d.%m.%Y') <= dateTo 
                AND STR_TO_DATE(:dateTo, '%d.%m.%Y') >= dateTo
            )
        )
        AND :adults + :children <= beds";
        if ($listingsbyme) {
            $sql .= " AND publishedBy = :userId";
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':city', $city, \PDO::PARAM_STR);
        $stmt->bindParam(':rooms', $rooms, \PDO::PARAM_INT);
        $stmt->bindParam(':dateFrom', $dateFrom, \PDO::PARAM_STR);
        $stmt->bindParam(':dateTo', $dateTo, \PDO::PARAM_STR);
        $stmt->bindParam(':adults', $adults, \PDO::PARAM_INT);
        $stmt->bindParam(':children', $children, \PDO::PARAM_INT);
        if ($listingsbyme) {
            $stmt->bindParam(':userId', $_SESSION['user_id'], \PDO::PARAM_INT);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}