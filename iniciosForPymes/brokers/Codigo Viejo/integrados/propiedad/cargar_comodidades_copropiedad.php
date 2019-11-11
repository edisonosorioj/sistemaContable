<?php
conectar();
$comodiades_copropiedad = Consulta::Comodidades_Copropiedad($mysqli,$copropiedad);
echo count($comodiades_copropiedad);
desconectar();