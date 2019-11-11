<?php
conectar();
$comodiades_propiedad = Consulta::Comodidades_Propiedad($mysqli,$codigo_propiedad);
echo count($comodiades_propiedad);
desconectar();