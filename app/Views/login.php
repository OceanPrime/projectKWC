<!DOCTYPE html>
<html lang="en">
<head>
    <title>PT. CHEMCO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/assets/style.css');?>">   
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
    <div class="wrapper"> 
        <form role="form" action="">
            <h1>CHEMCO</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" value="" autofocus="">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" value="">
                <i class='bx bx-lock'></i>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>    
    </div>
</body>
</html>