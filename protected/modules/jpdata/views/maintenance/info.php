<div id="tab-container" class="tabbable">
    <ul class="nav2 nav-tabs" style="margin-bottom:10px">
        <li class="">
            <a href="#info-maintenance" data-toggle="tab" id='by'>保养周期</a>
        </li>
        <li class="">
            <a href="#info-wearpart" data-toggle="tab" id='wk'>易损件更换周期</a>
        </li>
        <div style="clear:both"></div>
    </ul>
   
</div>
 <div class="auto_height panel-container tab-content" >
        <div class="tab-pane active" id="info-maintenance">
            <?php
            $this->renderPartial('maintenance', array('vehicleID' => $vehicleID, 'vehicle' => $vehicle,
                'maintenanceItem' => $maintenanceItem, 'maintenanceModel' => $maintenanceModel));
            ?>
        </div>

        <div class="tab-pane" id="info-wearpart" >
            <?php $this->renderPartial('wearpart', array('vehicleID' => $vehicleID, 'vehicle' => $vehicle, 'wearpartModel' => $wearpartModel)); ?>
        </div>
    </div>	
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.idTabs.min.js'></script>
<script>
      $('#info-wearpart').hide();
       $('#by').addClass('selected');
    $('#wk').click(function(){
        $('#info-maintenance').hide();
        $('#info-wearpart').show();
        $(this).addClass('selected');
        $('#by').removeClass('selected');
    });
     $('#by').click(function(){
        $('#info-maintenance').show();
        $('#info-wearpart').hide();
         $(this).addClass('selected');
          $('#wk').removeClass('selected');
    });
    $("#tab-container ul").idTabs();
</script>