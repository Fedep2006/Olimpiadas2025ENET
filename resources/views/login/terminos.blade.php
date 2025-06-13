<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Términos y Condiciones de Frategar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #f0f2f5, #dfe9f3);
      color: #2c3e50;
    }

    .container {
      max-width: 900px;
      margin: 3em auto;
      background: #fff;
      padding: 2.5em 3em;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 2.5em;
      margin-bottom: 0.5em;
      text-align: center;
      color: #34495e;
    }

    h2 {
      font-size: 1.5em;
      color: #2980b9;
      margin-top: 1.5em;
    }

    p, li {
      font-size: 1.1em;
      line-height: 1.6em;
    }

    ul {
      margin-left: 1.5em;
      padding-left: 1em;
    }

    .section {
      margin-bottom: 2em;
    }

    .footer {
      text-align: center;
      font-weight: bold;
      font-size: 1.2em;
      margin-top: 3em;
      padding-top: 1em;
      border-top: 2px solid #ccc;
    }

    em {
      color: #7f8c8d;
    }

    strong {
      color: #e74c3c;
    }

    hr {
      border: none;
      border-top: 1px solid #ccc;
      margin: 2em 0;
    }

    .btn-volver {
      display: inline-block;
      margin: 2em auto 0;
      padding: 0.8em 2em;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      font-size: 1em;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .btn-volver:hover {
      background-color: #2980b9;
    }

    .volver-container {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Términos y Condiciones de Frategar</h1>

    <div class="section">
      <p>Bienvenid@ a <strong>Frategar</strong>, la agencia de viajes más confiablemente dudosa del hemisferio sur. Al usar esta página, aceptás todos estos términos, aunque no los leas. Total, nadie los lee.</p>
    </div>

    <div class="section">
      <h2>1. Uso del sitio</h2>
      <p>Podés usar este sitio para buscar viajes, soñar despierto con vacaciones que no vas a pagar, o simplemente para ver si todavía funciona.</p>
    </div>

    <div class="section">
      <h2>2. Qué hacemos</h2>
      <p>En Frategar te conectamos con:</p>
      <ul>
        <li>Paquetes turísticos que <em>a veces</em> existen.</li>
        <li>Hoteles que <em>probablemente</em> tengan techo.</li>
        <li>Vuelos que <em>en teoría</em> despegan.</li>
        <li>Excursiones que <em>no siempre</em> vuelven.</li>
      </ul>
    </div>

    <div class="section">
      <h2>3. Qué no hacemos (y no nos hacemos cargo)</h2>
      <p>Frategar <strong>NO se hace responsable</strong> de:</p>
      <ul>
        <li>Extravío de paquetes (incluyendo tu bolso, tu dignidad o tu amigo que se bajó en la parada equivocada).</li>
        <li>Extravío de personas. Si tu amigo se quedó en el baño de la estación de servicio y el colectivo se fue, lo sentimos... ahora vive ahí.</li>
        <li>Que no recibas lo que compraste. A veces las cosas "se pierden en el sistema" (léase: en la nada misma).</li>
      </ul>
    </div>

    <div class="section">
      <h2>4. Al firmar este contrato...</h2>
      <p>Usted acepta:</p>
      <ul>
        <li>Defender a China en caso de conflicto bélico 🐉 (¡tranqui, solo si lo piden por mail y en mandarín!).</li>
        <li>Ceder su sandwich de milanesa si el CEO de Frategar tiene hambre.</li>
        <li>Reírse al menos una vez durante la lectura de estos términos. Si no lo hace, se le cobrará una tasa de aburrimiento.</li>
      </ul>
    </div>

    <div class="section">
      <h2>5. Política de reembolsos</h2>
      <p><strong>JAJAJA.</strong></p>
    </div>

    <div class="section">
      <h2>6. Soporte técnico</h2>
      <p>Contamos con un equipo de atención al cliente altamente capacitado para ignorar sus reclamos de lunes a viernes, de 3:27 a 3:29 AM.</p>
    </div>

    <hr>

    <div class="footer">
      Gracias por confiar en Frategar.<br>
      La aventura está asegurada. Lo demás… veremos.
    </div>

    <div class="volver-container">
      <a href="{{ route('back') }}" class="btn-volver">volver</a>
    </div>
  </div>
</body>
</html>
