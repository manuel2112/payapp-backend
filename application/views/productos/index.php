<div class="row mb-2">

	<div class="col-12">

	<?php if ( $this->session->flashdata('exito') ){ ?>
		<div class="alert alert-success">
		  <?php echo $this->session->flashdata('exito');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
	<?php }?>

    <?php if ( $this->session->userdata('adminapppay') ) {?>

		<div class="col-12">
			<div id="list-productos">
				<button class="btn btn-warning btn-producto" data-toggle="modal" data-target="#mdlItems" title="AGREGAR/ORDENAR ITEMS" id="mdlItemsOpen">AGREGAR/ORDENAR<br> ITEMS</button>
				<button class="btn btn-warning btn-producto" data-toggle="modal" data-target="#mdlProducto" id="mdlProductoOpen" title="AGREGAR/ORDENAR PRODUCTO">AGREGAR/ORDENAR<br> PRODUCTO</button>
			</div>
		</div>

		<div class="col-12">
			<h2 class="mnuProducto">MENÚ DE:</h2>
					
			<div class="col-4">
				<div class="form-group">              
					<div class="input-group">
						<select class="form-control" id="idEmpresaMnu" name="idEmpresaMnu" required>
							<option value="">SELECCIONAR EMPRESA (*)...</option>
							<?php foreach( $empresas as $itemEmpresa ){?>
								<option value="<?php echo $itemEmpresa->EMPRESA_ID?>"><?php echo $itemEmpresa->EMPRESA_NOMBRE?></option>
							<?php }?>
						</select>
					</div>
				</div>
			</div>
					
			<div class="col-12">
				<div id="loadingMnu"></div>
				<div id="tblMenu"></div>
			</div>

		</div>
    <?php }?>

    <?php if ( $this->session->userdata('clienteapppay') ) {?>

		<?php $idEmpresa = $this->session_id;?>

		<div id="mnu-custom">
		<div class="btn-group" style="margin:15px;">
		<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#mdlOrderItems" id="mdlOrderItemsOpen" title="ORDENAR ITEMS" idempresa="<?php echo $idEmpresa?>"><i class="fas fa-bars"></i> ORDENAR ITEMS</button>
		<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#mdlItems" title="AGREGAR/ORDENAR ITEMS" id="mdlItemsOpen" title="AGREGAR ITEM" idempresa="<?php echo $idEmpresa?>"><i class="fas fa-plus"></i> AGREGAR ITEM</button>
		</div>
		<div id="accordion">

		<?php 
			$k = 1;
			foreach( $tipoProducto as $itemTipoProducto ){
		?>

			<div class="card">
				<div class="card-header" id="heading<?php echo $k?>">
					<div class="mnu-row title-space">
					<h3><button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $k?>" aria-expanded="true" aria-controls="collapse<?php echo $k?>"><?php echo $itemTipoProducto->TIPO_PRODUCTO_NOMBRE?></button></h3>	
					<div class="btn-group">

					<button type="button" class="btn btn-outline-dark mdlOrderProductosOpen" data-toggle="modal" data-target="#mdlOrderProductos" title="ORDENAR PRODUCTOS" iditem="<?php echo $itemTipoProducto->TIPO_PRODUCTO_ID?>"><i class="fas fa-bars"></i></button>
					<button type="button" class="btn btn-outline-dark mdlEditItemsGetOpen" data-toggle="modal" data-target="#mdlEditItems" iditem="<?php echo $itemTipoProducto->TIPO_PRODUCTO_ID?>" title="EDITAR ITEM"><i class="fas fa-edit"></i></button>
					<button type="button" class="btn btn-outline-dark mdlProducto" data-toggle="modal" data-target="#mdlProducto" id="mdlProductoOpen" title="AGREGAR PRODUCTO" iditem="<?php echo $itemTipoProducto->TIPO_PRODUCTO_ID?>" nmbProducto="<?php echo $itemTipoProducto->TIPO_PRODUCTO_NOMBRE?>"><i class="fas fa-plus"></i></button>

					<?php $hiddenitemvalue = $itemTipoProducto->TIPO_PRODUCTO_SHOW == 1 ? 0 : 1 ;?>
					<?php $hiddenitembtn = $itemTipoProducto->TIPO_PRODUCTO_SHOW == 1 ? 'btn-outline-dark' : 'btn-dark' ;?>
					<button type="button" class="btn <?php echo $hiddenitembtn?> hideItem" title="OCULTAR PRODUCTO" iditem="<?php echo $itemTipoProducto->TIPO_PRODUCTO_ID?>" hiddenitemvalue="<?php echo $hiddenitemvalue?>"><i class="fas fa-eye-slash"></i></button>

					<button type="button" class="btn btn-danger deleteItem" title="ELIMINAR PRODUCTO" iditem="<?php echo $itemTipoProducto->TIPO_PRODUCTO_ID?>"><i class="fas fa-trash-alt"></i></button>
					</div>
				</div>
			</div>

			<div id="collapse<?php echo $k?>" class="collapse" aria-labelledby="heading<?php echo $k?>" data-parent="#accordion">
			<div class="card-body">	

			<?php
				//OBTENER PRODUCTOS POR EMPRESA
				$producto = productoPorTipo($itemTipoProducto->TIPO_PRODUCTO_ID);
				foreach( $producto as $itemProducto ){
			?>
				<div class="mnu-row title-space title-producto">
				<h4><?php echo $itemProducto->PRODUCTO_NOMBRE?></h4>
				<div class="btn-group">

				<button type="button" class="btn btn-outline-light mdlOrderVaVarOpen" data-toggle="modal" data-target="#mdlOrderVaVar" title="ORDENAR VALORES VARIABLES" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>"><i class="fas fa-bars"></i></button>

				<button type="button" class="btn btn-outline-light mdlEditProductoOpen" data-toggle="modal" data-target="#mdlEditProducto" title="EDITAR PRODUCTO" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" nmbProducto="<?php echo $itemProducto->PRODUCTO_NOMBRE?>" ><i class="fas fa-edit"></i></button>

				<button type="button" class="btn btn-outline-light mdlAddGaleriaProductoOpen" data-toggle="modal" data-target="#mdlAddGaleriaProducto" title="GALERÍA DE IMÁGENES DEL PRODUCTO" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" nmbProducto="<?php echo $itemProducto->PRODUCTO_NOMBRE?>" idEmpresa="<?php echo $idEmpresa?>"><i class="far fa-images"></i></button>

				<button type="button" class="btn btn-outline-light mdlAddVaVarOpen" data-toggle="modal" data-target="#" id="" title="AGREGAR VALOR VARIABLE"  idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" nmbProducto="<?php echo $itemProducto->PRODUCTO_NOMBRE?>"><i class="fas fa-plus"></i></button>

				<?php
					$destacarproductovalue = $itemProducto->PRODUCTO_DESTACADO == 1 ? 0 : 1 ;
					$destacarproductobtn = $itemProducto->PRODUCTO_DESTACADO == 0 ? 'btn-outline-light' : 'btn-light' ;
				?>
					<button type="button" class="btn <?php echo $destacarproductobtn?> destacarProducto" title="DESTACAR PRODUCTO" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" destacarproductovalue="<?php echo $destacarproductovalue?>"><i class="fas fa-exclamation"></i></button>

				<?php
					$ofertaproductovalue = $itemProducto->PRODUCTO_OFERTA == 1 ? 0 : 1 ;
					$ofertaproductobtn = $itemProducto->PRODUCTO_OFERTA == 0 ? 'btn-outline-light' : 'btn-light' ;
				?>
					<button type="button" class="btn <?php echo $ofertaproductobtn?> ofertaProducto" title="PRODUCTO EN OFERTA" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" ofertaproductovalue="<?php echo $ofertaproductovalue?>"><i class="fas fa-dollar-sign"></i></button>

				<?php
					$hiddenproductovalue = $itemProducto->PRODUCTO_SHOW == 1 ? 0 : 1 ;
					$hiddenproductobtn = $itemProducto->PRODUCTO_SHOW == 1 ? 'btn-outline-light' : 'btn-light' ;
				?>
				<button type="button" class="btn <?php echo $hiddenproductobtn?> hiddenProducto" title="OCULTAR PRODUCTO" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>" hiddenproductovalue="<?php echo $hiddenproductovalue?>"><i class="fas fa-eye-slash"></i></button>

				<button type="button" class="btn btn-danger deleteProducto" title="ELIMINAR PRODUCTO" idproducto="<?php echo $itemProducto->PRODUCTO_ID?>"><i class="fas fa-trash-alt"></i></button>
			</div>
			</div>

			<?php $i = 1?>

			<?php
			//OBTENER VARIABLES DEL PRODUCTO
			$productoVar = variablePorProducto($itemProducto->PRODUCTO_ID);
			foreach( $productoVar as $itemProductoVar ){
				
				// $nmbVariable = $itemProductoVar->PROVAR_BASE ? "VALOR BASE" : $itemProductoVar->PROVAR_DESC ;
				$subclass = $i % 2 == 0 ? 'par' : 'impar';
			?>
					<div class="mnu-row data <?php echo $subclass?>">
					<div class="data-point"></div>
					<div class="data-nmb-var"><h5><?php echo $itemProductoVar->PROVAR_DESC?></h5></div>
					<div class="data-valor-var"><h5><?php echo formatoDinero($itemProductoVar->PROVAR_VALOR)?></h5></div>
					<div class="btn-group">
					<button type="button" class="btn btn-outline-dark mdlEditVaVarOpen mb-2" data-toggle="modal" data-target="#mdlEditVaVar" title="EDITAR VALOR VARIABLE" idvavar="<?php echo $itemProductoVar->PROVAR_ID?>" nmbProducto="<?php echo $itemProducto->PRODUCTO_NOMBRE?>"><i class="fas fa-edit"></i></button>

					<?php
						$hiddenvavarvalue = $itemProductoVar->PROVAR_SHOW == 1 ? 0 : 1 ;
						$hiddenvavarbtn = $itemProductoVar->PROVAR_SHOW == 1 ? 'btn-outline-dark' : 'btn-dark' ;
						
						if(!$itemProductoVar->PROVAR_BASE){
					?>
					<button type="button" class="btn <?php echo $hiddenvavarbtn?> hiddenVaVar mb-2" title="OCULTAR VALOR VARIABLE" idvavar="<?php echo $itemProductoVar->PROVAR_ID?>" hiddenvavarvalue="<?php echo $hiddenvavarvalue?>"><i class="fas fa-eye-slash"></i></button>

					<button type="button" class="btn btn-danger deleteVaVar mb-2" title="ELIMINAR VALOR VARIABLE" idvavar="<?php echo $itemProductoVar->PROVAR_ID?>"><i class="fas fa-trash-alt"></i></button>
						<?php }//FIN IF VALOR BASE?>
					</div>
					</div>				
					<?php }?>
				<?php }?>
			</div>
			</div>
			</div>
			<?php $k++?>
			<?php }?>
		</div>
		</div>

	<?php }//IF SESSION?>

	</div>
</div>

<!--=====================================
MODAL ITEMS
======================================-->
<div id="mdlItems" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formAddItem">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<h4 class="modal-title">AGREGAR ITEMS</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
        		<div class="col-12">
					<div id="insertok"></div>
				</div>

				<?php if ( $this->session->userdata('adminapppay') ) {?>
				
					<div class="col-12">
						<div class="form-group">              
							<div class="input-group">              
								<span class="input-group-addon"><i class="fa fa-plus"></i></span>
								<select class="form-control" id="idEmpresaItem" name="idEmpresaItem" required>
									<option value="">SELECCIONAR EMPRESA (*)...</option>
									<?php foreach( $empresas as $itemEmpresa){?>
										<option value="<?php echo $itemEmpresa->EMPRESA_ID?>"><?php echo $itemEmpresa->EMPRESA_NOMBRE?></option>
									<?php }?>
								</select>
							</div>
						</div>
					</div>

				<?php }?>

				<?php if ( $this->session->userdata('clienteapppay') ) {?>
					<input type="hidden" name="idEmpresaItem" id="idEmpresaItem" value="<?php echo $idEmpresa?>">
				<?php }?>				
				
        		<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtAddItem" id="txtAddItem" placeholder="INGRESAR ITEM (*)..." required>
						</div>
					</div>
				</div>

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnGuardarItem">GUARDAR ITEM</button>
					</div>
				</div>

        		<div class="col-12">
					<div id="tblItems"></div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL PRODUCTO
======================================-->
<div id="mdlProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formAddProducto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<div id="ttlProducto"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
        		<div class="col-12">
					<div id="insertokpro"></div>
				</div>

				<?php if ( $this->session->userdata('adminapppay') ) {?>

				<div class="col-12" style="padding:0 15px;">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="idEmpresaProducto" name="idEmpresaProducto" required>
								<option value="">SELECCIONAR EMPRESA (*)...</option>
								<?php foreach( $empresas as $itemEmpresa){?>
									<option value="<?php echo $itemEmpresa->EMPRESA_ID?>"><?php echo $itemEmpresa->EMPRESA_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>

				<div class="col-12" style="padding:0 15px;">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="idTipoProducto" name="idTipoProducto" required>
								<option value="">SELECCIONAR ITEM (*)...</option>
							</select>
						</div>
					</div>
				</div>

				<?php }?>

				<?php if ( $this->session->userdata('clienteapppay') ) {?>
					<input type="hidden" name="idEmpresaProducto" id="idEmpresaProducto" value="<?php echo $idEmpresa?>">
					<input type="hidden" name="idTipoProducto" id="idTipoProducto" value="">
				<?php }?>

				<div id="datosProducto">
					<div class="row" style="padding:0 15px;">

						<div class="col-8">					
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<input type="text" class="form-control" name="txtAddProducto" id="txtAddProducto" placeholder="INGRESAR PRODUCTO (*)..." required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<textarea class="form-control" rows="5" name="txtAddProductoDesc" id="txtAddProductoDesc" placeholder="INGRESAR DESCRIPCIÓN (*)..." required></textarea>
								</div>
							</div>
							
							<hr>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<input type="text" class="form-control" name="txtAddProductoNmb" id="txtAddProductoNmb" placeholder="INGRESAR NOMBRE BASE (*)..." required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<input type="number" class="form-control" name="txtAddProductoValor" id="txtAddProductoValor" placeholder="INGRESAR VALOR BASE (*)..." required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<input type="number" class="form-control" name="txtAddProductoStock" id="txtAddProductoStock" placeholder="INGRESAR STOCK, DEJAR EN BLANCO PARA STOCK INFINITO ...">
								</div>
							</div>

							<div id="addValorVariable"></div>
							
							<button type="button" class="btn btn-info variable" id="btnGuardarProductoVaVar">AGREGAR VALORES VARIABLES</button>
										
						</div>

						<div class="col-4">

							<div class="form-group">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="chkProductoOferta" name="chkProductoOferta" value="1">
									<label class="form-check-label" for="chkProductoOferta">PRODUCTO EN OFERTA</label>
								</div>
							</div>
					
							<div class="form-group">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="chkProductoDest" name="chkProductoDest" value="1">
									<label class="form-check-label" for="chkProductoDest">PRODUCTO DESTACADO</label>
								</div>
							</div>
					
							<div class="form-group">
								<div class="panel">IMAGEN PRINCIPAL</div>
								<input type="file" class="nuevaFotoEmpresa" name="imgProductoPrincipal" id="imgProductoPrincipal">
								<p class="help-block">Peso máximo de la foto 512KB</p>
								<img src="<?php echo imgDefecto()?>" class="img-thumbnail previsualizarEmpresa" width="100px">
							</div>

						</div>
					</div>
				</div>

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnGuardarProducto">GUARDAR PRODUCTO</button>
					</div>
				</div>

        		<div class="col-12">
					<div id="tblProducto"></div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
AGREGAR VALOR VARIABLE
======================================-->
<div id="mdlAddVaVar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formAddVaVar">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">			
			<div id="titleAddVaVarGet"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="hidden" id="idAddProductoVaVar">
							<input type="text" class="form-control" id="txtAddProductoDescVar" placeholder="NOMBRE PRODUCTO VARIABLE (*)..." required>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="number" class="form-control" id="txtAddProductoValorVar" placeholder="VALOR PRODUCTO VARIABLE (*)..." required>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="number" class="form-control" id="txtAddProductoStockVar" placeholder="INGRESAR STOCK, DEJAR EN BLANCO PARA STOCK INFINITO ...">
						</div>
					</div>
				</div>			

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnAddVaVar">AGREGAR VALOR VARIABLE</button>
					</div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ORDENAR ITEM/EMPRESA
======================================-->
<div id="mdlOrderItems" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formOrderItems">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<div id="titleOrdenarItems"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	<div class="row">
				<div id="tblItemsOrder" style="width:100%"></div>
        	</div>
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ORDENAR PRODUCTO/EMPRESA
======================================-->
<div id="mdlOrderProductos" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formOrderItems">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<div id="titleOrdenarProductos"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	<div class="row">
				<div id="tblProductosOrder" style="width:100%"></div>
        	</div>
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ORDENAR VALORES VARIABLES/EMPRESA
======================================-->
<div id="mdlOrderVaVar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formOrderItems">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<!-- <h4 class="modal-title">ORDENAR ITEMS</h4> -->
			<div id="titleOrdenarVaVar"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	<div class="row">
				<div id="tblVaVarOrder" style="width:100%"></div>
        	</div>
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
EDITAR ITEMS
======================================-->
<div id="mdlEditItems" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formEditItem">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">			
			<div id="titleEditarItemGet"></div>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
        		<div class="col-12">
					<div id="updateOkEditItem"></div>
				</div>
				
        		<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="hidden" id="idEditEmpresa">
							<input type="hidden" id="idEditItem">
							<input type="text" class="form-control" name="txtEditItem" id="txtEditItem" placeholder="INGRESAR ITEM (*)..." required>
						</div>
					</div>
				</div>

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnEditarItem">EDITAR ITEM</button>
					</div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
EDITAR PRODUCTOS
======================================-->
<div id="mdlEditProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formEditProducto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">			
			<div id="titleEditarProductoGet"></div>	
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">

				<div class="col-8">

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="hidden" id="idEditProducto">
							<input type="hidden" id="idEditItemProducto">
							<input type="text" class="form-control" name="txtEditProducto" id="txtEditProducto" placeholder="INGRESAR PRODUCTO (*)..." required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEditProductoDesc" id="txtEditProductoDesc" placeholder="INGRESAR DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>
				
				</div>
				<div class="col-4">

					<div class="form-group">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="chkEditProductoOferta" value="1">
							<label class="form-check-label" for="chkEditProductoOferta">PRODUCTO EN OFERTA</label>
						</div>
					</div>

					<div class="form-group">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="chkEditProductoDest" value="1">
							<label class="form-check-label" for="chkEditProductoDest">PRODUCTO DESTACADO</label>
						</div>
					</div>
					
					<div class="form-group">
						<div class="panel">IMAGEN PRINCIPAL</div>
						<img class="img-thumbnail previsualizarEmpresa" width="100px">
						<input type="file" class="EditImgProducto" name="EditImgProducto" id="EditImgProducto">
						<p class="help-block">Peso máximo de la foto 512KB</p>
              			<input type="hidden" name="fotoActualProducto" id="fotoActualProducto">
					</div>
				
				</div>
				

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnEditarProducto">EDITAR PRODUCTO</button>
					</div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
EDITAR VALOR VARIABLE
======================================-->
<div id="mdlEditVaVar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formEditVaVar">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">			
			<div id="titleEditarVaVarGet"></div>	
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
        		<div class="col-12">
					<div id="updateOkEditVaVar"></div>
				</div>
				
				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="hidden" id="idEditVaVar">
							<input type="hidden" id="idEditProductoVaVar">
							<input type="text" class="form-control" id="txtEditProductoDescVar" placeholder="DESCRIPCIÓN PRODUCTO VARIABLE (*)..." required>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="number" class="form-control" id="txtEditProductoValorVar" placeholder="VALOR PRODUCTO VARIABLE (*)..." required>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="number" class="form-control" id="txtEditProductoStockVar" placeholder="INGRESAR STOCK, DEJAR EN BLANCO PARA STOCK INFINITO ...">
						</div>
					</div>
				</div>			

        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnEditarVaVar">EDITAR VALOR VARIABLE</button>
					</div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
ADD GALERIA IMAGENES PRODUCTO
======================================-->
<div id="mdlAddGaleriaProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg  modal-dialog-scrollable">
    <div class="modal-content">
      <form action="<?php echo base_url()?>productos/productogaleria" role="form" method="post" enctype="multipart/form-data" id="formAddGaleriaProducto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">			
			<div id="titleAddGaleriaProducto"></div>	
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="fotoloading" class="text-center"></div>

		<div class="modal-body">

			<div class="row">
				<div class="col-12">

					<div id="tblGaleria"></div>

					<hr>
				
					<input type="hidden" name="idGaleriaEmpresa" id="idGaleriaEmpresa">
					<input type="hidden" name="idGaleriaProducto" id="idGaleriaProducto">

					<div class="form-group">
						<div class="file-loading">
							<input type="file" id="file-es" name="file-es[]" multiple>
						</div>
						<span class="help-block text-secondary">5 imagenes máximo.</span><br>
						<span class="help-block text-secondary">512KB máximo por imagen.</span>
					</div>

				<button type="submit" class="btn btn-primary btn-block" id="btnAddGaleriaProducto">Guardar Imágenes</button>

				</div>

			</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>
