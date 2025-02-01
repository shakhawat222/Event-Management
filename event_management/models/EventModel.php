<?php
// EventModel.php

class EventModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fetch all events
    public function getAllEvents() {
        $stmt = $this->conn->query("SELECT * FROM events");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // Update an event
    public function updateEvent($eventId, $name, $date, $description) {
        $stmt = $this->conn->prepare("UPDATE events SET event_name = ?, event_date = ?, event_description = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $date, $description, $eventId);
        return $stmt->execute();
    }

    // Delete an event
    public function deleteEvent($eventId) {
        $stmt = $this->conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $eventId);
        return $stmt->execute();
    }

    // Create a new event
    public function createEvent($eventName, $eventDescription, $eventDate, $customerId, $token) {
        $stmt = $this->conn->prepare("INSERT INTO events (event_name, event_description, event_date, created_by, token, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("sssii", $eventName, $eventDescription, $eventDate, $customerId, $token);
        return $stmt->execute();
    }

    // Fetch pending events
    public function getPendingEvents() {
        $stmt = $this->conn->query("SELECT id, event_name, event_date, token FROM events WHERE status = 'pending'");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // Accept an event
    public function acceptEvent($eventId, $hostId) {
        $stmt = $this->conn->prepare("UPDATE events SET status = 'accepted', accepted_by = ? WHERE id = ?");
        $stmt->bind_param("ii", $hostId, $eventId);
        return $stmt->execute();
    }

    // Fetch accepted events
    public function getAcceptedEvents() {
        $stmt = $this->conn->query("SELECT e.event_name, e.event_date, e.accepted_by, u.username AS host_name 
            FROM events e 
            LEFT JOIN users u ON e.accepted_by = u.id 
            WHERE e.status = 'accepted'");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}