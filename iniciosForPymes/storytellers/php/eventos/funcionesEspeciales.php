<?php 

/**
 * 
 */
class consultas
{

	public static function tiempoTranscurridoFechas($fechaInicio,$fechaFin)
	{
	    $fecha1 = new DateTime($fechaInicio);
	    $fecha2 = new DateTime($fechaFin);
	    $fecha = $fecha1->diff($fecha2);
	    $tiempo = "";
	         
	    //años
	    if($fecha->y > 0)
	    {
	        $tiempo .= $fecha->y;
	             
	        if($fecha->y == 1)
	            $tiempo .= " año, ";
	        else
	            $tiempo .= " años, ";
	    }
	         
	    //meses
	    if($fecha->m > 0)
	    {
	        $tiempo .= $fecha->m;
	             
	        if($fecha->m == 1)
	            $tiempo .= " mes, ";
	        else
	            $tiempo .= " meses, ";
	    }
	         
	    //dias
	    if($fecha->d > 0)
	    {
	        $tiempo .= $fecha->d;
	             
	        if($fecha->d == 1)
	            $tiempo .= " día, ";
	        else
	            $tiempo .= " días, ";
	    }
	         
	    //horas
	    if($fecha->h > 0)
	    {
	        $tiempo .= $fecha->h;
	             
	        if($fecha->h == 1)
	            $tiempo .= " hora, ";
	        else
	            $tiempo .= " horas, ";
	    }
	         
	    //minutos
	    if($fecha->i > 0)
	    {
	        $tiempo .= $fecha->i;
	             
	        if($fecha->i == 1)
	            $tiempo .= " minuto";
	        else
	            $tiempo .= " minutos";
	    }
	    else if($fecha->i == 0) //segundos
	        $tiempo .= $fecha->s." segundos";
	         
	    return $tiempo;

	}

}

 ?>