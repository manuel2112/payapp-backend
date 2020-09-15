<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoNegocio">
			Agregar Tipo de Negocio
		</button>
    </div>
</div>

<table class="table table-bordered table-dark table-hover" id="tiponegocio" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">TIPO DE NEGOCIO</th>
      <th scope="col">ESTADO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR TIPO DE NEGOCIO
======================================-->
<div id="modalAgregarTipoNegocio" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Tipo de Negocio</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>			

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
					<input type="text" class="form-control" name="nuevoTipoNegocio" id="nuevoTipoNegocio" placeholder="Ingresar Tipo de Negocio..." required>
				</div>
			</div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="button" class="btn btn-primary" id="guardarTipoNegocio">Guardar Tipo de Negocio</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR TIPO DE NEGOCIO
======================================-->
<div id="modalEditarTipoNegocio" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">     
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Tipo de Negocio</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuestaeditar"></div>

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<input type="hidden" name="editarIdTipoNegocio" id="editarIdTipoNegocio" >
					<input type="text" class="form-control" name="editarTipoNegocio" id="editarTipoNegocio" placeholder="Editar Tipo de Negocio..." required>
				</div>
			</div>
       		
       		<div id="loading" class="text-center"></div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="button" class="btn btn-primary" id="btnEditarTipoNegocio">Editar Tipo de Negocio</button>
        </div>

      </form> 

    </div>

  </div>

</div>
    