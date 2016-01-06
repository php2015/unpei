 <?php foreach($relativer as $key=>$value): ?>
                            <li class="i_one active"  key="<?php echo $value['sessionid']?>" touserid='<?php echo $value['userid']?>'><span class="headimg"><img src="<?php echo F::uploadUrl().$value['Path']?>" /></span>
                                <div class='he' title='<?php echo $value['OrganName'].'-'.$value['UserName']?>'><?php echo $value['OrganName'].'-'.$value['UserName']?></div></li>
 <?php endforeach;?>