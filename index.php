<?php
include 'koneksi.php';
$conn = new mysqli("localhost", "root", "", "pertemuan2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Catatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body {
            background-color: #f9f0f9; 
        }

        h2 {
            color: #ab47bc; 
        }

        .btn-primary {
            background-color: #ff6f91; 
            border-color: #ff6f91;
        }

        .btn-warning {
            background-color: #ba68c8;
            border-color: #ba68c8;
        }

        .btn-danger {
            background-color: #f06292; 
            border-color: #f06292;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8bbd0; 
        }

        .table-striped tbody tr:hover {
            background-color: #e1bee7; 
        }

        .table-dark {
            background-color: #ce93d8; 
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Catatan</h2>
        <div class="d-flex justify-content-center mb-3">
            <a href="pages/create.php" class="btn btn-primary">Tambah Catatan Baru</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-white">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi Catatan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['judul'] . "</td>";
                        echo "<td>" . $row['isi'] . "</td>";
                        echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                        echo "<td>";
                        echo "<a href='./pages/edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                        echo "<a href='./actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Belum ada catatan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
$conn->close();
?>
