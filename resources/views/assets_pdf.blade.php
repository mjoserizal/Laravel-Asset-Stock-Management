<!DOCTYPE html>
<html>
<head>
    <title>Barcode Obat</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>Daftar Aset dengan Barcode</h1>
<table>
    <thead>
    <tr>
        <th>Barcode</th>
        <th>Nama Obat</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assets as $asset)
        <tr>
            <td>
                    <?php
                    $barcodeContent = $asset->name; // Menggunakan nama aset langsung sebagai konten barcode
                    echo DNS1D::getBarcodeHTML($barcodeContent, 'C39', 1, 40);
                    ?>
            </td>
            <td>{{ $asset->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
