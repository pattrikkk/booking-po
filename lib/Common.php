<?php

namespace lib;

class Common
{
    private $alerts = [
        "registration" => [
            "success" => [
                "type" => "success",
                "message" => "Registration successful. You can now login."
            ],
            "password_mismatch" => [
                "type" => "danger",
                "message" => "Passwords do not match."
            ],
            "email_exists" => [
                "type" => "danger",
                "message" => "Account with this email already exists."
            ]
        ],
        "login" => [
            "success" => [
                "type" => "success",
                "message" => "Login successful."
            ],
            "invalid_credentials" => [
                "type" => "danger",
                "message" => "Invalid credentials."
            ]
        ],
        "listing" => [
            "success" => [
                "type" => "success",
                "message" => "Listing created successfully."
            ],
            "edited" => [
                "type" => "success",
                "message" => "Listing edited successfully."
            ],
            "deleted" => [
                "type" => "success",
                "message" => "Listing deleted successfully."
            ],
        ],
        "reservation" => [
            "success" => [
                "type" => "success",
                "message" => "Reservation created successfully."
            ],
            "overlap" => [
                "type" => "danger",
                "message" => "Reservation overlaps with existing reservation."
            ],
            "invalidDates" => [
                "type" => "danger",
                "message" => "Invalid dates."
            ],
            "deleted" => [
                "type" => "success",
                "message" => "Reservation deleted successfully."
            ]
        ]
    ];

    private $amenities = [
        "wifi" => "Wi-Fi",
        "parking" => "Parking",
        "catering" => "Catering",
        "petsAllowed" => "Pets Allowed"
    ];

    function getAmenities(): array
    {
        return $this->amenities;
    }

    function printAlerts(): void
    {
        $getParams = $_GET;

        foreach ($getParams as $param => $type) {
            if (isset($this->alerts[$param][$type])) {
                $alert = $this->alerts[$param][$type];
                echo "<div class=\" mt-3 rounded alert alert-{$alert['type']}\">{$alert['message']}</div>";
            }
        }
    }

    function getAlert(string $param, string $type): array
    {
        return $this->alerts[$param][$type];
    }

    function startSession(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function isUserLoggedIn(): bool
    {
        $this->startSession();
        return isset($_SESSION['user_id']);
    }
}