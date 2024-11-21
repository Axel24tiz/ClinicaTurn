<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Headers · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="headers.css" rel="stylesheet">
    <link href="sidebars.css" rel="stylesheet">
    <link href="sign-in.css" rel="stylesheet">
</head>

<body style="background-image:url(img/4.jpg); background-repeat: no-repeat; background-size: cover;">

    <header>
        <?php include('banner.html');
        ?>
    </header>

    <main>
        <div style="margin: 50px;">
            <div class="form-signin w-100 m-auto">

                <form action="login_2.php" class="p-4  border rounded-3 " method="post" style="background-color:aliceblue ;">

                    <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>

                    <div class="form-floating  mb-3">
                        <input type="number" name="usuario" class="form-control" id="floatingInput" placeholder="" required>
                        <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating  mb-3">
                        <input type="password" name="clave" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Clave</label>
                    </div>


                    <button class="btn btn-primary w-100 py-2" type="submit">Iniciar</button>

                </form>
            </div>
        </div>
    </main>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidebars.js"></script>




</body>

</html>