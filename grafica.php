<?php 

include('header.php'); 
?>
<div class="container">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#porDisciplina" data-toggle="tab">
				Grafica por disciplina
			</a>
		</li>
		<li>
			<a href="#porFase" data-toggle="tab">
				Grafica por fase
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div id="porDisciplina" class="tab-pane fade in active">
			<div id="grafica"></div>		
		</div>
		<div id="porFase" class="tab-pane">
			<div id="gf"></div>
		</div>
	</div>
	<hr>
	<div class="row">
        <div class="container">
            <div class="col-md-3 ">
                <a href="home.php" style="font-size: xx-large;">
                    <span>&larr;</span>
                    Regresar
                </a>
            </div>
        </div>
    </div>
</div>
<script src="Assets/code/highcharts.js"></script>
<script src="Assets/code/modules/exporting.js"></script>
<script src="Assets/js/graficas.js"></script>

