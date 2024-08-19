<?php

class Post {
    private $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create a new post
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title, content, author, created_at, updated_at) 
                  VALUES (:title, :content, :author, :created_at, :updated_at)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method to read a single post by ID
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind ID to the query
        $stmt->bindParam(1, $id);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a post was found
        if ($row) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->author = $row['author'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        }

        return false;
    }

    // Method to update an existing post
    public function update($id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, content = :content, author = :author, updated_at = :updated_at 
                  WHERE id = :id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':id', $id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method to delete a post
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind ID to the query
        $stmt->bindParam(':id', $id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method to list all posts
    public function listAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        return $stmt;
    }
}
