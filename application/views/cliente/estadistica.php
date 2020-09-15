<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Estadística</h4>
		</div>		
	</div>
</div>

<div class="row mt-5">
	<div class="col-12">
	
		<h4 class="text-secondary mb-5">SE VISUALIZAN LA CANTIDAD DE CLICKS REALIZADOS POR EVENTO EN LOS ÚLTIMOS 30 DÍAS</h4>
	
		<div class="list-group">
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="VISITA" data-seccion="1" data-campo="1"><i class="fa fa-bar-chart"></i> VISITAS >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="EMAIL" data-seccion="1" data-campo="2"><i class="fa fa-bar-chart"></i> EMAIL >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="TELÉFONO" data-seccion="1" data-campo="3"><i class="fa fa-bar-chart"></i> TELÉFONO >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="WEB" data-seccion="1" data-campo="4"><i class="fa fa-bar-chart"></i> WEB >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="GEOLOCALIZACIÓN" data-seccion="1" data-campo="5"><i class="fa fa-bar-chart"></i> GEOLOCALIZACIÓN >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="SHARED WHATSAPP" data-seccion="1" data-campo="6"><i class="fa fa-bar-chart"></i> SHARED WHATSAPP >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="SHARED FACEBOOK" data-seccion="1" data-campo="7"><i class="fa fa-bar-chart"></i> SHARED FACEBOOK >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="SHARED INSTAGRAM" data-seccion="1" data-campo="8"><i class="fa fa-bar-chart"></i> SHARED INSTAGRAM >> VER GRÁFICA</button>
			<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraph" data-title="SHARED TWITTER" data-seccion="1" data-campo="9"><i class="fa fa-bar-chart"></i> SHARED TWITTER >> VER GRÁFICA</button>
		</div>
	</div>
</div><!-- PIE ROW -->

<!--=====================================
MODAL GRÁFICO
======================================-->
<div id="modalGetGraph" class="modal fade" role="dialog">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!--=====================================
			CABEZA DEL MODAL
			======================================-->

			<div class="modal-header" style="background:#3c8dbc; color:white">
				<h4 class="modal-title">GRÁFICA <span id="title-modal"></span></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!--=====================================
			CUERPO DEL MODAL
			======================================-->
			<div id="graphloading" class="text-center"></div>

			<div class="modal-body" style="width:100%">
				<div class="row">
					<div class="col-12">
						<div id="myfirstchart" style="width:100%"></div>	
					</div>
				</div>								
			</div>

			<!--=====================================
			PIE DEL MODAL
			======================================-->

			<div class="modal-footer">
				<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
			</div>

		</div>
	</div>
</div>
