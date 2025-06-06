<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/output.css">
</head>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <div class="w-screen h-screen flex flex-col items-center justify-center gap-6">
        <div>
            <div class="text-center font-unifraktur text-mabook-light text-6xl">Maboo<span class="font-crimson">k</span></div>
            <p class="font-crimson text-mabook-light">Selamat datang!. Silahkan login terlebih dahulu</p>
        </div>
        <div class="justify-center p-8 bg-mabook-primary text-mabook-light shadow-2xl rounded-2xl">
            <form action="#">
                <input type="text" name="username" placeholder="Your email/username..." class="w-full mt-4 p-3 placeholder:text-mabook-light text-mabook-light font-crimson text-lg focus:outline-none border border-mabook-midtone/40">
                <input type="password" name="password" placeholder="Your password..." class="w-full mt-4 p-3 placeholder:text-mabook-light text-mabook-light font-crimson text-lg focus:outline-none border border-mabook-midtone/40">
                <button type="submit" class="bg-mabook-midtone p-3 text-center w-full mt-4 font-crimson font-bold text-lg cursor-pointer active:translate-y-0.5">Sign in</button>
            </form>
        </div>
    </div>
</body>

</html>