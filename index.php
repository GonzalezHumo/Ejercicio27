<?php
// ═══════════════════════════════════════════════════════════════
//  Determinar qué práctica mostrar
// ═══════════════════════════════════════════════════════════════
$p = isset($_GET['p']) ? (int)$_GET['p'] : 0;

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 21 – Operaciones aritméticas
// ───────────────────────────────────────────────────────────────
$res21 = null;
if ($p === 21 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $a  = (isset($_POST['a']) && $_POST['a'] !== '') ? (float)$_POST['a'] : null;
    $b  = (isset($_POST['b']) && $_POST['b'] !== '') ? (float)$_POST['b'] : null;
    $op = $_POST['op'] ?? '';
    $ops_validas = ['suma', 'resta', 'division', 'exponenciacion'];
    if ($a === null || $b === null || !in_array($op, $ops_validas)) {
        $res21 = ['error' => 'Por favor ingresa ambos valores y selecciona una operación.'];
    } elseif ($op === 'division' && $b == 0) {
        $res21 = ['error' => 'No se puede dividir entre cero.'];
    } else {
        if      ($op === 'suma')            $resultado = $a + $b;
        elseif  ($op === 'resta')           $resultado = $a - $b;
        elseif  ($op === 'division')        $resultado = $a / $b;
        else                                $resultado = $a ** $b;
        $res21 = ['a'=>$a, 'b'=>$b, 'op'=>$op, 'resultado'=>round($resultado, 6)];
    }
}

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 22 – Fórmula general (cuadrática)
// ───────────────────────────────────────────────────────────────
$res22 = null;
if ($p === 22 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (isset($_POST['a']) && $_POST['a'] !== '') ? (float)$_POST['a'] : null;
    $b = (isset($_POST['b']) && $_POST['b'] !== '') ? (float)$_POST['b'] : null;
    $c = (isset($_POST['c']) && $_POST['c'] !== '') ? (float)$_POST['c'] : null;
    if ($a === null || $b === null || $c === null) {
        $res22 = ['error' => 'Por favor ingresa los tres coeficientes.'];
    } elseif ($a == 0) {
        $res22 = ['error' => 'El coeficiente "a" no puede ser 0 (no sería una ecuación cuadrática).'];
    } else {
        $disc = ($b ** 2) - (4 * $a * $c);
        if ($disc < 0) {
            $res22 = ['error' => "El discriminante es $disc. La ecuación no tiene soluciones reales (raíces complejas)."];
        } else {
            $x1 = round((-$b - sqrt($disc)) / (2 * $a), 6);
            $x2 = round((-$b + sqrt($disc)) / (2 * $a), 6);
            $res22 = ['a'=>$a, 'b'=>$b, 'c'=>$c, 'disc'=>$disc, 'x1'=>$x1, 'x2'=>$x2];
        }
    }
}

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 23 – Calculadora IMC
// ───────────────────────────────────────────────────────────────
$res23 = null;
if ($p === 23 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $peso     = (isset($_POST['peso'])     && $_POST['peso']     !== '') ? (float)$_POST['peso']     : null;
    $estatura = (isset($_POST['estatura']) && $_POST['estatura'] !== '') ? (float)$_POST['estatura'] : null;
    if ($peso === null || $estatura === null) {
        $res23 = ['error' => 'Por favor ingresa tu peso y estatura.'];
    } elseif ($peso <= 0 || $estatura <= 0) {
        $res23 = ['error' => 'Los valores deben ser mayores a 0.'];
    } elseif ($estatura > 3) {
        $res23 = ['error' => 'Ingresa la estatura en metros (ej. 1.65, no 165).'];
    } else {
        $imc = round($peso / ($estatura ** 2), 2);
        if ($imc < 18.5) {
            $grado = 'Bajo peso';       $desc = 'Tu peso está por debajo del rango saludable. Se recomienda consultar a un especialista.'; $seg = 1; $color = '#1a4a6a'; $bg = '#e0f0fc';
        } elseif ($imc <= 24.9) {
            $grado = 'Peso normal';     $desc = '¡Felicidades! Tu peso se encuentra dentro del rango saludable.';                          $seg = 2; $color = '#1a5a30'; $bg = '#e0f5ea';
        } elseif ($imc <= 29.9) {
            $grado = 'Sobrepeso';       $desc = 'Tu peso supera el rango saludable. Se recomienda mejorar hábitos alimenticios y actividad física.'; $seg = 3; $color = '#7a5a10'; $bg = '#fdf5d0';
        } elseif ($imc <= 39.9) {
            $grado = 'Obesidad grado I';$desc = 'Existe un riesgo moderado para la salud. Es importante consultar a un médico.';           $seg = 4; $color = '#7a3a10'; $bg = '#fde8d4';
        } else {
            $grado = 'Obesidad grado II';$desc= 'Riesgo muy alto para la salud. Se recomienda atención médica especializada urgente.';     $seg = 5; $color = '#7a2020'; $bg = '#fdd4d4';
        }
        $res23 = ['peso'=>$peso, 'estatura'=>$estatura, 'imc'=>$imc, 'grado'=>$grado, 'desc'=>$desc, 'seg'=>$seg, 'color'=>$color, 'bg'=>$bg, 'est2'=>round($estatura**2,4)];
    }
}

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 24 – Fecha actual 
// ───────────────────────────────────────────────────────────────
$fecha24 = null;
if ($p === 24) {
    $dias  = ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'];
    $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $fecha24 = [
        'dia_nombre' => $dias[(int)date('w')],
        'dia_num'    => (int)date('j'),
        'mes'        => $meses[(int)date('n') - 1],
        'anio'       => (int)date('Y'),
    ];
}

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 25 – Tablas del 1 al 10 
// ───────────────────────────────────────────────────────────────
// Sin POST; se genera directamente al renderizar la sección.

// ───────────────────────────────────────────────────────────────
//  PRÁCTICA 26 – Tablas hasta N
// ───────────────────────────────────────────────────────────────
$res26 = null;
if ($p === 26 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_raw = $_POST['n'] ?? '';
    $n     = ($n_raw !== '') ? (int)$n_raw : null;
    if ($n === null || $n <= 0) {
        $res26 = ['error' => 'Por favor ingresa un número entero positivo.'];
    } else {
        $res26 = ['n' => $n];
    }
}

// ───────────────────────────────────────────────────────────────
//  Helpers
// ───────────────────────────────────────────────────────────────
function op_nombre($op) {
    return ['suma'=>'Suma','resta'=>'Resta','division'=>'División','exponenciacion'=>'Exponenciación'][$op] ?? $op;
}
function op_simbolo($op) {
    return ['suma'=>'+','resta'=>'−','division'=>'÷','exponenciacion'=>'^'][$op] ?? '';
}
function op_color($op) {
    return ['suma'=>'#5aaa7a','resta'=>'#d4804a','division'=>'#4a9cc8','exponenciacion'=>'#7a60c8'][$op] ?? '#888';
}
function op_bg($op) {
    return ['suma'=>'#d4f0e0','resta'=>'#fde8d4','division'=>'#d4ecf8','exponenciacion'=>'#e8e0f8'][$op] ?? '#eee';
}

$menu = [
    21 => ['Operaciones Aritméticas', '+−÷^'],
    22 => ['Fórmula General', 'ax²+bx+c'],
    23 => ['Calculadora IMC', 'kg/m²'],
    24 => ['Fecha Actual', ''],
    25 => ['Tablas 1–10', '×'],
    26 => ['Tablas hasta N', '×N'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>González Humo · Prácticas 21–26 (PHP)</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet"/>
  <style>
    /* ── Variables ───────────────────────────── */
    :root {
      --bg:#f7f5f2; --border:#e8e2db;
      --accent:#a8d8b9;  --accent2:#f7c5a0;
      --accent3:#c5b8f0; --accent4:#a8d4f0;
      --accent-dk:#5aaa7a;  --accent2-dk:#d4804a;
      --accent3-dk:#7a60c8; --accent4-dk:#4a9cc8;
      --text:#2d2a26; --muted:#9e9890; --card:#fff;
    }
    /* ── Reset ───────────────────────────────── */
    *{box-sizing:border-box;margin:0;padding:0;}
    body{background:var(--bg);color:var(--text);font-family:'Nunito',sans-serif;min-height:100vh;}
    body::before{
      content:'';position:fixed;inset:0;pointer-events:none;z-index:0;
      background-image:linear-gradient(rgba(168,216,185,.15) 1px,transparent 1px),
                       linear-gradient(90deg,rgba(168,216,185,.15) 1px,transparent 1px);
      background-size:40px 40px;
    }
    .wrap{max-width:900px;margin:0 auto;padding:48px 20px 80px;position:relative;z-index:1;}

    /* ── Header ──────────────────────────────── */
    .site-header{text-align:center;margin-bottom:44px;animation:fadeDown .7s ease both;}
    .site-header h1{
      font-family:'Playfair Display',serif;
      font-size:clamp(1.8rem,5vw,3rem);font-weight:800;line-height:1.1;
    }
    .site-header h1 span{color:var(--accent-dk);}
    .site-header p{margin-top:10px;color:var(--muted);font-size:.82rem;line-height:1.8;}

    /* ── Menú de prácticas ───────────────────── */
    .menu-grid{
      display:grid;grid-template-columns:repeat(3,1fr);gap:14px;
      margin-bottom:40px;animation:fadeUp .7s .1s ease both;
    }
    @media(max-width:560px){.menu-grid{grid-template-columns:repeat(2,1fr);}}
    .menu-btn{
      display:flex;flex-direction:column;align-items:center;gap:6px;
      background:var(--card);border:1.5px solid var(--border);border-radius:16px;
      padding:18px 10px;text-decoration:none;color:var(--text);
      transition:transform .15s,box-shadow .15s,border-color .15s;
      position:relative;overflow:hidden;
    }
    .menu-btn::before{
      content:'';position:absolute;top:0;left:0;right:0;height:3px;
      background:linear-gradient(90deg,var(--accent),var(--accent3),var(--accent2));
    }
    .menu-btn:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(0,0,0,.08);}
    .menu-btn.active{border-color:var(--accent);background:#f0faf4;}
    .menu-btn .mb-num{
      font-size:.6rem;letter-spacing:.15em;text-transform:uppercase;
      color:var(--muted);font-weight:700;
    }
    .menu-btn .mb-icon{font-size:1.1rem;color:var(--accent-dk);font-weight:800;}
    .menu-btn .mb-title{font-size:.75rem;font-weight:800;text-align:center;line-height:1.3;}
    .menu-btn.active .mb-title{color:var(--accent-dk);}

    /* ── Tarjeta genérica ────────────────────── */
    .card{
      background:var(--card);border:1.5px solid var(--border);
      border-radius:18px;padding:32px;margin-bottom:28px;
      position:relative;overflow:hidden;
      box-shadow:0 4px 20px rgba(0,0,0,.05);
      animation:fadeUp .6s .15s ease both;
    }
    .card::before{
      content:'';position:absolute;top:0;left:0;right:0;height:4px;
      background:linear-gradient(90deg,var(--accent),var(--accent3),var(--accent2));
    }
    .card h2{
      font-size:.8rem;font-weight:800;text-transform:uppercase;
      letter-spacing:.12em;color:var(--muted);margin-bottom:22px;
    }

    /* ── Inputs ──────────────────────────────── */
    .inputs-row{display:grid;gap:18px;margin-bottom:26px;}
    .col2{grid-template-columns:1fr 1fr;}
    .col3{grid-template-columns:1fr 1fr 1fr;}
    @media(max-width:500px){.col2,.col3{grid-template-columns:1fr;}}
    .ig{display:flex;flex-direction:column;gap:7px;}
    .ig label{font-size:.68rem;text-transform:uppercase;letter-spacing:.12em;color:var(--muted);font-weight:700;}
    .ig .hint{font-size:.65rem;color:var(--muted);margin-top:-3px;}
    .ig input{
      background:var(--bg);border:1.5px solid var(--border);border-radius:10px;
      padding:13px 14px;font-family:'Nunito',sans-serif;
      font-size:1.3rem;font-weight:800;color:var(--text);
      text-align:center;outline:none;width:100%;
      transition:border-color .2s,box-shadow .2s;
    }
    .ig input:focus{border-color:var(--accent3);box-shadow:0 0 0 3px rgba(197,184,240,.3);}
    .ig input::placeholder{color:#ccc;font-size:1rem;font-weight:400;}

    /* ── Botones de operación (P21) ──────────── */
    .op-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:0;}
    @media(max-width:540px){.op-grid{grid-template-columns:repeat(2,1fr);}}
    .op-btn{
      border:none;border-radius:12px;padding:14px 8px;cursor:pointer;
      font-family:'Nunito',sans-serif;font-size:.82rem;font-weight:800;
      display:flex;flex-direction:column;align-items:center;gap:5px;
      transition:transform .15s,box-shadow .15s;
    }
    .op-btn:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(0,0,0,.08);}
    .op-btn .sym{font-size:1.4rem;line-height:1;}
    .op-btn .lbl{font-size:.68rem;}
    .btn-s{background:#d4f0e0;color:#5aaa7a;}
    .btn-r{background:#fde8d4;color:#d4804a;}
    .btn-d{background:#d4ecf8;color:#4a9cc8;}
    .btn-e{background:#e8e0f8;color:#7a60c8;}

    /* ── Botón principal ─────────────────────── */
    .main-btn{
      width:100%;background:linear-gradient(135deg,var(--accent3),var(--accent));
      color:#fff;border:none;border-radius:12px;padding:15px;
      font-family:'Nunito',sans-serif;font-size:1rem;font-weight:800;
      cursor:pointer;letter-spacing:.04em;
      transition:transform .15s,opacity .15s,box-shadow .15s;
    }
    .main-btn:hover{transform:translateY(-2px);opacity:.92;box-shadow:0 8px 20px rgba(197,184,240,.4);}

    /* ── Alertas ─────────────────────────────── */
    .alert{
      background:#fff4f4;border:1.5px solid #f0c0c0;border-radius:12px;
      padding:13px 18px;color:#a04040;font-size:.82rem;font-weight:600;
      margin-bottom:20px;animation:fadeIn .3s ease;
    }

    /* ── Resultado P21 ───────────────────────── */
    .res21{
      background:var(--card);border:1.5px solid var(--border);border-radius:18px;
      overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.05);
      animation:popIn .4s ease;
    }
    .res21 .rh{
      background:#f4f2ef;padding:12px 22px;border-bottom:1.5px solid var(--border);
      font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;
      display:flex;justify-content:space-between;
    }
    .res21 .rb{padding:24px 28px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;}
    .res21 .rb .formula{font-size:1.1rem;font-weight:800;}
    .res21 .rb .value{font-size:2.8rem;font-weight:800;text-align:right;}
    .res21 .rb .eq{font-size:.72rem;color:var(--muted);margin-bottom:3px;}

    /* ── Resultado P22 ───────────────────────── */
    .res22{
      background:var(--card);border:1.5px solid var(--border);border-radius:18px;
      overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.05);
      animation:popIn .4s ease;
    }
    .res22 .rh{background:#f4f2ef;padding:12px 22px;border-bottom:1.5px solid var(--border);font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;}
    .res22 .rb{padding:24px 28px;}
    .xgrid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;}
    @media(max-width:460px){.xgrid{grid-template-columns:1fr;}}
    .xbox{border-radius:14px;padding:18px 22px;text-align:center;}
    .xbox .xl{font-size:.68rem;text-transform:uppercase;letter-spacing:.12em;font-weight:700;margin-bottom:7px;}
    .xbox .xv{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:800;}
    .xbox.x1b{background:#f0ebff;} .xbox.x1b .xl,.xbox.x1b .xv{color:#7a60c8;}
    .xbox.x2b{background:#edf9f4;} .xbox.x2b .xl,.xbox.x2b .xv{color:#5aaa7a;}
    .out-msg{background:var(--bg);border:1.5px solid var(--border);border-radius:12px;padding:16px 20px;font-size:.83rem;line-height:2;color:#555;}
    .out-msg strong{font-weight:800;}

    /* ── Resultado P23 ───────────────────────── */
    .res23{background:var(--card);border:1.5px solid var(--border);border-radius:18px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.05);animation:popIn .4s ease;}
    .res23 .rh{background:#f4f2ef;padding:12px 22px;border-bottom:1.5px solid var(--border);font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;}
    .res23 .rb{padding:24px 28px;}
    .imc-disp{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;margin-bottom:20px;}
    .imc-num .lbl{font-size:.68rem;text-transform:uppercase;letter-spacing:.12em;font-weight:700;color:var(--muted);margin-bottom:5px;}
    .imc-num .val{font-family:'Playfair Display',serif;font-size:4rem;font-weight:800;line-height:1;}
    .imc-num .unit{font-size:.75rem;color:var(--muted);margin-top:3px;}
    .imc-grade{flex:1;min-width:180px;border-radius:14px;padding:18px 20px;}
    .imc-grade .gl{font-size:.65rem;text-transform:uppercase;letter-spacing:.12em;font-weight:700;margin-bottom:7px;}
    .imc-grade .gv{font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:800;line-height:1.2;}
    .imc-grade .gd{font-size:.73rem;margin-top:5px;line-height:1.5;}
    .scale-bar{display:grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr;border-radius:10px;overflow:hidden;height:34px;margin-bottom:4px;}
    .seg{display:flex;align-items:center;justify-content:center;font-size:.58rem;font-weight:700;}
    .seg.s1{background:#a8d4f0;color:#1a4a6a;}
    .seg.s2{background:#a8d8b9;color:#1a5a30;}
    .seg.s3{background:#f7e6a0;color:#7a5a10;}
    .seg.s4{background:#f7c5a0;color:#7a3a10;}
    .seg.s5{background:#f0a0a0;color:#7a2020;}
    .seg.active{filter:brightness(.82);outline:3px solid #2d2a26;outline-offset:-2px;}
    .scale-rng{display:grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr;margin-bottom:18px;}
    .scale-rng span{font-size:.56rem;color:var(--muted);text-align:center;}

    /* ── Referencia IMC ──────────────────────── */
    .ref-card{background:var(--card);border:1.5px solid var(--border);border-radius:18px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.04);}
    .ref-card .rh{background:#f4f2ef;padding:12px 22px;border-bottom:1.5px solid var(--border);font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;}
    table{width:100%;border-collapse:collapse;font-size:.78rem;}
    th{background:#f9f7f4;padding:9px 14px;text-align:left;color:var(--muted);font-size:.63rem;letter-spacing:.1em;text-transform:uppercase;border-bottom:1.5px solid var(--border);}
    td{padding:10px 14px;border-bottom:1px solid #f4f0ec;line-height:1.5;}
    tr:last-child td{border-bottom:none;}
    .dot{display:inline-block;width:10px;height:10px;border-radius:50%;margin-right:7px;vertical-align:middle;}

    /* ── P24 – Fecha ─────────────────────────── */
    .fecha-card{background:var(--card);border:1.5px solid var(--border);border-radius:18px;padding:48px 32px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,.05);animation:popIn .5s ease;}
    .fecha-card .fc-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.18em;color:var(--muted);margin-bottom:16px;}
    .fecha-card .fc-value{font-family:'Playfair Display',serif;font-size:clamp(1.4rem,4vw,2.2rem);font-weight:800;color:var(--accent-dk);line-height:1.3;}
    .server-badge{
      display:inline-flex;align-items:center;gap:6px;margin-top:20px;
      background:#edf9f4;border:1.5px solid var(--accent);border-radius:999px;
      padding:5px 16px;font-size:.68rem;font-weight:700;color:var(--accent-dk);
    }
    .server-badge::before{content:'⚙';font-size:.8rem;}

    /* ── P25 / P26 – Tablas ──────────────────── */
    .tablas-wrap{display:flex;flex-wrap:wrap;gap:14px;justify-content:center;animation:fadeUp .5s ease;}
    .tabla-card{background:var(--card);border:1.5px solid var(--border);border-radius:14px;padding:18px 24px;min-width:148px;box-shadow:0 2px 10px rgba(0,0,0,.04);}
    .tabla-card h3{color:var(--accent3-dk);font-size:.9rem;margin-bottom:10px;text-align:center;border-bottom:1px solid var(--border);padding-bottom:6px;}
    .tabla-card p{color:#6a3d7a;margin:3px 0;font-size:.88rem;}

    /* ── Fórmula cuadrática visual ───────────── */
    .formula-card{
      background:var(--card);border:1.5px solid var(--border);border-radius:18px;
      padding:22px 28px;margin-bottom:22px;text-align:center;
      box-shadow:0 4px 20px rgba(0,0,0,.05);position:relative;overflow:hidden;
    }
    .formula-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--accent3),var(--accent),var(--accent2));}
    .formula-card h2{font-size:.75rem;text-transform:uppercase;letter-spacing:.14em;color:var(--muted);margin-bottom:18px;}
    .formulas-row{display:flex;justify-content:center;gap:40px;flex-wrap:wrap;}
    .fitem .flabel{font-size:.9rem;font-weight:800;margin-bottom:8px;}
    .fitem .flabel.c1{color:#7a60c8;} .fitem .flabel.c2{color:#5aaa7a;}
    .fbox{background:var(--bg);border:1.5px solid var(--border);border-radius:12px;padding:12px 20px;display:inline-block;}
    .fnum{font-size:.95rem;font-weight:700;padding-bottom:5px;border-bottom:2px solid var(--text);display:flex;align-items:center;gap:5px;justify-content:center;}
    .fden{font-size:.95rem;font-weight:700;padding-top:5px;}
    .fsqrt{display:inline-flex;align-items:center;border-top:2px solid var(--text);padding:2px 4px;margin-left:2px;}

    /* ── Fórmula IMC hint ────────────────────── */
    .fhint{background:#f5f0ff;border:1.5px solid var(--accent3);border-radius:10px;padding:11px 16px;font-size:.77rem;color:var(--accent3-dk);margin-bottom:18px;text-align:center;font-weight:700;}

    /* ── Footer ──────────────────────────────── */
    .footer{text-align:center;margin-top:56px;color:var(--muted);font-size:.7rem;line-height:2;animation:fadeUp .7s .4s ease both;}
    .footer span{color:var(--accent-dk);}

    /* ── Animaciones ─────────────────────────── */
    @keyframes fadeDown{from{opacity:0;transform:translateY(-18px)}to{opacity:1;transform:none}}
    @keyframes fadeUp  {from{opacity:0;transform:translateY(18px) }to{opacity:1;transform:none}}
    @keyframes fadeIn  {from{opacity:0}to{opacity:1}}
    @keyframes popIn   {from{opacity:0;transform:scale(.87)}to{opacity:1;transform:scale(1)}}

    /* ── Página de inicio ────────────────────── */
    .home-intro{text-align:center;padding:20px 0 10px;animation:fadeUp .6s ease both;}
    .home-intro p{color:var(--muted);font-size:.88rem;line-height:1.9;max-width:540px;margin:0 auto 28px;}

    /* ── Breadcrumb ──────────────────────────── */
    .breadcrumb{font-size:.72rem;color:var(--muted);margin-bottom:22px;animation:fadeIn .4s ease;}
    .breadcrumb a{color:var(--accent-dk);text-decoration:none;font-weight:700;}
    .breadcrumb a:hover{text-decoration:underline;}
    .breadcrumb span{margin:0 6px;}
  </style>
</head>
<body>
<div class="wrap">

  <!-- ░░ ENCABEZADO GLOBAL ░░ -->
  <div class="site-header">
    <h1>Prácticas <span>21 – 26</span><br>con PHP</h1>
    <p>Victoria Marbella González Humo · Los Mochis, Sinaloa · 2026</p>
  </div>

  <!-- ░░ MENÚ DE PRÁCTICAS ░░ -->
  <nav class="menu-grid">
    <?php foreach($menu as $num => [$titulo, $icono]): ?>
    <a href="?p=<?= $num ?>" class="menu-btn <?= $p===$num ? 'active' : '' ?>">
      <span class="mb-num">Práctica <?= $num ?></span>
      <?php if($icono !== ''): ?>
      <span class="mb-icon"><?= htmlspecialchars($icono) ?></span>
      <?php endif; ?>
      <span class="mb-title"><?= htmlspecialchars($titulo) ?></span>
    </a>
    <?php endforeach; ?>
  </nav>

  <?php if ($p === 0): ?>
  <!-- ══════════════════════════════════════════════════════════
       PÁGINA DE INICIO
  ══════════════════════════════════════════════════════════ -->
  <div class="home-intro">
    <p>
      Selecciona una práctica del menú para ejecutarla.<br>
    </p>
  </div>

  <?php elseif ($p === 21): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 21 – OPERACIONES ARITMÉTICAS
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 21 — Operaciones Aritméticas
  </div>

  <?php if ($res21 && isset($res21['error'])): ?>
    <div class="alert"><?= htmlspecialchars($res21['error']) ?></div>
  <?php elseif ($res21): ?>
    <div class="res21" style="margin-bottom:24px;">
      <div class="rh">
        <span>Resultado</span>
        <span style="color:<?= op_color($res21['op']) ?>"><?= op_nombre($res21['op']) ?></span>
      </div>
      <div class="rb">
        <div>
          <div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.12em;color:var(--muted);margin-bottom:5px;">
            <?= op_nombre($res21['op']) ?>
          </div>
          <div class="formula" style="color:<?= op_color($res21['op']) ?>">
            <?= $res21['a'] ?> <?= op_simbolo($res21['op']) ?> <?= $res21['b'] ?>
          </div>
        </div>
        <div>
          <div class="eq">= resultado</div>
          <div class="value" style="color:<?= op_color($res21['op']) ?>">
            <?= $res21['resultado'] ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <form method="POST" action="?p=21">
    <div class="card">
      <h2>Ingresa los valores</h2>
      <div class="inputs-row col2">
        <div class="ig">
          <label>Variable A</label>
          <input type="number" name="a" step="any" placeholder="ej. 18"
                 value="<?= htmlspecialchars($_POST['a'] ?? '') ?>"/>
        </div>
        <div class="ig">
          <label>Variable B</label>
          <input type="number" name="b" step="any" placeholder="ej. 4"
                 value="<?= htmlspecialchars($_POST['b'] ?? '') ?>"/>
        </div>
      </div>
      <div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.12em;color:var(--muted);margin-bottom:12px;">
        Selecciona una operación
      </div>
      <div class="op-grid">
        <button type="submit" name="op" value="suma" class="op-btn btn-s">
          <span class="sym">+</span><span class="lbl">Suma</span>
        </button>
        <button type="submit" name="op" value="resta" class="op-btn btn-r">
          <span class="sym">−</span><span class="lbl">Resta</span>
        </button>
        <button type="submit" name="op" value="division" class="op-btn btn-d">
          <span class="sym">÷</span><span class="lbl">División</span>
        </button>
        <button type="submit" name="op" value="exponenciacion" class="op-btn btn-e">
          <span class="sym">^</span><span class="lbl">Exponenciación</span>
        </button>
      </div>
    </div>
  </form>


  <?php elseif ($p === 22): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 22 – FÓRMULA GENERAL
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 22 — Fórmula General
  </div>

  <div class="formula-card">
    <h2>Fórmula utilizada</h2>
    <div class="formulas-row">
      <div class="fitem">
        <div class="flabel c1">x₁</div>
        <div class="fbox">
          <div class="fnum">−b − <span class="fsqrt">b² − 4ac</span></div>
          <div class="fden">2a</div>
        </div>
      </div>
      <div class="fitem">
        <div class="flabel c2">x₂</div>
        <div class="fbox">
          <div class="fnum">−b + <span class="fsqrt">b² − 4ac</span></div>
          <div class="fden">2a</div>
        </div>
      </div>
    </div>
  </div>

  <?php if ($res22 && isset($res22['error'])): ?>
    <div class="alert"><?= htmlspecialchars($res22['error']) ?></div>
  <?php elseif ($res22): ?>
    <div class="res22" style="margin-bottom:24px;">
      <div class="rh">Resultados</div>
      <div class="rb">
        <div class="xgrid">
          <div class="xbox x1b">
            <div class="xl">x₁</div>
            <div class="xv"><?= $res22['x1'] ?></div>
          </div>
          <div class="xbox x2b">
            <div class="xl">x₂</div>
            <div class="xv"><?= $res22['x2'] ?></div>
          </div>
        </div>
        <div class="out-msg">
          <strong>Ecuación:</strong> <?= $res22['a'] ?>x² + (<?= $res22['b'] ?>)x + (<?= $res22['c'] ?>) = 0<br>
          <strong>Discriminante:</strong> b² − 4ac = (<?= $res22['b'] ?>)² − 4(<?= $res22['a'] ?>)(<?= $res22['c'] ?>) = <?= $res22['disc'] ?><br>
          <strong style="color:#7a60c8">x₁ =</strong> (<?= -$res22['b'] ?> − √<?= $res22['disc'] ?>) / (2 × <?= $res22['a'] ?>) = <strong style="color:#7a60c8"><?= $res22['x1'] ?></strong><br>
          <strong style="color:#5aaa7a">x₂ =</strong> (<?= -$res22['b'] ?> + √<?= $res22['disc'] ?>) / (2 × <?= $res22['a'] ?>) = <strong style="color:#5aaa7a"><?= $res22['x2'] ?></strong>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <form method="POST" action="?p=22">
    <div class="card">
      <h2>Ingresa los coeficientes</h2>
      <div class="inputs-row col3">
        <div class="ig">
          <label>Coeficiente A</label>
          <span class="hint">ax²</span>
          <input type="number" name="a" step="any" placeholder="ej. 1"
                 value="<?= htmlspecialchars($_POST['a'] ?? '') ?>"/>
        </div>
        <div class="ig">
          <label>Coeficiente B</label>
          <span class="hint">bx</span>
          <input type="number" name="b" step="any" placeholder="ej. -3"
                 value="<?= htmlspecialchars($_POST['b'] ?? '') ?>"/>
        </div>
        <div class="ig">
          <label>Coeficiente C</label>
          <span class="hint">c</span>
          <input type="number" name="c" step="any" placeholder="ej. 2"
                 value="<?= htmlspecialchars($_POST['c'] ?? '') ?>"/>
        </div>
      </div>
      <button type="submit" class="main-btn">Calcular x₁ y x₂</button>
    </div>
  </form>


  <?php elseif ($p === 23): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 23 – CALCULADORA IMC
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 23 — Calculadora IMC
  </div>

  <?php if ($res23 && isset($res23['error'])): ?>
    <div class="alert"><?= htmlspecialchars($res23['error']) ?></div>
  <?php elseif ($res23): ?>
    <div class="res23" style="margin-bottom:24px;">
      <div class="rh">Tu resultado</div>
      <div class="rb">
        <div class="imc-disp">
          <div class="imc-num">
            <div class="lbl">Tu IMC</div>
            <div class="val" style="color:<?= $res23['color'] ?>"><?= $res23['imc'] ?></div>
            <div class="unit">kg/m²</div>
          </div>
          <div class="imc-grade" style="background:<?= $res23['bg'] ?>">
            <div class="gl" style="color:<?= $res23['color'] ?>">Clasificación</div>
            <div class="gv" style="color:<?= $res23['color'] ?>"><?= htmlspecialchars($res23['grado']) ?></div>
            <div class="gd" style="color:<?= $res23['color'] ?>"><?= htmlspecialchars($res23['desc']) ?></div>
          </div>
        </div>
        <div class="scale-bar">
          <?php foreach([1=>'Bajo peso',2=>'Normal',3=>'Sobrepeso',4=>'Obesidad I',5=>'Obesidad II'] as $si => $sl): ?>
            <div class="seg s<?= $si ?><?= $res23['seg']===$si ? ' active' : '' ?>"><?= $sl ?></div>
          <?php endforeach; ?>
        </div>
        <div class="scale-rng">
          <span>&lt; 18.5</span><span>18.5–24.9</span><span>25–29.9</span><span>30–39.9</span><span>≥ 40</span>
        </div>
        <div class="out-msg">
          <strong>Datos ingresados:</strong> Peso = <?= $res23['peso'] ?> kg | Estatura = <?= $res23['estatura'] ?> m<br>
          <strong>Fórmula:</strong> IMC = <?= $res23['peso'] ?> ÷ (<?= $res23['estatura'] ?>)² = <?= $res23['peso'] ?> ÷ <?= $res23['est2'] ?><br>
          <strong>IMC calculado:</strong> <strong style="color:<?= $res23['color'] ?>"><?= $res23['imc'] ?> kg/m²</strong><br>
          <strong>Clasificación:</strong> <strong style="color:<?= $res23['color'] ?>"><?= htmlspecialchars($res23['grado']) ?></strong>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <form method="POST" action="?p=23">
    <div class="card">
      <h2>Ingresa tus datos</h2>
      <div class="inputs-row col2">
        <div class="ig">
          <label>Peso</label>
          <span class="hint">kilogramos (kg)</span>
          <input type="number" name="peso" step="0.01" placeholder="ej. 60"
                 value="<?= htmlspecialchars($_POST['peso'] ?? '') ?>"/>
        </div>
        <div class="ig">
          <label>Estatura</label>
          <span class="hint">metros (m)</span>
          <input type="number" name="estatura" step="0.01" placeholder="ej. 1.65"
                 value="<?= htmlspecialchars($_POST['estatura'] ?? '') ?>"/>
        </div>
      </div>
      <div class="fhint">Fórmula: IMC = Peso (kg) ÷ Estatura² (m²)</div>
      <button type="submit" class="main-btn">Calcular mi IMC</button>
    </div>
  </form>

  <div class="ref-card" style="margin-top:0;">
    <div class="rh">Tabla de clasificación IMC</div>
    <table>
      <thead>
        <tr><th>Categoría</th><th>IMC (kg/m²)</th><th>Descripción</th></tr>
      </thead>
      <tbody>
        <tr><td><span class="dot" style="background:#a8d4f0"></span>Bajo peso</td><td>&lt; 18.5</td><td>Peso por debajo del rango saludable</td></tr>
        <tr><td><span class="dot" style="background:#a8d8b9"></span>Peso normal</td><td>18.5 – 24.9</td><td>Rango de peso saludable</td></tr>
        <tr><td><span class="dot" style="background:#f7e6a0"></span>Sobrepeso</td><td>25.0 – 29.9</td><td>Riesgo leve para la salud</td></tr>
        <tr><td><span class="dot" style="background:#f7c5a0"></span>Obesidad grado I</td><td>30.0 – 39.9</td><td>Riesgo moderado a alto para la salud</td></tr>
        <tr><td><span class="dot" style="background:#f0a0a0"></span>Obesidad grado II</td><td>≥ 40.0</td><td>Riesgo muy alto para la salud</td></tr>
      </tbody>
    </table>
  </div>


  <?php elseif ($p === 24): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 24 – FECHA ACTUAL 
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 24 — Fecha Actual
  </div>
  <div class="fecha-card">
    <div class="fc-label">Fecha de hoy</div>
    <div class="fc-value">
      Hoy es <?= $fecha24['dia_nombre'] ?> <?= $fecha24['dia_num'] ?>
      de <?= $fecha24['mes'] ?> del año <?= $fecha24['anio'] ?>
    </div>
    <div class="server-badge">Generado con PHP · date()</div>
  </div>


  <?php elseif ($p === 25): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 25 – TABLAS DEL 1 AL 10 
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 25 — Tablas de Multiplicar (1–10)
  </div>
  <div class="tablas-wrap">
    <?php for($i = 1; $i <= 10; $i++): ?>
      <div class="tabla-card">
        <h3>Tabla del <?= $i ?></h3>
        <?php for($j = 1; $j <= 10; $j++): ?>
          <p><?= $i ?> × <?= $j ?> = <?= $i * $j ?></p>
        <?php endfor; ?>
      </div>
    <?php endfor; ?>
  </div>


  <?php elseif ($p === 26): ?>
  <!-- ══════════════════════════════════════════════════════════
       PRÁCTICA 26 – TABLAS HASTA N 
  ══════════════════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="?">Inicio</a><span>›</span> Práctica 26 — Tablas hasta N
  </div>

  <?php if ($res26 && isset($res26['error'])): ?>
    <div class="alert"><?= htmlspecialchars($res26['error']) ?></div>
  <?php endif; ?>

  <form method="POST" action="?p=26" style="margin-bottom:28px;">
    <div class="card">
      <h2>¿Hasta qué tabla?</h2>
      <div class="inputs-row" style="grid-template-columns:1fr auto;align-items:end;gap:14px;">
        <div class="ig">
          <label>Hasta la tabla del número:</label>
          <input type="number" name="n" min="1" step="1" placeholder="ej. 5"
                 value="<?= htmlspecialchars($_POST['n'] ?? '') ?>"/>
        </div>
        <button type="submit" class="main-btn" style="width:auto;padding:13px 28px;">
          Generar Tablas
        </button>
      </div>
    </div>
  </form>

  <?php if ($res26 && !isset($res26['error'])): ?>
    <div class="tablas-wrap">
      <?php for($i = 1; $i <= $res26['n']; $i++): ?>
        <div class="tabla-card">
          <h3>Tabla del <?= $i ?></h3>
          <?php for($j = 1; $j <= 10; $j++): ?>
            <p><?= $i ?> × <?= $j ?> = <?= $i * $j ?></p>
          <?php endfor; ?>
        </div>
      <?php endfor; ?>
    </div>
  <?php endif; ?>

  <?php endif; ?>

  <!-- ░░ FOOTER ░░ -->
  <div class="footer">
    Victoria Marbella González Humo · Los Mochis, Sinaloa · 2026
  </div>

</div>
</body>
</html>