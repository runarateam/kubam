<?php include('./config/constants.php') ?>
<?php include('./functions/guest.php') ?>

<?php

// langsung lempar ke dashboard kalo udah login
if ($isLoggedIn) {
    if ($loggedUser['role'] == 'ADMIN') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: index.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = [];

    // ambil inputannya
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['old'] = $_POST;

    // validasi
    if (empty($username)) $errors['username'] = 'Username tidak boleh kosong';
    if (empty($password)) $errors['password'] = 'Password tidak boleh kosong';

    // return error kalo ada error validasi 
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit;
    }

    // lakukan login, kalo salah balikin kalo bener lempar ke dashboard
    $loggedUser = login($username, $username, $password);
    if ($loggedUser) {
        $_SESSION['logged_user'] = $loggedUser;
        if ($loggedUser['role'] == 'ADMIN') {
            header('Location: admin/dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        $_SESSION['error'] = "Username/email atau password salah.";
        header('Location: login.php');
        exit;
    }
}
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
        <div class="justify-center p-8 bg-mabook-primary text-mabook-light shadow-2xl rounded-2xl w-11/12 lg:w-1/3">
            <?php if (isset($success)) : ?>
                <div class="p-3 bg-teal-400 text-mabook-primary rounded-xl font-crimson font-semibold flex gap-2 items-center">
                    <i class="fas fa-check"></i>
                    Registrasi berhasil, silahkan login
                </div>
            <?php endif; ?>
            <?php if (isset($error)) : ?>
                <div class="p-3 bg-red-400 text-mabook-primary rounded-xl font-crimson font-semibold flex gap-2 items-center">
                    <i class="fas fa-check"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <form action="#" method="POST">
                <input type="text" name="username" placeholder="Your email/username..." class="mabook-guest-input" value="<?= $old['username'] ?? '' ?>">
                <?php if (isset($errors['username'])) : ?>
                    <span class="text-sm text-red-400 italic"><?= $errors['username'] ?></span>
                <?php endif; ?>

                <input type="password" name="password" placeholder="Your password..." class="mabook-guest-input">
                <?php if (isset($errors['password'])) : ?>
                    <span class="text-sm text-red-400 italic"><?= $errors['password'] ?></span>
                <?php endif; ?>

                <button type="submit" class="block bg-mabook-midtone p-3 text-center w-full mt-4 font-crimson font-bold text-lg cursor-pointer active:translate-y-0.5">Sign in</button>
            </form>
            <div class="italic text-sm text-center mt-2">Gapunya akun?, bikin dulu <a href="register.php" class="underline">disini</a>.</div>
        </div>
    </div>
</body>

</html>