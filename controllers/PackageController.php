<?php
// File: controllers/PackageController.php
require_once __DIR__ . '/../models/PackageModel.php';

class PackageController {
    private $conn;
    private $packageModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->packageModel = new PackageModel($this->conn);
    }

    public function store() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // 1. Keamanan: Pastikan yang akses adalah Vendor yang sedang login
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            die("Unauthorized access.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data teks
            $name = $_POST['package_name'] ?? '';
            $categoryId = $_POST['category_id'] ?? '';
            $price = $_POST['price'] ?? 0;
            $description = $_POST['description'] ?? '';
            $features = $_POST['features'] ?? '';

            // Cari Vendor Profile ID
            $userId = $_SESSION['user_id'];
            $vendorProfileId = $this->packageModel->getVendorProfileId($userId);

            if (!$vendorProfileId) {
                die("Vendor profile not found. Please complete your profile first.");
            }

            // 2. PROSES UPLOAD GAMBAR
            $imagePathDb = null; // Default jika gagal

            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['main_image']['tmp_name'];
                $fileName = $_FILES['main_image']['name'];
                
                // Ambil ekstensi gambar (jpg, png, dll)
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Buat nama file unik agar tidak saling menimpa (Contoh: 167890123-paketku.jpg)
                    $newFileName = time() . '-' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', basename($fileName));
                    
                    // Folder fisik tempat menyimpan (Pastikan folder ini ADA di dalam folder public!)
                    $uploadDir = __DIR__ . '/../public/uploads/packages/';
                    if (!is_dir($uploadDir)) {
                        // Buat folder berserta sub-foldernya secara rekursif (true)
                        // 0777 adalah hak akses agar bisa ditulisi
                        mkdir($uploadDir, 0777, true);
                    }
                    $destPath = $uploadDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        // Jalur yang akan disimpan ke database (Relatif terhadap folder public)
                        $imagePathDb = '/uploads/packages/' . $newFileName;
                    } else {
                        die("Gagal memindahkan file gambar ke folder upload.");
                    }
                } else {
                    die("Format gambar tidak diizinkan. Hanya JPG, PNG, dan WEBP.");
                }
            }

            // 3. SIMPAN KE DATABASE
           $isSaved = $this->packageModel->createPackage($vendorProfileId, $categoryId, $name, $price, $description, $features, $imagePathDb);

            if ($isSaved) {
                // Jika sukses, kembalikan ke dashboard vendor
                header("Location: /index.php?action=dashboard-vendor&msg=success");
                exit;
            } else {
                echo "Gagal menyimpan ke database: " . mysqli_error($this->conn);
            }
        }
    }

    // ==========================================
    // 1. FUNGSI UNTUK MENAMPILKAN DETAIL PAKET
    // ==========================================
    public function show() {
        // Ambil ID paket dari URL: index.php?action=package_detail&id=...
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=vendors");
            exit;
        }

        // Ambil data paket dari Model
        $package = $this->packageModel->getPackageById($id);

        if (!$package) {
            die("Maaf, paket pernikahan tidak ditemukan.");
        }

        // Tampilkan halaman detail
        require_once __DIR__ . '/../views/public/package_detail.php';
    }

    // ==========================================
    // 2. FUNGSI UNTUK MENAMPILKAN HALAMAN CHECKOUT
    // ==========================================
    public function checkout() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Keamanan: Hanya Customer yang bisa checkout
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'customer') {
            echo "<script>alert('Silahkan login sebagai Customer untuk melakukan pemesanan.'); window.location.href='index.php?action=show_login';</script>";
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=vendors");
            exit;
        }

        // Ambil data paket agar harga dan nama paket muncul di form checkout
        $package = $this->packageModel->getPackageById($id);

        if (!$package) {
            die("Paket tidak ditemukan.");
        }

        // Tampilkan halaman checkout
        require_once __DIR__ . '/../views/customer/checkout.php';
    }
}
?>