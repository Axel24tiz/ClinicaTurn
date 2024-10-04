<!DOCTYPE html> 
<html lang="en">
  <head>
    <title>ClinicaTurn</title>
    <meta property="og:title" content="ClinicaTurn" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-theme-neutral-dark);
        background: var(--dl-color-theme-neutral-light);

        fill: var(--dl-color-theme-neutral-dark);
      }
    </style>
    <link
      rel="stylesheet"
      href="https://unpkg.com/animate.css@4.1.1/animate.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/@teleporthq/teleport-custom-scripts/dist/style.css"
    />
  </head>
  <body>
  <?php
// Incluir archivos de configuración y modelos
require_once 'config/database.php';
require_once 'models/EspecialidadModel.php';
require_once 'models/MedicoModel.php';
require_once 'models/ObraSocialModel.php';
require_once 'models/PacienteModel.php';
require_once 'models/TurnoModel.php';

// Instanciar modelos
$especialidadModel = new EspecialidadModel($conn);
$medicoModel = new MedicoModel($conn);
$obraSocialModel = new ObraSocialModel($conn);
$pacienteModel = new PacienteModel($conn);
$turnoModel = new TurnoModel($conn);

// Obtener especialidades y obras sociales
$especialidades = $especialidadModel->obtenerEspecialidades();
$coberturas = $obraSocialModel->obtenerObrasSociales();

?>
    <link rel="stylesheet" href="./style.css" />
    <div>
      <link href="./index.css" rel="stylesheet" />

      <div class="home-container1">
        <navbar8-wrapper class="navbar8-wrapper">
          <!--Navbar8 component-->
          <header class="navbar8-container1">
            <header data-thq="thq-navbar" class="navbar8-navbar-interactive">
              <img
                alt="Medical Appointment Scheduler Logo"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/84ec08e8-34e9-42c7-9445-d2806d156403/fac575ac-7a41-484f-b7ac-875042de11f8?org_if_sml=1&amp;force_format=original"
                class="navbar8-image1"
              />
              <div data-thq="thq-navbar-nav" class="navbar8-desktop-menu">
                <nav class="navbar8-links1">
                  <a href="#">
                    <fragment class="home-fragment10">
                      <span class="home-text10 thq-link thq-body-small">
                        Inicio
                      </span>
                    </fragment>
                  </a>
                  <a href="#">
                    <fragment class="home-fragment11">
                      <span class="home-text11 thq-link thq-body-small">
                        Médicos
                      </span>
                    </fragment>
                  </a>
                  <a
                    href="#"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment12">
                      <span class="home-text12 thq-link thq-body-small">
                        Turnos
                      </span>
                    </fragment>
                  </a>
                  <div class="navbar8-link4-dropdown-trigger">
                    <span>
                      <fragment class="home-fragment13">
                        <span class="home-text13 thq-link thq-body-small">
                          Contactos
                        </span>
                      </fragment>
                    </span>
                    <div class="navbar8-icon-container1">
                      <div class="navbar8-container2">
                        <!--<svg viewBox="0 0 1024 1024" class="navbar8-icon10">-->
                          <path d="M298 426h428l-214 214z"></path>
                        </svg>
                      </div>
                      <div class="navbar8-container3">
                        <!--<svg viewBox="0 0 1024 1024" class="navbar8-icon12">-->
                          <path d="M426 726v-428l214 214z"></path>
                        </svg>
                      </div>
                    </div>
                  </div>
                </nav>
                <div class="navbar8-buttons1">
                <a href="#">
                  <button
                    class="navbar8-action11 thq-button-animated thq-button-filled">
                    <span class="thq-body-small">
                      <fragment class="home-fragment18">
                        <span class="home-text18">Sesion Administrativa</span>
                      </fragment>
                    </span>
                  </button>
                </a>
                  <!--<button
                    class="navbar8-action21 thq-button-outline thq-button-animated">
                    <span class="thq-body-small">
                      <fragment class="home-fragment19">
                        <span class="home-text19">Accion secundaria</span>
                      </fragment>
                    </span>
                  </button>-->
                </div>
              </div>
              <div data-thq="thq-burger-menu" class="navbar8-burger-menu">
                <svg viewBox="0 0 1024 1024" class="navbar8-icon14">
                  <path
                    d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"
                  ></path>
                </svg>
              </div>
              <div data-thq="thq-mobile-menu" class="navbar8-mobile-menu">
                <div class="navbar8-nav">
                  <div class="navbar8-top">
                    <img
                      alt="Medical Appointment Scheduler Logo"
                      src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/84ec08e8-34e9-42c7-9445-d2806d156403/fac575ac-7a41-484f-b7ac-875042de11f8?org_if_sml=1&amp;force_format=original"
                      class="navbar8-logo"
                    />
                    <div data-thq="thq-close-menu" class="navbar8-close-menu">
                      <svg viewBox="0 0 1024 1024" class="navbar8-icon16">
                        <path
                          d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                  <nav class="navbar8-links2">
                    <a href="">
                      <fragment class="home-fragment10">
                        <span class="home-text10 thq-link thq-body-small">
                          Inicio
                        </span>
                      </fragment>
                    </a>
                    <a href="#">
                      <fragment class="home-fragment11">
                        <span class="home-text11 thq-link thq-body-small">
                          Médicos
                        </span>
                      </fragment>
                    </a>
                    <a href="#">
                      <fragment class="home-fragment12">
                        <span class="home-text12 thq-link thq-body-small">
                          Turnos
                        </span>
                      </fragment>
                    </a>
                    <div class="navbar8-link4-accordion">
                      <div class="navbar8-trigger">
                        <span>
                          <fragment class="home-fragment13">
                            <span class="home-text13 thq-link thq-body-small">
                              Contactos
                            </span>
                          </fragment>
                        </span>
                        <div class="navbar8-icon-container2">
                          <div class="navbar8-container4">
                            <!--<svg viewBox="0 0 1024 1024" class="navbar8-icon18">-->
                              <path d="M298 426h428l-214 214z"></path>
                            </svg>
                          </div>
                          <div class="navbar8-container5">
                            <!--<svg viewBox="0 0 1024 1024" class="navbar8-icon20">-->
                              <path d="M426 726v-428l214 214z"></path>
                            </svg>
                          </div>
                        </div>
                      </div>
                  <div class="navbar8-buttons2">
                    <button class="thq-button-filled">
                      <span>
                        <fragment class="home-fragment18">
                          <span class="home-text18">Comenzar</span>
                        </fragment>
                      </span>
                    </button>
                    <button class="thq-button-outline">
                      <span>
                        <fragment class="home-fragment19">
                          <span class="home-text19">Accion secundaria</span>
                        </fragment>
                      </span>
                    </button>
                  </div>
                </div>
                <div class="navbar8-icon-group">
                  <svg
                    viewBox="0 0 950.8571428571428 1024"
                    class="thq-icon-x-small"
                  >
                    <path
                      d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
                    ></path></svg
                  ><svg
                    viewBox="0 0 877.7142857142857 1024"
                    class="thq-icon-x-small"
                  >
                    <path
                      d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
                    ></path></svg
                  ><svg
                    viewBox="0 0 602.2582857142856 1024"
                    class="thq-icon-small"
                  >
                    <path
                      d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"
                    ></path>
                  </svg>
                </div>
              </div>
              <div class="navbar8-container7 thq-box-shadow">
                <div class="navbar8-link5-menu-list">
                  <a href="https://www.teleporthq.io">
                    <div class="navbar8-menu-item5">
                      <img
                        alt="image"
                        src="https://images.unsplash.com/photo-1599202889720-cd3c0833efa1?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2M3w&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                        class="navbar8-page1-image2 thq-img-ratio-1-1"
                      />
                      <div class="navbar8-content5">
                        <span>
                          <fragment class="home-fragment14">
                            <span class="home-text14 thq-body-large">
                              Pagina 1
                            </span>
                          </fragment>
                        </span>
                        <span>
                          <fragment class="home-fragment20">
                            <span class="home-text20 thq-body-small">
                              Pagina 1 descripción
                            </span>
                          </fragment>
                        </span>
                      </div>
                    </div>
                  </a>
                  <a href="https://www.teleporthq.io">
                    <div class="navbar8-menu-item6">
                      <img
                        alt="image"
                        src="https://images.unsplash.com/photo-1643845892686-30c241c3938c?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NHw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                        class="navbar8-page2-image2 thq-img-ratio-1-1"
                      />
                      <div class="navbar8-content6">
                        <span>
                          <fragment class="home-fragment15">
                            <span class="home-text15 thq-body-large">
                              Pagina 2                            </span>
                          </fragment>
                        </span>
                        <span>
                          <fragment class="home-fragment21">
                            <span class="home-text21 thq-body-small">
                              Pagina 2 descripción
                            </span>
                          </fragment>
                        </span>
                      </div>
                    </div>
                  </a>
                  <a href="https://www.teleporthq.io">
                    <div class="navbar8-menu-item7">
                      <img
                        alt="image"
                        src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NHw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                        class="navbar8-page3-image2 thq-img-ratio-1-1"
                      />
                      <div class="navbar8-content7">
                        <span>
                          <fragment class="home-fragment16">
                            <span class="home-text16 thq-body-large">
                              Pagina 3
                            </span>
                          </fragment>
                        </span>
                        <span>
                          <fragment class="home-fragment22">
                            <span class="home-text22 thq-body-small">
                              Pagina 3 descripción
                            </span>
                          </fragment>
                        </span>
                      </div>
                    </div>
                  </a>
                  <a href="https://www.teleporthq.io">
                    <div class="navbar8-menu-item8">
                      <img
                        alt="image"
                        src="https://images.unsplash.com/photo-1650728670975-062f36a97c1f?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2M3w&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                        class="navbar8-page4-image2 thq-img-ratio-1-1"
                      />
                      <div class="navbar8-content8">
                        <span>
                          <fragment class="home-fragment17">
                            <span class="home-text17 thq-body-large">
                              Pagina 4
                            </span>
                          </fragment>
                        </span>
                        <span>
                          <fragment class="home-fragment23">
                            <span class="home-text23 thq-body-small">
                              Pagina 4 descripción
                            </span>
                          </fragment>
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </header>
          </header>
        </navbar8-wrapper>
        <hero17-wrapper class="hero17-wrapper">
          <!--Hero17 component-->
          <div class="hero17-header78">
            <div class="hero17-column thq-section-padding thq-section-max-width">
              <div class="hero17-content1 text-center">
                <h1>
                  <fragment class="home-fragment27">
                    <span class="home-text27 thq-heading-1">
                      Reserve sus citas médicas con facilidad
                    </span>
                  </fragment>
                </h1>
                <p>
                  <fragment class="home-fragment26">
                    <span class="home-text26 thq-body-large">
                      Bienvenido a nuestra aplicación de programación de citas donde puede reservar, administrar y monitorear fácilmente citas con médicos específicos. Diga adiós a la molestia de realizar un seguimiento manual de sus citas médicas.
                    </span>
                  </fragment>
                </p>
                <div class="hero17-actions">
                  <section class="search-form-section py-5">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-xl-8">
                          <div class="search-container">
                            <form action="controller/buscar.php" method="get">
                              <div class="field-container">
                                <div class="input-group">
                                  <label for="name">Nombre</label>
                                  <input id="name" name="name" autocomplete="off" type="text" placeholder="Por nombre..." value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" />
                                  </div>
                                <div class="input-group">
                                  <label for="specialty">Especialidad</label>
                                  <select id="specialty" name="specialty">
                                  <option value="" selected disabled>Selecciona una especialidad</option>
                                    <?php foreach ($especialidades as $especialidad): ?>
                                  <option value="<?php echo htmlspecialchars($especialidad['nombre']); ?>"
                                    <?php if (isset($_GET['specialty']) && $_GET['specialty'] == $especialidad['nombre']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($especialidad['nombre']); ?>
                                  </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="input-group">
                                  <label for="obra_social">Cobertura Médica</label>
                                  <select id="obra_social" name="obra_social">
                                  <option value="" selected disabled>Selecciona una obra social</option>
                                  <?php foreach ($coberturas as $cobertura): ?>
                                    <option value="<?php echo htmlspecialchars($cobertura['id_obra_social']); ?>"
                                    <?php if (isset($_GET['obra_social']) && $_GET['obra_social'] == $cobertura['id_obra_social']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($cobertura['nombre']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <button class="btn-naranja" type="submit">Buscar</button>

                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                
              </div>
            </div>
          </div>
        </hero17-wrapper>
        
        <features25-wrapper class="features25-wrapper">
          <!--Features25 component-->
          <div class="thq-section-padding">
            <div class="features25-container2 thq-section-max-width">
              <div class="features25-tabs-menu">
                <div class="features25-tab-horizontal1">
                  <div class="features25-divider-container1">
                    <div class="features25-container3"></div>
                  </div>
                  <div class="features25-content1">
                    <h2>
                      <fragment class="home-fragment34">
                        <span class="home-text34 thq-heading-2">
                          Programación fácil de turnos
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment37">
                        <span class="home-text37 thq-body-small">
                          Reserve citas con sus médicos preferidos sin problemas.

                        </span>
                      </fragment>
                    </span>
                  </div>
                </div>
                <div class="features25-tab-horizontal2">
                  <div class="features25-divider-container2">
                    <div class="features25-container4"></div>
                  </div>
                  <div class="features25-content2">
                    <h2>
                      <fragment class="home-fragment35">
                        <span class="home-text35 thq-heading-2">
                          Notificaciones y recordatorios
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment38">
                        <span class="home-text38 thq-body-small">
                          Reciba notificaciones y recordatorios oportunos para las próximas citas.
                        </span>
                      </fragment>
                    </span>
                  </div>
                </div>
                <div class="features25-tab-horizontal3">
                  <div class="features25-divider-container3">
                    <div class="features25-container5"></div>
                  </div>
                  <div class="features25-content3">
                    <h2>
                      <fragment class="home-fragment36">
                        <span class="home-text36 thq-heading-2">
                          Gestión de turnos
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment39">
                        <span class="home-text39 thq-body-small">
                          Administre y monitoree de manera eficiente todas sus citas médicas en un solo lugar.
                        </span>
                      </fragment>
                    </span>
                  </div>
                </div>
              </div>
              <div class="features25-image-container">
                <img
                  alt="Image depicting easy appointment scheduling"
                  src="https://images.unsplash.com/photo-1583912267856-1fcdf6e0a1f9?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NHw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                  class="features25-image1 thq-img-ratio-16-9"
                />
              </div>
            </div>
          </div>
        </features25-wrapper>
        <steps2-wrapper class="steps2-wrapper">
          <!--Steps2 component-->
          <div class="steps2-container1 thq-section-padding">
            <div class="steps2-max-width thq-section-max-width">
              <div class="steps2-container2 thq-grid-2">
                <div class="steps2-section-header">
                  <h2 class="thq-heading-2">
                    Descubra como usar nuestra app
                  </h2>
                  <p class="thq-body-large">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Suspendisse varius enim in eros elementum tristique. Duis
                    cursus, mi quis viverra ornare, eros dolor interdum nulla,
                    ut commodo diam libero vitae erat.
                  </p>
                  <div class="steps2-actions">
                    <button
                      class="thq-button-animated thq-button-filled steps2-button"
                    >
                      <span class="thq-body-small">Comenzar</span>
                    </button>
                  </div>
                </div>
                <div class="steps2-container3">
                  <div class="steps2-container4 thq-card">
                    <h2>
                      <fragment class="home-fragment40">
                        <span class="home-text40 thq-heading-2">Únete
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment44">
                        <span class="home-text44 thq-body-small">
                          Cree una cuenta en la aplicación para comenzar a programar turnos.
                        </span>
                      </fragment>
                    </span>
                    <label class="steps2-text15 thq-heading-3">01</label>
                  </div>
                  <div class="steps2-container5 thq-card">
                    <h2>
                      <fragment class="home-fragment41">
                        <span class="home-text41 thq-heading-2">
                          Buscar un médico
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment45">
                        <span class="home-text45 thq-body-small">
                          Navega por la lista de médicos disponibles y sus especialidades.

                        </span>
                      </fragment>
                    </span>
                    <label class="steps2-text18 thq-heading-3">02</label>
                  </div>
                  <div class="steps2-container6 thq-card">
                    <h2>
                      <fragment class="home-fragment42">
                        <span class="home-text42 thq-heading-2">
                          Reservar cita
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment46">
                        <span class="home-text46 thq-body-small">
                          Seleccione una fecha y franja horaria convenientes para reservar su turno con el médico elegido.

                        </span>
                      </fragment>
                    </span>
                    <label class="steps2-text21 thq-heading-3">03</label>
                  </div>
                  <div class="steps2-container7 thq-card">
                    <h2>
                      <fragment class="home-fragment43">
                        <span class="home-text43 thq-heading-2">
                          Administrar turnos
                        </span>
                      </fragment>
                    </h2>
                    <span>
                      <fragment class="home-fragment47">
                        <span class="home-text47 thq-body-small">
                          Vea, reprograme o cancele sus turnos fácilmente dentro de la aplicación.

                        </span>
                      </fragment>
                    </span>
                    <label class="steps2-text24 thq-heading-3">04</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </steps2-wrapper>
        <testimonial17-wrapper class="testimonial17-wrapper">
          <!--Testimonial17 component-->
          <div class="thq-section-padding">
            <div class="testimonial17-max-width thq-section-max-width">
              <div class="testimonial17-container10">
                <h2>
                  <fragment class="home-fragment53">
                    <span class="home-text53 thq-heading-2">
                      Testimonios de nuestros usuarios
                    </span>
                  </fragment>
                </h2>
                <span>
                  <fragment class="home-fragment52">
                    <span class="home-text52 thq-body-small">
                      ¡La aplicación de programación de citas médicas ha sido
                      una verdadera ayuda para mí! Ahora puedo reservar mis
                      citas con mis doctores favoritos de forma rápida y
                      sencilla.
                    </span>
                  </fragment>
                </span>
              </div>
              <div class="thq-grid-2">
                <div class="thq-animated-card-bg-2">
                  <div class="thq-animated-card-bg-1">
                    <div
                      data-animated="true"
                      class="thq-card testimonial17-card1"
                    >
                      <div class="testimonial17-container12">
                        <img
                          alt="Imagen de María López"
                          src="https://images.unsplash.com/photo-1521341957697-b93449760f30?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NXw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                          class="testimonial17-image1"
                        />
                        <div class="testimonial17-container13">
                          <strong>
                            <fragment class="home-fragment54">
                              <span class="home-text54 thq-body-large">
                                María López
                              </span>
                            </fragment>
                          </strong>
                          <span>
                            <fragment class="home-fragment58">
                              <span class="home-text58 thq-body-small">
                                Profesora
                              </span>
                            </fragment>
                          </span>
                        </div>
                      </div>
                      <span>
                        <fragment class="home-fragment48">
                          <span class="home-text48 thq-body-small">
                            Estoy muy satisfecha con la facilidad de uso y las
                            notificaciones que recibo para recordarme mis citas.
                            ¡Altamente recomendado!
                          </span>
                        </fragment>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="thq-animated-card-bg-2">
                  <div class="thq-animated-card-bg-1">
                    <div
                      data-animated="true"
                      class="thq-card testimonial17-card2"
                    >
                      <div class="testimonial17-container14">
                        <img
                          alt="Imagen de Juan Pérez"
                          src="https://images.unsplash.com/photo-1703925154666-7484e0ffbdc1?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2Nnw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                          class="testimonial17-image2"
                        />
                        <div class="testimonial17-container15">
                          <strong>
                            <fragment class="home-fragment55">
                              <span class="home-text55 thq-body-large">
                                Juan Pérez
                              </span>
                            </fragment>
                          </strong>
                          <span>
                            <fragment class="home-fragment59">
                              <span class="home-text59 thq-body-small">
                                Ingeniero
                              </span>
                            </fragment>
                          </span>
                        </div>
                      </div>
                      <span>
                        <fragment class="home-fragment49">
                          <span class="home-text49 thq-body-small">
                            Desde que empecé a utilizar esta aplicación, he
                            mejorado mi organización con las citas médicas. ¡Ya
                            no se me olvida ninguna cita gracias a los
                            recordatorios!
                          </span>
                        </fragment>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="thq-animated-card-bg-2">
                  <div class="thq-animated-card-bg-1">
                    <div
                      data-animated="true"
                      class="thq-card testimonial17-card3"
                    >
                      <div class="testimonial17-container16">
                        <img
                          alt="Imagen de Ana García"
                          src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2N3w&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                          class="testimonial17-image3"
                        />
                        <div class="testimonial17-container17">
                          <strong>
                            <fragment class="home-fragment56">
                              <span class="home-text56 thq-body-large">
                                Ana García
                              </span>
                            </fragment>
                          </strong>
                          <span>
                            <fragment class="home-fragment60">
                              <span class="home-text60 thq-body-small">
                                Estudiante
                              </span>
                            </fragment>
                          </span>
                        </div>
                      </div>
                      <span>
                        <fragment class="home-fragment50">
                          <span class="home-text50 thq-body-small">
                            La aplicación es muy intuitiva y me ha permitido
                            gestionar mis citas médicas de manera eficiente.
                            ¡Excelente herramienta para mantener un control de
                            mi salud!
                          </span>
                        </fragment>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="thq-animated-card-bg-2">
                  <div class="thq-animated-card-bg-1">
                    <div
                      data-animated="true"
                      class="thq-card testimonial17-card4"
                    >
                      <div class="testimonial17-container18">
                        <img
                          alt="Imagen de Carlos Martínez"
                          src="https://images.unsplash.com/photo-1464998857633-50e59fbf2fe6?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NXw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                          class="testimonial17-image4"
                        />
                        <div class="testimonial17-container19">
                          <strong>
                            <fragment class="home-fragment57">
                              <span class="home-text57 thq-body-large">
                                Carlos Martínez
                              </span>
                            </fragment>
                          </strong>
                          <span>
                            <fragment class="home-fragment61">
                              <span class="home-text61 thq-body-small">
                                Empresario
                              </span>
                            </fragment>
                          </span>
                        </div>
                      </div>
                      <span>
                        <fragment class="home-fragment51">
                          <span class="home-text51 thq-body-small">
                            Como una persona ocupada, esta aplicación ha
                            simplificado la forma en que programo mis citas
                            médicas. ¡Me ha ahorrado mucho tiempo y
                            preocupaciones!
                          </span>
                        </fragment>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </testimonial17-wrapper>
        <contact10-wrapper class="contact10-wrapper">
          <!--Contact10 component-->
          <div class="contact10-container1 thq-section-padding">
            <div class="contact10-max-width thq-section-max-width">
              <div class="contact10-content1 thq-flex-row">
                <div class="contact10-content2">
                  <h2>
                    <fragment class="home-fragment63">
                      <span class="home-text63 thq-heading-2">Ubicación</span>
                    </fragment>
                  </h2>
                  <p>
                    <fragment class="home-fragment62">
                      <span class="home-text62 thq-body-large">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Suspendisse varius enim in ero.
                      </span>
                    </fragment>
                  </p>
                </div>
              </div>
              <div class="contact10-content3 thq-flex-row">
                <div class="contact10-container2">
                  <img
                    alt="image1Alt"
                    src="https://images.unsplash.com/photo-1612537784037-898eb4583c35?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NXw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                    class="contact10-image1 thq-img-ratio-16-9"
                  />
                  <h3>
                    <fragment class="home-fragment64">
                      <span class="home-text64 thq-heading-3">Bucharest</span>
                    </fragment>
                  </h3>
                  <p>
                    <fragment class="home-fragment66">
                      <span class="home-text66 thq-body-large">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Suspendisse varius enim in ero.
                      </span>
                    </fragment>
                  </p>
                  <div class="contact10-container3">
                    <a
                      href="https://example.com"
                      target="_blank"
                      rel="noreferrer noopener"
                      class="thq-body-small thq-button-flat"
                    >
                      Obtener dirección
                    </a>
                  </div>
                </div>
                <div class="contact10-container4">
                  <img
                    alt="image2Alt"
                    src="https://images.unsplash.com/photo-1610041578702-9d4b8d7b8483?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w5MTMyMXwwfDF8cmFuZG9tfHx8fHx8fHx8MTcyNDcyMTc2NXw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080"
                    class="contact10-image2 thq-img-ratio-16-9"
                  />
                  <h3>
                    <fragment class="home-fragment65">
                      <span class="home-text65 thq-heading-3">
                        Cluj - Napoca
                      </span>
                    </fragment>
                  </h3>
                  <p>
                    <fragment class="home-fragment67">
                      <span class="home-text67 thq-body-large">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Suspendisse varius enim in ero.
                      </span>
                    </fragment>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </contact10-wrapper>
        <footer4-wrapper class="footer4-wrapper">
          <!--Footer4 component-->
          <footer class="footer4-footer7 thq-section-padding">
            <div class="footer4-max-width thq-section-max-width">
              <div class="footer4-content">
                <div class="footer4-logo1">
                  <img
                    alt="Appointment Scheduling App Logo"
                    src="https://presentation-website-assets.teleporthq.io/logos/logo.png"
                    class="footer4-logo2"
                  />
                </div>
                <div class="footer4-links">
                  <a
                    href="https://example.com"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment68">
                      <span class="home-text68 thq-body-small">Inicio</span>
                    </fragment>
                  </a>
                  <a
                    href="https://example.com"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment69">
                      <span class="home-text69 thq-body-small">Sobre nosotros</span>
                    </fragment>
                  </a>
                  <a
                    href="https://example.com"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment70">
                      <span class="home-text70 thq-body-small">Contactos</span>
                    </fragment>
                  </a>
                  <a
                    href="https://example.com"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment71">
                      <span class="home-text71 thq-body-small">FAQ</span>
                    </fragment>
                  </a>
                  <a
                    href="https://example.com"
                    target="_blank"
                    rel="noreferrer noopener"
                  >
                    <fragment class="home-fragment72">
                      <span class="home-text72 thq-body-small">
                        Terminos y condiciones
                      </span>
                    </fragment>
                  </a>
                </div>
              </div>
              <div class="footer4-credits">
                <div class="thq-divider-horizontal"></div>
                <div class="footer4-row">
                  <div class="footer4-container">
                    <span class="thq-body-small">© 2024 GROUP_FNA</span>
                  </div>
                  <div class="footer4-footer-links">
                    <span>
                      <fragment class="home-fragment75">
                        <span class="home-text75 thq-body-small">
                          Política de privacidad
                        </span>
                      </fragment>
                    </span>
                    <span>
                      <fragment class="home-fragment73">
                        <span class="home-text73 thq-body-small">
                          Términos y condiciones
                        </span>
                      </fragment>
                    </span>
                    <span>
                      <fragment class="home-fragment74">
                        <span class="home-text74 thq-body-small">
                          Política de Cookies
                        </span>
                      </fragment>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </footer>
        </footer4-wrapper>
      </div>
    </div>
    <script
      defer=""
      src="https://unpkg.com/@teleporthq/teleport-custom-scripts"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
