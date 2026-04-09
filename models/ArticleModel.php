<?php
// File: models/ArticleModel.php

class ArticleModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. MENYIMPAN ARTIKEL BARU
    public function createArticle($journalistId, $title, $authorName, $category, $imageUrl, $content) {
        $titleEsc = mysqli_real_escape_string($this->conn, trim($title));
        $authorEsc = mysqli_real_escape_string($this->conn, trim($authorName));
        $categoryEsc = mysqli_real_escape_string($this->conn, trim($category));
        $imageUrlEsc = mysqli_real_escape_string($this->conn, trim($imageUrl));
        $contentEsc = mysqli_real_escape_string($this->conn, trim($content));
        
        $journalistId = intval($journalistId); // Berasal dari users.id

        $query = "INSERT INTO articles (journalist_id, title, author_name, category, image_url, content) 
                  VALUES ($journalistId, '$titleEsc', '$authorEsc', '$categoryEsc', '$imageUrlEsc', '$contentEsc')";
        
        return mysqli_query($this->conn, $query);
    }

    // 2. MENGAMBIL SEMUA ARTIKEL (Untuk halaman Inspirasi Customer)
    public function getAllArticles($limit = 10) {
        $limitInt = intval($limit);
        $query = "SELECT * FROM articles ORDER BY created_at DESC LIMIT $limitInt";
        $result = mysqli_query($this->conn, $query);
        
        $articles = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
            }
        }
        return $articles;
    }

    // 3. MENGAMBIL ARTIKEL MILIK 1 JURNALIS (Untuk Dashboard Jurnalis)
    public function getArticlesByJournalist($journalistId) {
        $idEsc = intval($journalistId);
        $query = "SELECT * FROM articles WHERE journalist_id = $idEsc ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);
        
        $articles = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
            }
        }
        return $articles;
    }
}
?>