<?php
// obrada Login funkcije
require 'dbBroker.php';
require 'model/user.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username_forma = $_POST['username'];
    $password_forma = $_POST['password'];
    $id_forma = 1;

    $user = new User($id_forma, $username_forma, $password_forma);
    $result = User::logIn($user, $conn);

    if ($result->num_rows == 1) {
        $_SESSION['user_id'] = $user->id;
        header('Location: home.php');
        exit();
    } else {
        echo "Neuspesno logovanje";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FON: Zakazivanje kolokvijuma</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="login-form">
        <div class="main-div card shadow-lg p-4">
            <h2 class="text-center">Prijava</h2>
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="username">Korisničko ime</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4" name="submit">Prijavi se</button>
            </form>
        </div>
    </div>

    <!-- Modal za ažuriranje podataka -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Ažuriranje prijave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="update.php"> <!-- Promeni ovu liniju na svoju stranicu za obradu -->
                        <input type="hidden" name="id" id="modalId" value="">
                        <div class="form-group">
                            <label for="predmet">Predmet</label>
                            <input type="text" name="predmet" class="form-control" id="modalPredmet" required>
                        </div>
                        <div class="form-group">
                            <label for="katedra">Katedra</label>
                            <input type="text" name="katedra" class="form-control" id="modalKatedra" required>
                        </div>
                        <div class="form-group">
                            <label for="sala">Sala</label>
                            <input type="text" name="sala" class="form-control" id="modalSala" required>
                        </div>
                        <div class="form-group">
                            <label for="datum">Datum</label>
                            <input type="date" name="datum" class="form-control" id="modalDatum" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Ažuriraj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openUpdateModal(prijava) {
            $('#modalId').val(prijava.id);
            $('#modalPredmet').val(prijava.predmet);
            $('#modalKatedra').val(prijava.katedra);
            $('#modalSala').val(prijava.sala);
            $('#modalDatum').val(prijava.datum);

            $('#updateModal').modal('show');
        }
    </script>
</body>

</html>
