<div class="footer">
	<ul>
		<li>
		    <?php
                session_start();
                if (isset($_SESSION["id_usuario"])) {
                    echo '<a href="../../procesos/logout.php">
                            Cerrar sesión
                        </a>';
                }else{
                    echo '<a href="#">
                            
                        </a>';
                }
            ?>
		</li>
	</ul>
</div>