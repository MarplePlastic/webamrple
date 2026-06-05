<?php
$current    = 'nosotros';
$page_title = 'Nosotros';
$page_desc  = 'Conoce a Marple Chile: misión, visión y valores. Tu partner de packagings plásticos a tu medida para la industria alimentaria.';
$data       = require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';
?>

<!-- PAGE HEADER -->
<?php
$ph_eyebrow  = 'Nosotros';
$ph_title    = 'Comprometidos con crear soluciones de calidad';
$ph_subtitle = 'En Marple somos tu partner de packagings plásticos a tu medida. Trabajamos cada proyecto bajo la marca de nuestros clientes, con foco en la calidad y la eficiencia operacional.';
$ph_img      = 'assets/img/Banner-nosotros-1536x320.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<!-- MISIÓN / VISIÓN -->
<section class="container-page py-20 lg:py-24">
  <div class="grid gap-6 lg:grid-cols-2">
    <article class="card reveal border-t-4 border-brand-500">
      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon('target', 'h-6 w-6') ?></span>
      <h2 class="mt-5 text-2xl font-bold">Misión</h2>
      <p class="mt-3 leading-relaxed text-brand-800/75">
        En Marple Plastic Solution Group S.A. nos dedicamos a fabricar envases plásticos de alta calidad
        para la industria alimentaria, garantizando la inocuidad de nuestros productos, el respeto por el
        medio ambiente y la innovación constante en cada solución que entregamos. Actuamos con
        responsabilidad, compromiso y agilidad para satisfacer las necesidades de nuestros clientes,
        impulsar el desarrollo de nuestros colaboradores y contribuir al crecimiento sostenible del sector.
      </p>
    </article>
    <article class="card reveal border-t-4 border-accent-500">
      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-accent-500/10 text-accent-600"><?= marple_icon('eye', 'h-6 w-6') ?></span>
      <h2 class="mt-5 text-2xl font-bold">Visión</h2>
      <p class="mt-3 leading-relaxed text-brand-800/75">
        Ser la empresa líder en envases plásticos para la industria alimentaria, reconocida por su
        compromiso con la inocuidad, el cuidado del medio ambiente y la capacidad de ofrecer soluciones
        innovadoras, inmediatas y de alta calidad. Aspiramos a impulsar el crecimiento sostenible de
        nuestros clientes y colaboradores, consolidando a Marple Plastic Solution Group S.A. como un
        referente del sector.
      </p>
    </article>
  </div>
</section>

<!-- VALORES -->
<section class="bg-brand-50/60 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Nuestros compromisos</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Los valores que nos definen</h2>
      <p class="mt-4 text-brand-800/70">Cada decisión que tomamos parte desde estos pilares.</p>
    </div>
    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($data['values'] as $v): ?>
        <div class="card card-hover reveal">
          <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon($v['icon'], 'h-6 w-6') ?></span>
          <h3 class="mt-5 text-lg font-bold"><?= $v['title'] ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $v['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ORGANIGRAMA -->
<?php
$org_top = ['role' => 'Gerencia General', 'desc' => 'Dirección y estrategia', 'icon' => 'target'];
$org_depts = [
  ['role' => 'Producción',               'icon' => 'cube',      'roles' => ['Jefatura de Producción', 'Operarios de planta', 'Mantención']],
  ['role' => 'Calidad e Inocuidad',      'icon' => 'shield',    'roles' => ['Aseguramiento de calidad', 'Control de procesos']],
  ['role' => 'Comercial',                'icon' => 'handshake', 'roles' => ['Ejecutivos comerciales', 'Desarrollo de productos']],
  ['role' => 'Administración y Finanzas','icon' => 'users',     'roles' => ['Contabilidad', 'Recursos Humanos', 'Logística y despacho']],
];
?>
<section class="container-page py-20 lg:py-24">
  <div class="reveal mx-auto max-w-2xl text-center">
    <span class="eyebrow">Nuestro equipo</span>
    <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Organigrama</h2>
    <p class="mt-4 text-brand-800/70">Así nos organizamos para entregar soluciones de calidad en cada etapa del proceso.</p>
  </div>

  <div class="mx-auto mt-14 max-w-5xl">
    <!-- Nivel 1: Gerencia -->
    <div class="flex justify-center">
      <div class="reveal w-full max-w-xs rounded-2xl bg-brand-700 p-6 text-center text-white shadow-card">
        <span class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-white/15"><?= marple_icon($org_top['icon'], 'h-6 w-6') ?></span>
        <h3 class="mt-3 text-lg font-bold"><?= $org_top['role'] ?></h3>
        <p class="text-sm text-brand-100/80"><?= $org_top['desc'] ?></p>
      </div>
    </div>

    <!-- Conector vertical -->
    <div class="mx-auto h-6 w-0.5 bg-brand-200"></div>

    <!-- Nivel 2: Áreas -->
    <div class="relative">
      <!-- Riel horizontal (solo desktop, cuando van en una fila) -->
      <div class="absolute left-[12.5%] right-[12.5%] top-0 hidden h-0.5 bg-brand-200 lg:block"></div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:pt-6">
        <?php foreach ($org_depts as $d): ?>
          <div class="relative">
            <!-- Bajada vertical hacia el riel (desktop) -->
            <div class="absolute -top-6 left-1/2 hidden h-6 w-0.5 -translate-x-1/2 bg-brand-200 lg:block"></div>
            <article class="card card-hover reveal h-full">
              <span class="grid h-11 w-11 place-items-center rounded-xl bg-brand-50 text-brand-600"><?= marple_icon($d['icon'], 'h-6 w-6') ?></span>
              <h3 class="mt-4 text-base font-bold"><?= $d['role'] ?></h3>
              <ul class="mt-3 space-y-1.5">
                <?php foreach ($d['roles'] as $r): ?>
                  <li class="flex items-start gap-2 text-sm text-brand-800/70">
                    <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                    <?= $r ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- POLÍTICA DE CALIDAD E INOCUIDAD -->
<?php
$policy_lead = 'En Marple Plastic Solution Group S.A. somos una empresa líder en la fabricación y comercialización de envases seguros, auténticos, inocuos y de alta calidad para la industria alimentaria, cumpliendo con los requisitos legales, reglamentarios, normativos y de nuestros clientes.';
$policy_pillars = [
  ['icon' => 'shield', 'title' => 'Gestión preventiva de peligros',
   'text' => 'Garantizamos la inocuidad, autenticidad, legalidad y calidad de nuestros productos mediante la aplicación del pensamiento basado en riesgos, la gestión preventiva de peligros, la protección frente al fraude, la defensa del producto y de amenazas intencionales, a través del control de materias primas, la evaluación y desarrollo continuo de proveedores y la implementación de controles eficaces en todas las etapas de nuestros procesos.'],
  ['icon' => 'users', 'title' => 'Cultura de calidad e inocuidad',
   'text' => 'Promovemos y fortalecemos una cultura de calidad e inocuidad en toda la organización, basada en el liderazgo visible, la responsabilidad individual y colectiva, la comunicación abierta, la participación activa de los trabajadores y la formación continua, asegurando el desarrollo permanente de competencias en calidad, inocuidad, seguridad y buenas prácticas de manufactura.'],
  ['icon' => 'spark', 'title' => 'Mejora continua',
   'text' => 'Nos comprometemos con la mejora continua y la eficacia de nuestro Sistema de Gestión de Inocuidad Alimentaria, asegurando la comunicación interna y externa efectiva con clientes, proveedores, autoridades regulatorias y las partes interesadas relevantes.'],
  ['icon' => 'handshake', 'title' => 'Compromiso de la alta dirección',
   'text' => 'La alta dirección se compromete con el Sistema de Gestión de Inocuidad de los Alimentos, asegurando los recursos necesarios para su implementación y mejora continua. Asimismo, garantiza la disponibilidad de infraestructura y condiciones adecuadas para proteger la seguridad y salud de los trabajadores, promoviendo ambientes de trabajo seguros. Además, desarrolla sus operaciones bajo un enfoque de sostenibilidad, fomentando la prevención de la contaminación, el uso responsable de los recursos y el cumplimiento de los compromisos ambientales.'],
];
?>
<section id="politica" class="scroll-mt-24 bg-brand-50 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Nuestro compromiso</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Política de Calidad e Inocuidad</h2>
    </div>

    <!-- Declaración principal -->
    <div class="reveal mx-auto mt-10 max-w-4xl overflow-hidden rounded-3xl bg-brand-700 text-white shadow-card">
      <div class="relative p-8 sm:p-12">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/5" aria-hidden="true"></div>
        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white/15"><?= marple_icon('shield', 'h-6 w-6') ?></span>
        <p class="relative mt-5 text-lg font-medium leading-relaxed sm:text-xl">“<?= $policy_lead ?>”</p>
      </div>
    </div>

    <!-- Pilares -->
    <div class="mx-auto mt-8 grid max-w-4xl gap-6 md:grid-cols-2">
      <?php foreach ($policy_pillars as $p): ?>
        <article class="card reveal h-full">
          <span class="grid h-11 w-11 place-items-center rounded-xl bg-accent-500/10 text-accent-600"><?= marple_icon($p['icon'], 'h-6 w-6') ?></span>
          <h3 class="mt-4 text-base font-bold"><?= $p['title'] ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-brand-800/75"><?= $p['text'] ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="container-page py-20 lg:py-24">
  <div class="reveal flex flex-col items-center justify-between gap-6 rounded-3xl bg-brand-900 px-8 py-12 text-center sm:flex-row sm:text-left">
    <div>
      <h2 class="text-2xl font-bold text-white">Trabajemos juntos en tu próximo envase</h2>
      <p class="mt-2 text-brand-100/80">Desarrollamos la solución plástica ideal para tu marca.</p>
    </div>
    <a href="contacto.php" class="btn-primary shrink-0">Solicitar cotización <?= marple_icon('arrow', 'h-4 w-4') ?></a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
