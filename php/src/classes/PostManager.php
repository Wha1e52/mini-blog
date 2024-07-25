<?php

class PostManager
{
    private PDO $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $subtitle;
    public $user_name;
    public $img_url;
    public $content;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllPosts(): ?PDOStatement
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        return $this->conn->query($query);
    }

    public function getPost($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createPost($title, $subtitle, $user_name, $img_url, $content)
    {
        $query = "INSERT INTO " . $this->table_name .
            " SET title=:title, subtitle=:subtitle, user_name=:user_name, img_url=:img_url, content=:content";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($title));
        $this->subtitle = htmlspecialchars(strip_tags($subtitle));
        $this->user_name = htmlspecialchars(strip_tags($user_name));
        $this->img_url = htmlspecialchars(strip_tags($img_url));
        $this->content = htmlspecialchars(strip_tags($content));

        if ($stmt->execute([':title' => $this->title, ':subtitle' => $this->subtitle,
            ':user_name' => $this->user_name, ':img_url' => $this->img_url, ':content' => $this->content])) {
            return true;
        }

        return false;
    }

    public function editPost($id, $title, $subtitle, $user_name, $img_url, $content): bool
    {
        $query = "UPDATE " . $this->table_name .
            " SET title=:title, subtitle=:subtitle, 
            user_name=:user_name, img_url=:img_url, content=:content
            WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($id));
        $this->title = htmlspecialchars(strip_tags($title));
        $this->subtitle = htmlspecialchars(strip_tags($subtitle));
        $this->user_name = htmlspecialchars(strip_tags($user_name));
        $this->img_url = htmlspecialchars(strip_tags($img_url));
        $this->content = htmlspecialchars(strip_tags($content));

        if ($stmt->execute([':id'=> $this->id, ':title' => $this->title, ':subtitle' => $this->subtitle,
            ':user_name' => $this->user_name, ':img_url' => $this->img_url, ':content' => $this->content])) {
            return true;
        }

        return false;
    }
    public function deletePost($id): bool
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}