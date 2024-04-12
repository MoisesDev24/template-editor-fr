<?php
    session_start();

    if (isset($_SESSION["emailAccount"])) {
        $email = $_SESSION["emailAccount"];
    } else {
        echo "<script>
            alert('Inicia sesión.');

            window.location.replace('https://plateforme.kalstein.net/login/'); 
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
    <meta name="keywords" content="keywords, relevant, to, the, site">
    <meta name="author" content="Kalstein Laboratory Equipment C.A.">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="Kalstein Laboratory Equipment C.A." />


    <!-- Titulo del sitio web -->
    <title>Éditeur - Boutique virtuelle</title>

    <!-- Enlaces a hojas de estilo -->
    <link rel="stylesheet" href="../css/editorHeader.css">
    <link rel="stylesheet" href="../css/alerta.css">
    <link rel="stylesheet" href="../css/datosTienda.css">
    <link rel="stylesheet" href="../css/tooltip.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <!-- Etiquetas Open Graph para compartir en redes sociales (opcional) -->
    <meta property="og:title" content="Editor - Tienda Virtual">
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

            <h1 class="titulo_secundario">AJOUTER LES INFORMATIONS DE LA BOUTIQUE</h1>

            <div class="contenedor_datos">
                <form action="../app/controllers/infoTienda_controller.php" data-tipo="formulario1" method="POST"
                    class="form_datos formulario_ajax" enctype="multipart/form-data">
                    <!-- Datos Generales -->
                    <div class="form_datos_informacion">
                        <?php
                            $sql = "
                                    SELECT * FROM tienda_virtual AS tv 
                                    INNER JOIN idioma_tienda AS i ON tv.ID_idioma = i.ID_idioma 
                                    WHERE ID_user = '$email';
                                ";
                            $consultaDatos = mysqli_query($conexion, $sql);
                            $datos = mysqli_fetch_array($consultaDatos);

                            if (!empty($datos['logo_t'])) {
                                $contenidoIcono = '';
                                $bottomLabel = '8%';
                            }

                            $tituloT = (!empty($datos['titulo_t'])) ? $datos['titulo_t'] : '';
                        ?>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                    Ajoutez le titre de votre Boutique Virtuelle.
                                    </p>
                                </div>
                            </div>

                            <label for="titulo_tienda">
                                Titre de la Boutique
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <input type="text" placeholder="Équipement de laboratoire Kalstein C.A."
                                name="titulo_tienda" id="titulo_tienda" minlength="5" maxlength="60"
                                value="<?php echo htmlspecialchars($tituloT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>Ajoutez le sous-titre à votre Boutique Virtuelle.
                                    </p>
                                </div>
                            </div>

                            <label for="subtitulo_tienda">
                            Sous-titre de la boutique virtuelle
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <?php
                            $subtituloT = (!empty($datos['subtitulo_t'])) ? $datos['subtitulo_t'] : '';
                            ?>
                            <input type="text" placeholder="Qualité 100% garantie!" name="subtitulo_tienda"
                                id="subtitulo_tienda" minlength="5" maxlength="70"
                                value="<?php echo htmlspecialchars($subtituloT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                    Sous-titre de la boutique virtuelle
                                    </p>
                                </div>
                            </div>

                            <label for="idioma_tienda">
                            Langue
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <select name="idioma_tienda" id="idioma_tienda" required>
                                <option value="">- Sélectionner -</option>
                                <?php
                                $sql = "SELECT * FROM idioma_tienda;";
                                $consulta = mysqli_query($conexion, $sql);

                                while ($mostrar_idioma = mysqli_fetch_array($consulta)) {
                                    $selected = ($mostrar_idioma['ID_idioma'] == $datos['ID_idioma']) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $mostrar_idioma['ID_idioma']; ?>" <?php echo $selected; ?>>
                                        <?php echo $mostrar_idioma['nombre_idioma']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                    Ajoutez la mission de votre entreprise ou produit.
                                    </p>
                                </div>
                            </div>

                            <label for="mision_tienda">
                                Mission
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <?php
                            $misionT = (!empty($datos['mision'])) ? $datos['mision'] : '';
                            ?>
                            <input type="text" placeholder="Ecris ici..." name="mision_tienda" id="mision_tienda"
                                minlength="150" value="<?php echo htmlspecialchars($misionT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>Ajoutez la vision de votre entreprise ou produit.
                                    </p>
                                </div>
                            </div>

                            <label for="vision_tienda">
                                Vision
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <?php
                            $visionT = (!empty($datos['vision'])) ? $datos['vision'] : '';
                            ?>
                            <input type="text" placeholder="Ecris ici..." name="vision_tienda" id="vision_tienda"
                                minlength="150" value="<?php echo htmlspecialchars($visionT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <label for="facebook_tienda">
                                Facebook
                            </label>

                            <?php
                            $facebookT = (!empty($datos['facebook_t'])) ? $datos['facebook_t'] : '';
                            ?>
                            <input type="text" placeholder="Collez votre lien Facebook ici..." name="facebook_tienda"
                                id="facebook_tienda" value="<?php echo htmlspecialchars($facebookT); ?>">
                        </div>

                        <div class="form_datos_item">
                            <label for="twitter_tienda">
                                Twitter (X)
                            </label>

                            <?php
                            $twitterT = (!empty($datos['twitter_t'])) ? $datos['twitter_t'] : '';
                            ?>
                            <input type="text" placeholder="Collez votre lien Twitter ici..." name="twitter_tienda"
                                id="twitter_tienda" value="<?php echo htmlspecialchars($twitterT); ?>">
                        </div>

                        <div class="form_datos_item">
                            <label for="instagram_tienda">
                                Instagram
                            </label>

                            <?php
                            $instagramT = (!empty($datos['instagram_t'])) ? $datos['instagram_t'] : '';
                            ?>
                            <input type="text" placeholder="Collez votre lien Instagram ici..." name="instagram_tienda"
                                id="instagram_tienda" value="<?php echo htmlspecialchars($instagramT); ?>">
                        </div>
                    </div>

                    <!-- Seccion de la derecha -->
                    <div class="form_datos_informacion_extra">
                        <!-- Logo de la Tienda -->
                        <div class="form_datos_logo logo_titulo">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Ajoutez le logo de votre entreprise ou produit. Il doit mesurer entre 550x220px de largeur et 250x50px de hauteur.
                                    </p>
                                </div>
                            </div>

                            <label for="logo_tienda" style="bottom: <?php echo $bottomLabel; ?>;">
                            Téléchargez un logo.
                            </label>

                            <div class="form_datos__logo drop-container" id="drop-area">
                                <?php
                                if (!empty($datos['logo_t'])) {
                                    // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                    echo '
                                            <img src="' . htmlspecialchars($datos['logo_t']) . '" id="img_insertada" alt="Logo de la tienda">
                                            <input type="hidden" name="imagen_actual" id="imagen_actual" value="' . $datos['logo_t'] . '">
                                        ';
                                }
                                ?>
                                <input type="file" name="logo_tienda" id="logo_tienda" accept="image/*">
                                <div class="contenedor_vista_previa"></div>
                            </div>

                            <div>
                                <svg class="tooltip_btn_small tooltip_logo" xmlns="http://www.w3.org/2000/svg"
                                    height="20" viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                    Ajoutez une description de votre entreprise ou produit.
                                    </p>
                                </div>
                            </div>

                            <label for="descripcion_tienda">
                                Description
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <?php
                            $descripcionT = (!empty($datos['descripcion'])) ? $datos['descripcion'] : '';
                            ?>
                            <input type="text" placeholder="Plus de 20 ans sur le marché" name="descripcion_tienda"
                                id="descripcion_tienda" minlength="200" required
                                value="<?php echo htmlspecialchars($descripcionT); ?>">
                        </div>

                        <div class="form_datos_item_extra">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                    Ajoutez l'identité de votre entreprise ou produit.
                                    </p>
                                </div>
                            </div>

                            <label for="quienes_somos">
                            Qui sommes-nous ?
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20"
                                    viewBox="0 -960 960 960" width="20">
                                    <path
                                        d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                </svg>
                            </label>

                            <?php
                            $quienesSomosT = (!empty($datos['quienes_somos_t'])) ? $datos['quienes_somos_t'] : '';
                            ?>
                            <textarea name="quienes_somos" id="quienes_somos" cols="30" rows="13" minlength="150"
                                required><?php echo htmlspecialchars($quienesSomosT); ?></textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="contenedor_datos_botones">
                        <button type="reset" class="btn_limpiar">Clair</button>
                        <button type="submit" class="btn_aceptar">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/datosTienda.js" defer></script>
    <script src="../js/ajaxInfoTienda.js" defer></script>
    <script src="../js/tooltip_dos.js" defer></script>

    <?php
    $conexion = null;
    ?>
</body>

</html>