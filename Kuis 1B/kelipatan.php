<?php
// Fungsi untuk membuat tabel kelipatan
function buatTabelKelipatan($angka) {
    if (!is_numeric($angka) || $angka < 1) {
        return [
            'error' => true,
            'message' => 'Masukkan angka lebih dari 0'
        ];
    }

    $angka = (int)$angka;
    $data = [];

    // Tampilkan sampai 20 kelipatan dari angka
    $batas = $angka * 20;

    for ($i = 1; $i <= $batas; $i++) {
        $isKelipatan = ($i % $angka == 0);
        $data[] = [
            'urutan' => $i,
            'hasil' => $i,
            'is_kelipatan' => $isKelipatan
        ];
    }

    return [
        'error' => false,
        'angka' => $angka,
        'data' => $data
    ];
}


// Proses form submission
$result = null;
$angka_input = 5; // Default value

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['angka'])) {
    $angka_input = $_POST['angka'];
    $result = buatTabelKelipatan($angka_input);
} else {
    $result = buatTabelKelipatan(5);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Kelipatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .input-area {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-size: 18px;
            color: #555;
            margin-right: 10px;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: 100px;
            text-align: center;
            margin-right: 10px;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .result-title {
            text-align: center;
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .kelipatan {
            background-color: #90EE90 !important;
            font-weight: bold;
            color: #2e7d32;
        }

        .keterangan {
            font-size: 12px;
            color: #666;
            margin-left: 5px;
        }

        .error {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
        }

        .success {
            background-color: #e8f5e8;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabel Kelipatan</h1>
        
        <form method="POST" action="">
            <div class="input-area">
                <label>Masukan Kelipatan:</label>
                <input type="number" name="angka" value="<?php echo htmlspecialchars($angka_input); ?>" min="1" max="20" required>
                <button type="submit">Klik</button>
            </div>
        </form>
        
        <?php if ($result): ?>
            <?php if ($result['error']): ?>
                <div class="error"><?php echo htmlspecialchars($result['message']); ?></div>
            <?php else: ?>
                <div class="result-title">Kelipatan dari <?php echo $result['angka']; ?></div>
                
                <table>
                    <tr>
                        <th>Angka</th>
                        <th>Kelipatan</th>
                    </tr>
                    <?php foreach ($result['data'] as $row): ?>
                        <tr>
                            <td><?php echo $row['urutan']; ?></td>
                            <td class="<?php echo $row['is_kelipatan'] ? 'kelipatan' : ''; ?>">
                                <?php echo $row['hasil']; ?>
                                <?php if ($row['is_kelipatan']): ?>
                                    <span class="keterangan"> (kelipatan dari <?php echo $result['angka']; ?>)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
                <div class="success">
                    Tabel kelipatan <?php echo $result['angka']; ?> berhasil dibuat!
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        window.onload = function() {
            document.querySelector('input[name="angka"]').focus();
        };

        document.querySelector('input[name="angka"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            var angka = document.querySelector('input[name="angka"]').value;
            if (!angka || angka < 1 || angka > 20) {
                alert('Masukkan angka antara 1 sampai 20');
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>
