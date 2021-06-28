<?php
Use Symfony\Component\Process\Process; 
use Symfony\Component\Process\Exception\ProcessFailedException;

          
?>


<!--Se crea una estructura que pueda mostrar los datos, en este caso, una tabla-->
<table class="table">
    <tr  role="row">
        <th class="sorting">Rank<th>
    </tr>
    <tbody>
        <?php



            //Metodo empleado para nuestro script
            #Elegimos la cantidad de parametros que se usarán(mostrarán)
            for ($i=0; $i <10 ; $i++) { 
                echo "<tr role=\"row\">"; #Se inyecta html para dar formato a la salida del script
                    echo "<td>";
                        #Se ejecuta el script enviando, en este caso, un parametro
                        $tmp = exec("python3 ./rankprods.py $i");
                        #Se devuelve la salida del script
                        echo $tmp;
                    echo "</td>";
                echo "</tr>";
            }
            


/*
                METODO ALTERNATIVO, empleando librerias

                echo "<tr  role=\"row\">";
                     echo "<td>";
                        $process = new Process(['python3','./rankclientes.py']);
                        $process->run();

                        if (!$process->isSuccessful()) { 
                            throw new ProcessFailedException($process);
                        }       
                        echo $process->getOutput();

                    echo "</td>";
                echo "</tr>";
*/


/*
                METODO CON SALIDA JSON

                    $process = new Process(['python3', './rankclientes.py']);
                    $process->run();

                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }
                    $contenido =$process->getOutput();
                    dump(json_decode($process->getOutput(), true)); 
                    
*/

        ?>
   </tbody>
</table>
<?php