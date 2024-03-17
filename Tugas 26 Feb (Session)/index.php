<?php
session_start();

if (isset($_POST['save'])) {

    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['notelp'] = $_POST['notelp'];
    $_SESSION['alamat1'] = $_POST['alamat1'];
    $_SESSION['alamat2'] = $_POST['alamat2'];
    $_SESSION['alamat3'] = $_POST['alamat3'];

}

//ambil data session
if (isset($_SESSION['nama'])) {
    $nama = $_SESSION['nama'];
} else {
    $nama = 'No Data';
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = 'No Data';
}
if (isset($_SESSION['notelp'])) {
    $notelp = $_SESSION['notelp'];
} else {
    $notelp = 'No Data';
}
if (isset($_SESSION['alamat1'])) {
    $alamat1 = $_SESSION['alamat1'];
} else {
    $alamat1 = 'No Data';
}
if (isset($_SESSION['alamat2'])) {
    $alamat2 = $_SESSION['alamat2'];
} else {
    $alamat2 = 'No Data';
}
if (isset($_SESSION['alamat3'])) {
    $alamat3 = $_SESSION['alamat3'];
} else {
    $alamat3 = 'No Data';
}

if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Sesssion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <div class="container mt-5">
        <h2>Formulir Session</h2>
        <!-- Form -->
        <div class="card rounded-0 mt-3">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control rounded-0" name="nama" id="inputNama">
                    </div>

                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-0" name="email" id="inputEmail">
                    </div>

                    <div class="mb-3">
                        <label for="inputNoWA" class="form-label">Nomer Whatsapp</label>
                        <input type="text" class="form-control rounded-0" name="notelp" id="inputNoWA">
                    </div>

                    <div class="mb-3">
                        <label for="inputAlamat1" class="form-label">Input Alamat 1</label>
                        <input type="text" class="form-control rounded-0" name="alamat1" id="inputAlamat1">
                    </div>

                    <div class="mb-3">
                        <label for="inputAlamat2" class="form-label">Input Alamat 2</label>
                        <input type="text" class="form-control rounded-0" name="alamat2" id="inputAlamat2">
                    </div>

                    <div class="mb-3">
                        <label for="inputAlamat3" class="form-label">Input Alamat 3</label>
                        <input type="text" class="form-control rounded-0" name="alamat3" id="inputAlamat3">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger rounded-0 mx-2" name="reset" value="RESET">Reset
                            Session</button>
                        <button type="submit" class="btn btn-primary rounded-0" name="save" value="SIMPAN">Simpan ke
                            session</button>
                    </div>

                </form>

            </div>
        </div>
        <h2 class="mt-5 mb-3">Data Session</h2>
        <!-- Session Data -->
        <table class="table border mb-5">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomer Whatsapp</th>
                    <th scope="col">Alamat 1 (Kota/Kabupaten)</th>
                    <th scope="col">Alamat 2 (Kecamatan)</th>
                    <th scope="col">Alamat 3 (Kelurahan)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $nama ?>
                    </td>
                    <td>
                        <?php echo $email ?>
                    </td>
                    <td>
                        <?php echo $notelp ?>
                    </td>
                    <td>
                        <?php echo $alamat1 ?>
                    </td>
                    <td>
                        <?php echo $alamat2 ?>
                    </td>
                    <td>
                        <?php echo $alamat3 ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>