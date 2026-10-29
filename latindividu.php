<?php

//Data nilai matkul
$matkul = [
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 75],
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 90],
    ["nama" => "Sistem Basis Data", "sks" => 3, "nilai" => 87],
    ["nama" => "Desain dan Analisis Algoritma", "sks" => 3, "nilai" => 83],
    ["nama" => "Internet of Things", "sks" => 2, "nilai" => 67],
    ["nama" => "Struktur Data", "sks" => 3, "nilai" => 59],
    ["nama" => "Kalkulus", "sks" => 3, "nilai" => 57],
];

//Fungsi untuk menentukan huruf dan bobot dari nilai
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return [
            "huruf" => "A",
            "bobot" => 4.0
        ];
    } elseif ($nilai >= 70) {
        return [
            "huruf" => "B",
            "bobot" => 3.0
        ];
    } elseif ($nilai >= 60) {
        return [
            "huruf" => "C",
            "bobot" => 2.0
        ];
    } elseif ($nilai >= 50) {
        return [
            "huruf" => "D",
            "bobot" => 1.0
        ];
    } else {
        return [
            "huruf" => "E",
            "bobot" => 0.0
        ];
    }
}

//Variabel untuk hitung total sks dan bobot
$totalSks = 0;
$totalBobot = 0;
$no = 1;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nilai Mata Kuliah</title>
</head>

<body>

    <h3>Nilai Mata Kuliah</h3>

    <table border="1" cellpadding="5" style="border-collapse: collapse;">
        <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai</th>
            <th>Huruf</th>
            <th>Status</th>
        </tr>

        <?php foreach ($matkul as $data): ?>
            <?php

                // Menentukan nilai huruf dan bobot berdasarkan nilai angka
                $hasil = hitungBobot($data["nilai"]);
                
                //Menentukan status kelulusan
                if ($hasil["bobot"] >= 2.0) {
                    $status = "LULUS";
                } else {
                    $status = "MENGULANG";
                }

                //Menghitung total sks dan total bobot nilai
                $totalSks += $data["sks"];
                $totalBobot += $data["sks"] * $hasil["bobot"];
            ?>

            <tr <?= $status == "MENGULANG" ? 'style="background-color: #ffcccc;"' : '' ?>>
                <td><?= $no ?></td>
                <td><?= $data["nama"] ?></td>
                <td><?= $data["sks"] ?></td>
                <td><?= $data["nilai"] ?></td>
                <td><?= $hasil["huruf"] ?></td>
                <td><?= $status ?></td>
            </tr>

            <?php $no++; ?>

        <?php endforeach; ?>

    </table>

    <?php

        //Menghitung IPS
        $ips = $totalBobot / $totalSks;

        //Menentukan batas maksimal SKS semester berikutnya
        if ($ips >= 3.00) {
            $maxSks = 24;
        } else {
            $maxSks = 20;
        }
    ?>

    <h3>Ringkasan IPS</h3>

    <p><b>IPS:</b> <?= number_format($ips, 2) ?></p>

    <p><b>Total SKS:</b> <?= $totalSks ?></p>

    <p><b>Batas Maksimal SKS Semester Depan:</b> <?= $maxSks ?> SKS</p>

</body>
</html>