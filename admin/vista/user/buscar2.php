<table id="buzon">
                    <tr>
                        <th>Destino</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Fecha y hora</th>
                    </tr>
                    <?php
                        include '../../../config/conexionBD.php';

                        $codigo=$_GET["codigo"];
                        $correo=$_GET["correo"];
                        $codigoCorreo=buscarCodigoCorreo($correo);

                        $sql = "SELECT * FROM correo,usuario WHERE cor_usu_destino=usu_codigo AND cor_usu_remite='$codigo' AND usu_correo like '%$correo%' ORDER BY cor_fecha_envio";
                        $result = $conn->query($sql);
                        

                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>".buscarCorreo($row["cor_usu_destino"])."</td>";
                                    echo "<td>" .$row["cor_asunto"]."</td>";
                                    echo "<td>" .$row["cor_mensaje"]."</td>";
                                    echo "<td>" .$row["cor_fecha_envio"]."</td>";
                            }
                        }else{
                            echo "<td colspan=4>No tiene mensajes del usuario ingresado</td>";
                        }

                        function buscarCodigoCorreo($correo){
                            $codigoCorreo="";
                            include '../../../config/conexionBD.php';
                            $sql1 = "SELECT usu_codigo FROM usuario WHERE usu_correo='$correo'";
                            $result = $conn->query($sql1);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $codigoCorreo=$row["usu_codigo"];
                                }
                            }
                            return $codigoCorreo;
                        }
                        function buscarCorreo($codigoCorreo1){
                            include '../../../config/conexionBD.php';
                            $sql1 = "SELECT usu_correo FROM usuario WHERE usu_codigo='$codigoCorreo1'";
                            $result = $conn->query($sql1);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $direccionCorreo=$row["usu_correo"];
                                }
                            }
                            return $direccionCorreo;
                        }
                        

                        $conn->close();
                    ?>
                </table>

