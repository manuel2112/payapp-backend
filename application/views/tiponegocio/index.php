<div class="row mb-2">

	<div class="col-12" id="tipo-negocio">

		<?php if ( $this->session->flashdata('exito') ){ ?>
			<div class="alert alert-success">
			<?php echo $this->session->flashdata('exito');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
		<?php }?>

		<div class="col-12 mb-5">
				<a href="<?php echo base_url('tiponegociorest/'.$this->session_id)?>" target="_blank" class="btn btn-primary">API</a>
		</div>

    <?php $txtDelivery = tipoNegocio($this->session_id, $idDelivery) ?>
    <?php $txtBtnDelivery = $txtDelivery ? 'ACTUALIZAR': 'INGRESAR' ; ?>
    <div class="card text-center mb-5">
      <div class="card-header" style="">
      DELIVERY      
      </div>
      <div class="card-body" id="card-01" style="padding:40px 0;">
        <div class="selectWrapper col-12">
          <textarea class="form-control" name="txt-delivery" id="txt-delivery" rows="3" placeholder="INGRESAR DESCRIPCIÓN AQUI"><?php echo $txtDelivery ?></textarea>
          <button type="button" class="btn btn-outline-primary btn-lg btn-delivery" name="btn-delivery" value="<?php echo $idDelivery ?>"><?php echo $txtBtnDelivery ?></button>

          <?php if( $txtDelivery ){ ?>
            <div class="btns-delivery">
              <button type="button" class="btn <?php echo $montoMinimo->MONTO_FLAG ? 'btn-outline-success' : 'btn-outline-danger' ?>" data-toggle="modal" data-target="#mdl-valor-minimo" title="VALOR MÍNIMO" id="mdl-valor-minimo-open">VALOR MÍNIMO</button>
              <button type="button" class="btn <?php echo count($sectores) > 0 ? 'btn-outline-success' : 'btn-outline-danger' ?>" data-toggle="modal" data-target="#mdl-sector" title="SECTORIZAR VALORES" id="mdl-sector-open">SECTORIZAR</button>            
            </div>
          <?php } ?>

        </div>
      </div>
      <div class="card-footer text-muted">
        <?php if( !$txtDelivery ){ ?>
        SI TU NEGOCIO REALIZA DELIVERY ESCRIBE UNA PEQUEÑA DESCRIPCIÓN DEL SERVICIO. LUEGO DE INGRESAR UNA DESCRIPCIÓN PODRAS INGRESAR LOS SECTORES Y VALORES DE ENTREGA
        <?php }else{ ?>
        PARA ELIMINAR ESTE TIPO DE NEGOCIO SOLO DEJA EL CAMPO EN BLANCO Y ACTUALIZA. AHORA, OPCIONALMENTE PUEDES INGRESAR LOS SECTORES Y VALORES DE ENTREGA , ADEMÁS DEL MONTO MÍNIMO DE REPARTO GRATIS.
        <?php } ?>
      </div>
    </div>
    
    <?php $txtRestaurante = tipoNegocio($this->session_id, $idRestaurante) ?>
    <?php $txtBtnRestaurante = $txtRestaurante ? 'ACTUALIZAR': 'INGRESAR' ; ?>
    <div class="card text-center mb-5">
      <div class="card-header" style="">
        RESTAURANTE
      </div>
      <div class="card-body" id="card-01" style="padding:40px 0;">
        <div class="selectWrapper col-12">
          <textarea class="form-control" name="txt-restaurante" id="txt-restaurante" rows="3" placeholder="INGRESAR DESCRIPCIÓN AQUI"><?php echo $txtRestaurante ?></textarea>
          <button type="button" class="btn btn-outline-primary btn-lg btn-restaurante" name="btn-restaurante" value="<?php echo $idRestaurante ?>"><?php echo $txtBtnRestaurante ?></button>
        </div>
      </div>
      <div class="card-footer text-muted">
        <?php if( !$txtRestaurante ){ ?>
        SI TU NEGOCIO TIENE RESTAURANTE ESCRIBE UNA PEQUEÑA DESCRIPCIÓN DEL SERVICIO. 
        <?php }else{ ?>
        PARA ELIMINAR ESTE TIPO DE NEGOCIO SOLO DEJA EL CAMPO EN BLANCO Y ACTUALIZA. 
        <?php } ?>
      </div>
    </div>

    <?php $txtRetiro = tipoNegocio($this->session_id, $idRetiro) ?>
    <?php $txtBtnRetiro = $txtRetiro ? 'ACTUALIZAR': 'INGRESAR' ; ?>
    <div class="card text-center mb-5">
      <div class="card-header" style="">
        RETIRO EN LOCAL
      </div>
      <div class="card-body" id="card-01" style="padding:40px 0;">
        <div class="selectWrapper col-12">
          <textarea class="form-control" name="txt-retiro" id="txt-retiro" rows="3" placeholder="INGRESAR DESCRIPCIÓN AQUI"><?php echo $txtRetiro ?></textarea>
          <button type="button" class="btn btn-outline-primary btn-lg btn-retiro" name="btn-retiro" value="<?php echo $idRetiro ?>"><?php echo $txtBtnRetiro ?></button>
        </div>
      </div>
      <div class="card-footer text-muted">
        <?php if( !$txtRetiro ){ ?>
          SI TU NEGOCIO PUEDE REALIZAR RETIRO EN LOCAL ESCRIBE UNA PEQUEÑA DESCRIPCIÓN DEL SERVICIO. 
        <?php }else{ ?>
        PARA ELIMINAR ESTE TIPO DE NEGOCIO SOLO DEJA EL CAMPO EN BLANCO Y ACTUALIZA. 
        <?php } ?>
      </div>
    </div>

	</div>
</div><!-- FIN ROW PRINCIPAL -->

<!--=====================================
MODAL AGREGAR MONTO MINIMO
======================================-->
<div id="mdl-valor-minimo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" id="formMonto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
          VALOR MÍNIMO DE REPARTO GRATIS <br>
          <?php echo $montoMinimo->MONTO_FLAG ? 'PARA ELIMINAR EL MONTO MÍNIMO DE REPARTO SOLO DEJA EN BLANCO EL TEXTO ASOCIADO Y ACTUALIZA' : 'SI TU NEGOCIO TIENE REPARTO DELIVERY GRATIS SOBRE UN MONTO MÍNIMO DE COMPRA, INGRESA TEXTO RELACIONADO Y EL MONTO.' ?>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	
        	<div class="row">

            <div class="col-12">
              <div class="form-group">
                <div class="input-group">
                  <textarea class="form-control" name="txt-monto" id="txt-monto" rows="3" placeholder="INGRESAR OBSERVACIÓN MONTO MÍNIMO DE ENTREGA GRATIS (*)..." required><?php echo $montoMinimo->MONTO_FLAG ? $montoMinimo->MONTO_OBS : '' ?></textarea>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                  <input type="number" class="form-control" name="number-monto" id="number-monto" placeholder="INGRESAR MONTO MÍNIMO (*)..." value="<?php echo $montoMinimo->MONTO_FLAG ? $montoMinimo->MONTO_VALOR : '' ?>" required>
                </div>
              </div>
            </div>

            <div class="col-12 mt-3">
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-block btn-guardar-monto"><?php echo $montoMinimo->MONTO_FLAG ? 'ACTUALIZAR' : 'INGRESAR' ?></button>
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
MODAL SECTORIZACIÓN
======================================-->
<div id="mdl-sector" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" id="formSector">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
          SECTORIZAR VALORES
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="form-row align-items-center">
            <div class="col-6">
              <input type="text" class="form-control mb-2" name="txt-sector" id="txt-sector" placeholder="INGRESAR SECTOR (*)..." required>
            </div>
            <div class="col-4">
              <div class="input-group mb-2">                
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                  <input type="number" class="form-control" name="precio-sector" id="precio-sector" placeholder="INGRESAR MONTO (*)..." required>
                </div>
              </div>
            </div>
            <div class="col-2">
              <button type="button" class="btn btn-primary btn-block mb-2 btn-guardar-sector">GUARDAR</button>
            </div>
          </div>

          <div id="sectorloading"></div>  
          <div id="tbl-sector"></div>  
          <?php if ( count($sectores) > 0 ){ ?>
            <div id="tbl-sector-php">
              <table class="table mt-4">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">SECTOR</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">ELIMINAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $sectores as $sector ){ ?>
                  <tr>
                    <td><?php echo $sector->SECTOR_OBS ?></td>
                    <td><?php echo $sector->SECTOR_VALOR ?></td>
                    <td><button type="button" class="btn btn-danger btn-delete-sector" value="<?php echo $sector->SECTOR_ID ?>"><i class="fas fa-trash"></i></button></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
        
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