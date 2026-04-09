<?php
// File: controllers/ArticleController.php
require_once __DIR__ . '/../models/ArticleModel.php';

class ArticleController {
    private $conn;
    private $articleModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->articleModel = new ArticleModel($this->conn);
    }

    public function store() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Keamanan: Hanya role 'journalist' yang boleh menyimpan artikel
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'journalist') {
            header("Location: /index.php?action=show_login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            $category = $_POST['category'] ?? '';
            $content = $_POST['content'] ?? '';
            $journalistId = $_SESSION['user_id'];

            // PROSES UPLOAD GAMBAR
            $imagePathDb = null;

            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['cover_image']['tmp_name'];
                $fileName = $_FILES['cover_image']['name'];
                
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Buat nama file unik
                    $newFileName = 'article-' . time() . '-' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', basename($fileName));
                    
                    // Folder fisik tempat menyimpan (Image Path)
                    $uploadDir = __DIR__ . '/../public/uploads/articles/';
                    
                    // Fitur Auto-Create Folder jika belum ada
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    $destPath = $uploadDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imagePathDb = '/uploads/articles/' . $newFileName;
                    } else {
                        die("Gagal memindahkan file gambar artikel.");
                    }
                } else {
                    die("Format gambar tidak diizinkan. Hanya JPG, PNG, dan WEBP.");
                }
            } else {
                // Jika Anda ingin gambar wajib diisi:
                die("Cover image artikel wajib diunggah.");
            }

            // SIMPAN KE DATABASE
            $isSaved = $this->articleModel->createArticle($journalistId, $title, $author, $category, $imagePathDb, $content);

            if ($isSaved) {
                // Arahkan ke dashboard jurnalis setelah sukses
                header("Location: /index.php?action=journalist_dashboard&status=success");
                exit;
            } else {
                echo "Gagal menyimpan artikel: " . mysqli_error($this->conn);
            }
        }
    }

    // Tambahkan fungsi ini di dalam class ArticleController
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Pastikan hanya jurnalis yang bisa mengakses
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'journalist') {
            header("Location: /index.php?action=show_login");
            exit;
        }

        // Ambil ID Jurnalis yang sedang login
        $journalistId = $_SESSION['user_id'];

        // Tarik data artikel dari Model
        $myArticles = $this->articleModel->getArticlesByJournalist($journalistId);

        // Panggil View dan kirimkan datanya
        require_once __DIR__ . '/../views/journalist/dashboard.php';
    }
}
?>