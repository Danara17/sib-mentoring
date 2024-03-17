<?php
class Connection
{
    protected $db;

    public function __construct($host, $user, $password, $db)
    {
        $this->db = new mysqli($host, $user, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
    }
}

class Users extends Connection
{
    public function __construct($host = "localhost", $user = "root", $password = "", $db = "stupenbatch6")
    {
        parent::__construct($host, $user, $password, $db);
    }

    public function all()
    {
        $sql = 'SELECT * FROM `users` ';
        $result = $this->db->query($sql);
        $dataUsers = [];

        while ($row = $result->fetch_assoc()) {
            $dataUsers[] = $row;
        }
        return $dataUsers;
    }

    public function insert($nama, $email, $no_wa, $alamat)
    {
        if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['no_wa']) || empty($_POST['alamat'])) {
            echo "<script>alert('Semua kolom harus diisi!')</script>";
        } else {
            $sql = "INSERT INTO users (nama, email, no_wa, alamat)
            VALUES ('$nama', '$email', '$no_wa', '$alamat')";
            $this->db->query($sql);
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id='$id'";
        $this->db->query($sql);
    }

    public function update($id, $nama, $email, $no_wa, $alamat)
    {
        if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['no_wa']) || empty($_POST['alamat'])) {
            echo "<script>alert('Semua kolom harus diisi!')</script>";
        } else {
            $sql = "UPDATE users
            SET nama = '$nama', email= '$email', no_wa= '$no_wa', alamat= '$alamat'
            WHERE id = $id;";
            $this->db->query($sql);
        }
    }
}

$users = new Users();

if (isset($_POST["add_button"])) {
    $users->insert(
        $_POST['nama'],
        $_POST['email'],
        $_POST['no_wa'],
        $_POST['alamat'],
    );
    header('location:index.php');
}

if (isset($_GET['delete_button'])) {
    $users->delete($_GET['id']);
    header('location:index.php');
}

if (isset($_POST['edit_button'])) {
    $users->update(
        $_POST['id'],
        $_POST['nama'],
        $_POST['email'],
        $_POST['no_wa'],
        $_POST['alamat'],
    );
    header('location:index.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koneksi Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                Koneksi Database
            </a>
        </div>
    </nav>

    <div class="container mt-3">

        <div class="d-flex justify-content-end mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Tambah Data
            </button>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                    <input type="tel" class="form-control" id="no_wa" name="no_wa">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="add_button" value="SIMPAN" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table border text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Whatsapp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Ops</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($users->all() as $user) { ?>
                    <tr>
                        <th scope="row">
                            <?= $i; ?>
                        </th>
                        <td>
                            <?= $user['nama'] ?>
                        </td>
                        <td>
                            <?= $user['email'] ?>
                        </td>
                        <td>
                            <?= $user['no_wa'] ?>
                        </td>
                        <td>
                            <?= $user['alamat'] ?>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#editModal-<?= $user['id'] ?>">
                                edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-start">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="text" name="id" value="<?= $user['id'] ?>" hidden>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" value="<?= $user['nama'] ?>"
                                                        id="nama" name="nama">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        value="<?= $user['email'] ?>" name="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                                    <input type="tel" class="form-control" value="<?= $user['no_wa'] ?>"
                                                        id="no_wa" name="no_wa">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat"
                                                        rows="3"><?= $user['alamat'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="edit_button" value="Edit"
                                                    class="btn btn-primary">Update Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?id=<?= $user['id'] ?>&delete_button=1" class="btn btn-danger">hapus</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                } ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>