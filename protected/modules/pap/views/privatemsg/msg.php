<div class="history">
        	<h3>
                <i>与 <?php echo $organinfo['OrganName'].'-'.$organinfo['UserName']?>的聊天记录</i>
                <a class="fr">
<!--            	<input type="text" value="" placeholder="查找私信记录" />
                <input type="submit" id="search" value="" />-->
            	</a>
            </h3>
            <div class="somebody" style='overflow: auto'>
            	<div class="messages">
<!--                    <h6 class="time"><i>2015-01-23</i></h6>-->
                    <?php if(!empty($record)&&is_array($record)){
                      foreach($record as $key=>$value):?>
                  <?php 
                  if(isset($value['userid'])&&!empty($value['userid'])){
                   $organ= ChatService::getuserinfo($value['userid']);
                  }
                   $tousertime=$value['time'];
                  if(Yii::app()->user->id==$value['userid']):
                   $organs= ChatService::getuserinfo(Yii::app()->user->id);
                      ?>
                      <?php if(isset($value['msg'])&&!empty($value['msg'])):?>
                    <ul>
                        <li class="i_two">
                            <span class="headimg"><img src="<?php echo $value['imgsrc']?>" /><?php //$organ= ChatService::getuserinfo($value['touser']['userid']);var_dump($organ['OrganName']) ?></span>
                        <div class="bj">
                        <div class="c_lt">
                        <div class="c_bl">
                        <div class="c_br">
                        <div class="c_rt">
                     
                        <p style='word-wrap:break-word'>
                        <?php
                           switch ($value['ftype']){
                               case 0:
                                   echo $value['msg']."&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);
                                   break;
                               case 1:
                                   echo '<img src="'. Yii::app()->params->ftpserver["visiturl"].$value['msg'].'" style="max-width: 260px;">'."&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);;
                                   break;
                               case 2:
                                   echo '<b class="downname" style="cursor:pointer">'.$value['fname'].'</b><p><span class="download" url="'.$value['msg'].'" '
                                       . 'style="cursor:pointer;float:none"><a href="javascript:void(0)" '
                                       . 'style="text-decoration:underline">附件下载</a></span>'
                                       . ' &nbsp;&nbsp;'.
                                       '<a href="'. Yii::app()->params->ftpserver["visiturl"].$value['msg'].''
                                       . '" target="_blank" style="text-decoration:underline">预览</a></p>'
                                       ."&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);;
                                   break;
                           }
                        ?>
                        </p>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                            <div style='clear: both'></div>
                        </li>
                         <?php continue;endif;?> 
                    </ul>
                       <?php endif;?>
                       <?php if(isset($value['msg'])&&!empty($value['msg'])):?>
                    <ul class="mine">
                        <li class="i_fiv"><span class="headimg"><img src="<?php echo $value['imgsrc']?>" /></span>
                        <div class="mbj">
                        <div class="mc_rt">
                        <div class="mc_lt">
                        <div class="mc_br">
                        <div class="mc_bl">
                        <p style='word-wrap:break-word'>
                        <?php
                           switch ($value['ftype']){
                               case 0:
                                   echo $value['msg']."&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);
                                   break;
                               case 1:
                                   echo '<img src="'. Yii::app()->params->ftpserver["visiturl"].$value['msg'].'" style="max-width: 260px;">'.
                                       "&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);;
                                   break;
                               case 2:
                                   echo '<b class="downname" style="cursor:pointer;">'.$value['fname'].'</b><p><span class="download" url="'.$value['msg'].'" style="cursor:pointer;float:none"><a href="javascript:void(0)" style="text-decoration:underline">附件下载</a></span> &nbsp;&nbsp;'.'<a href="'. Yii::app()->params->ftpserver["visiturl"].$value['msg'].'" target="_blank" style="text-decoration:underline">预览</a></p>'."&nbsp;&nbsp;&nbsp;".date('Y-m-d H:i:s',$tousertime);;
                                   break;
                           }
                        ?>
                        </p>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                              <div style='clear: both'></div>
                        </li>
                    </ul>
                     <?php endif;?>
                     <?php  endforeach;}else{?>
                <div style='padding-left:100px'>无消息记录</div>
                  <?php }?>
                </div>
            </div>
            <!--发送栏-->
<!--            <div class="msend">
            	<input type="text" name="Name" class="tcal" value="" id="tim" />
            </div>-->
        </div>
