<div style="margin-top: 2cm;" class="row">
    <div class="span3">
    <h2><?php echo $nombre_empresa; ?></h2>
    <h4><a class="btn btn-danger">Administracion de <?php echo $nombre_modulo; ?></a></h4>
    </div>
    <div class="span3">
        <span id="liveclock" ></span>
        <br />
        <span class="label label-success"><?php echo getFechaEnLetras();?>
        </span>
    
    </div>
    <div class="span3"><img style="height: 120px; width: 300px;" class="img-polaroid" src="<?php echo base_url(); ?>assets/uploads/files/parametros_generales/<?php echo $imagen_corporativa; ?>" /></div><div class="span3"><span style="float: right;" class='label label-info'>Hola, <?php echo $nombre_usuario; ?> <span class="icon-user"></span></span><img style="width: 75px; height: 100px; float: right;" class="img-circle" src="<?php echo base_url();?>assets/uploads/files/usuarios/<?php echo $imagen_usuario; ?>" /></div>
</div>
<hr />