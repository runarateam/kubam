<?php require_once(__DIR__ . '/config/constants.php') ?>
<?php require_once(__DIR__ . '/functions/session.php') ?>
<?php require_once(__DIR__ . '/functions/helper.php') ?>
<?php require_once(__DIR__ . '/functions/guest.php') ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // ambil data inputan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // validasi input, ada yg gaboleh kosong, ada yg musti sama valuenya 
    if (empty($name)) $errors['name'] = 'Nama tidak boleh kosong';
    if (empty($email)) $errors['email'] = 'Email tidak boleh kosong';
    if (empty($username)) $errors['username'] = 'Username tidak boleh kosong';
    if (empty($password)) $errors['password'] = 'Password tidak boleh kosong';
    if ($password != $confirm_password) $errors['confirm_password'] = 'Konfirmasi password tidak sama';

    // kalo ada error validasi, lempar balik ke form asalnya
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header('Location: register.php');
        exit;
    }

    // lakukan register lalu kalo sukses lempar ke login
    if (register($name, $email, $username, $password)) {
        $_SESSION['success'] = 'Registrasi berhasil, silahkan login';
        header('Location: login.php');
    }
    exit;
}
?>

<?php
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'])
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/output.css') ?>">
</head>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <div class="w-screen h-screen flex flex-col items-center justify-center gap-6">
        <div>
            <a href="index.php" class="block text-center font-unifraktur text-mabook-light text-6xl">Maboo<span class="font-crimson">k</span></a>
            <p class="font-crimson text-mabook-light">Selamat datang!. Silahkan login terlebih dahulu</p>
        </div>
        <div class="justify-center p-8 bg-mabook-primary text-mabook-light shadow-2xl rounded-2xl w-11/12 lg:w-1/2">
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Tuliskan nama lengkap anda..." class="mabook-guest-input" value="<?= $old['name'] ?? '' ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="italic text-red-500 text-sm"><?= $errors['name'] ?></span>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Tuliskan email anda..." class="mabook-guest-input" value="<?= $old['email'] ?? '' ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="italic text-red-500 text-sm"><?= $errors['email'] ?></span>
                <?php endif; ?>

                <input type="text" name="username" placeholder="Tuliskan username..." class="mabook-guest-input" value="<?= $old['username'] ?? '' ?>">
                <?php if (isset($errors['username'])): ?>
                    <span class="italic text-red-500 text-sm"><?= $errors['username'] ?></span>
                <?php endif; ?>

                <input type="password" name="password" placeholder="Tuliskan password..." class="mabook-guest-input">
                <?php if (isset($errors['password'])): ?>
                    <span class="italic text-red-500 text-sm"><?= $errors['password'] ?></span>
                <?php endif; ?>

                <input type="password" name="confirm_password" placeholder="Konfirmasi password..." class="mabook-guest-input">
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="italic text-red-500 text-sm"><?= $errors['confirm_password'] ?></span>
                <?php endif; ?>

                <button type="submit" class="block bg-mabook-midtone p-3 text-center w-full mt-4 font-crimson font-bold text-lg cursor-pointer active:translate-y-0.5">Sign in</button>
            </form>
            <div class="italic text-sm text-center mt-2">Atau udah punya akun?, silahkan <a href="login.php" class="underline">login</a>.</div>
        </div>
    </div>
</body>

</html>