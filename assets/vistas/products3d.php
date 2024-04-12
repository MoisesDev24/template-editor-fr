<?php
session_start();

if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];

    require_once __DIR__ . "/../app/config/main.php";

    $sql_usuarios = "SELECT * FROM wp_account WHERE account_correo = '$email';";
    $conexion_bd = conexion();
    $consulta_usuario = mysqli_query($conexion_bd, $sql_usuarios);

    if (!$consulta_usuario) {
        mostrarError("Erreur lors de la consultation de la base de données.");
    }

    $nombreUsuario = mysqli_fetch_array($consulta_usuario);

    if (!$nombreUsuario) {
        mostrarError("
        Utilisateur non trouvé.");
    }

    $sql_productos = "SELECT * FROM render_product WHERE ID_user = '$email';";
    $consulta_productos = mysqli_query($conexion_bd, $sql_productos);

    if (!$consulta_productos) {
        mostrarError("Erreur lors de la consultation de la base de données.");
    }

    $productos = [];

    while ($producto = mysqli_fetch_assoc($consulta_productos)) {
        $productos[] = $producto;
    }
} else {
    echo "<script>
            alert('Inicia sesión.');

            window.location.replace('https://plateforme.kalstein.net/acceder/'); 
            </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Chez Kalstein France, situé à Paris - France, nous sommes une entreprise avec une vaste expérience dans la fabrication et l'exportation d'équipements de laboratoire de haute qualité, ayant l'honnêteté, la responsabilité et la communication comme fondement dans le développement de chacun de nos produits.">
    <meta name="keywords" content="palabras clave, relevantes, para, el, sitio">
    <meta name="author" content="Kalstein Equipos para Laboratorios C.A.">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="Kalstein Equipos para Laboratorios C.A." />

    <!-- Titulo del sitio web -->
    <title>Éditeur - Boutique virtuelle</title>

    <!-- Enlaces a hojas de estilo -->
    <link rel="stylesheet" href="../css/editorHeader.css">
    <link rel="stylesheet" href="../css/alerta.css">
    <link rel="stylesheet" href="../css/products3d.css">
    <link rel="stylesheet" href="../css/tooltip.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <!-- Etiquetas Open Graph para compartir en redes sociales (opcional) -->
    <meta property="og:title" content="Éditeur - Boutique virtuelle">
    <meta property="og:description"
        content="Chez Kalstein France, situé à Paris - France, nous sommes une entreprise avec une vaste expérience dans la fabrication et l'exportation d'équipements de laboratoire de haute qualité, ayant l'honnêteté, la responsabilité et la communication comme fondement dans le développement de chacun de nos produits.">
    <meta property="og:image" content="url_de_la_imagen">
    <meta property="og:url" content="URL_del_sitio">
    <meta property="og:type" content="website">

    <!-- Estilos CSS adicionales (por ejemplo, fuentes externas) -->
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet">
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
</head>

<body>

    <?php
    require_once "../app/config/main.php";
    $conexion = conexion();
    ?>

    <?php
    include ("../includes/header_dos.php");
    ?>

    <main class="wrapper">
        <!-- MODAL DEL PERFIL -->
        <div class="modal_perfil_usuario">
            <a href="https://plateforme.kalstein.net/distribuidor/configuracion/">Profil</a>
        </div>

        <?php
        include ("../includes/barra_lateral_dos.php");
        ?>

        <div class="contenido">
            <div class="resultado_formulario"></div>

            <h1 class="titulo_secundario">RENDEZ VOS PRODUITS EN 3D</h1>

            <div class="contenedor_datos">
                <div class="contenedor_products3d">
                    <div class="contenedor_parrafo">
                        <p>
                        Ensuite, vous devez choisir les produits que vous souhaitez rendre pour obtenir un modèle 3D d'eux, et ainsi pouvoir les visualiser dans votre boutique.
                        </p>
                    </div>

                    <div class="contenedor_inputs_radio">
                        <label class="switch">
                            <input type="checkbox" id="checkboxUnico">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <!-- Individual upload form -->
                    <form action="../app/controllers/products3d_controller.php" data-tipo="formulario4" method="POST"
                        class="formulario_products3d formUploadSingle formulario_ajax sombra"
                        enctype="multipart/form-data" id="formUploadSingle" style="display:none;">
                        <!-- Form Header -->
                        <div class="form_header_container">
                            <h2 class="titulo_products3d">Sélectionnez le produit que vous souhaitez rendre.</h2>
                            <span class="max_ten_products">Max. 5 Produits</span>

                            <button type="button" class="btn_selec_img_ind myBtn">
                            Sélectionner
                            </button>
                        </div>

                        <div class="container_father" id="container_father">
                            <!-- Aqui se insertan los elementos desde JavaScript -->
                        </div>

                        <!-- Modal Images Select -->
                        <div id="myModal" style="display:none;">
                            <div class="contenedor_modal_products">
                                <div class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <span class="close">&times;</span>

                                        <div class="selects">
                                            <input type="search" name="searchP" id="searchP"
                                                placeholder="Buscar Imagen" />
                                        </div>

                                        <!-- Galery Products -->
                                        <div class="gallery-container">
                                            <?php
                                            require_once "../app/sql/sql_renderProducts.php";

                                            if (mysqli_num_rows($consulta_productsToRender) > 0) {
                                                $contador = 1;
                                                while ($renderProducts = mysqli_fetch_array($consulta_productsToRender)) {

                                                    echo '
                                                        <div class="gallery-item" id="renderProduct' . $contador . '">
                                                            <img src="' . $renderProducts["product_image"] . '" alt="' . $renderProducts["product_name_es"] . '">
                                                        </div>
                                                    ';

                                                    $contador++;
                                                }
                                            } else {
                                                echo '
                                                    <div class="gallery-item">
                                                        <img src="../img/banner-default.png" alt="Img Frame">
                                                    </div>
                                                ';
                                            }
                                            ?>
                                        </div>

                                        <button id="selectImageBtn">
                                        Sélectionner une image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden file input -->
                        <input type="hidden" id="hiddenImageUrl" name="imageURL" required>
                        <input type="hidden" id="hiddenImageUrlTwo" name="imageURLTwo">
                        <input type="hidden" id="hiddenImageUrlThree" name="imageURLThree">
                        <input type="hidden" id="hiddenImageUrlFour" name="imageURLFour">
                        <input type="hidden" id="hiddenImageUrlFive" name="imageURLFive">

                        <!-- Buttoms -->
                        <div class="contenedor_datos_botones">
                            <button type="reset" class="btn_limpiar" id="btn_limpiar">Clair</button>
                            <button type="submit" class="btn_aceptar">Sauvegarder</button>
                        </div>
                    </form>

                </div>
                <div class="sombra mt-2">
                    <div class="table100">
                        <h3 class="titulo-table">Produits en attente de rendu.</h3>
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th class="column1">Image</th>
                                    <th class="column2">Date de demande</th>
                                    <th class="column3">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="column1">
                                            <img class="img_table" src="<?= htmlspecialchars($producto['image_url']) ?>"
                                                alt="Imagen de producto">
                                        </td>
                                        <td class="column2">
                                            <?= htmlspecialchars($producto['fecha_solicitud']) ?>
                                        </td>
                                        <td class="column3">
                                            <?= htmlspecialchars($producto['estado']) ?>
                                            <?php if ($producto['estado'] === 'Renderizado'): ?>
                                                <a href="<?= htmlspecialchars($producto['resultado_renderP']) ?>" download
                                                    class="btn_download_model">
                                                    <i class="fas fa-download dwl-icon"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/products3d.js" defer></script>
    <script src="../js/ajaxProducts3d.js" defer></script>
    <script src="../js/tooltip.js" defer></script>

    <?php
    $conexion = null;
    ?>
</body>

</html>