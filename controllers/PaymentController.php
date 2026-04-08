<?php
require_once __DIR__ . '/../models/PaymentModel.php';

class PaymentController {
    private $conn;
    private $paymentModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        // PENTING: Instansiasi Model agar fungsi update bisa dipanggil
        $this->paymentModel = new PaymentModel($this->conn);
    }

    public function showPayment() {
        $booking_id = $_GET['booking_id'] ?? null;
        if (!$booking_id) {
            header("Location: index.php?action=history");
            exit;
        }

        $query = "SELECT p.*, pkg.package_name 
                  FROM payments p 
                  JOIN bookings b ON p.booking_id = b.id 
                  JOIN packages pkg ON b.package_id = pkg.id
                  WHERE p.booking_id = '$booking_id' 
                  LIMIT 1";

        $result = mysqli_query($this->conn, $query);
        $payment = mysqli_fetch_assoc($result);

        if (!$payment) {
            die("Data pembayaran tidak ditemukan.");
        }

        require_once __DIR__ . '/../views/customer/payment.php';
    }

    // ==========================================
    // FUNGSI STORE YANG SUDAH DIMODIFIKASI (AJAX READY)
    // ==========================================
    public function store() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Gunakan header JSON agar dipahami oleh fetch() di Frontend
        header('Content-Type: application/json');

        if (!isset($_SESSION['login'])) {
            echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingId = $_POST['booking_id'] ?? '';
            $amount = $_POST['amount'] ?? 0;
            
            // 1. PROSES UPLOAD BUKTI PEMBAYARAN
            $imagePathDb = null;

            if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['payment_proof']['tmp_name'];
                $fileName = $_FILES['payment_proof']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = 'pay-' . $bookingId . '-' . time() . '.' . $fileExtension;
                    $uploadDir = __DIR__ . '/../public/uploads/payments/';
                    
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $destPath = $uploadDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        // Simpan path relatif untuk database
                        $imagePathDb = '/uploads/payments/' . $newFileName; 
                    } else {
                        echo json_encode(["status" => "error", "message" => "Gagal memindahkan file ke server."]);
                        exit;
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Format file harus JPG atau PNG."]);
                    exit;
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Bukti pembayaran wajib diunggah."]);
                exit;
            }

            // 2. UPDATE KE DATABASE MELALUI MODEL
            $status = 'pending'; // Status awal setelah upload
            
            $isSaved = $this->paymentModel->updatePaymentStatus(
                $bookingId,
                $imagePathDb,
                $status
            );

            if ($isSaved) {
                // KIRIM RESPON SUKSES UNTUK JAVASCRIPT
                echo json_encode([
                    "status" => "success", 
                    "message" => "Payment proof submitted successfully."
                ]);
            } else {
                echo json_encode(["status" => "error", "message" => "Database error: Gagal menyimpan data."]);
            }
            exit;
        }
    }
}