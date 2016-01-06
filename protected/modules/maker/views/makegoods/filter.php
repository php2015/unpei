<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/filter.css">
<div id="zxq_box" style=" display:none">
    <div class="zxq_sx"><span style="margin-left:10px">高级筛选</span></div>
	<div class="zxq_mainlist">
    <form>
	<div class="zxq_xtgg">
      <div class="zxq_xtggxz">
          <div>
              <div  class="zxq_xtgginfo">芯体规格：</div>
               <div style="text-align:left; float:left; text-align:left;width:670px">
              <span class="zxq_x1" style=" margin-left:12px">
                        <span>芯宽</span>：<input type="text" name='w-width' class="zxq_input zxq_input1" id="w-width" key="each">&nbsp;mm</span>
              <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
              <span class="zxq_x1">
                       <span>芯高</span>：<input type="text" name='w-height' class="zxq_input zxq_input1" id="w-height" key="each">&nbsp;mm</span>
              <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
              <span class="zxq_x1">
                   <span>芯厚</span>：<input type="text" name= 'w-thick' class="zxq_input zxq_input1" id="w-thick" key="each">&nbsp;mm</span>
              <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
             <br>
              &nbsp;
             </div>         
          </div> 
          <div style="clear:both"></div>
          <div style="padding-top:6px; height:24px; line-height:24px">
              <div  class="zxq_xtgginfo">外形尺寸：</div>
               <div style="text-align:left; float:left; text-align:left;width:670px">
              <span class="" style=" margin-left:12px">
                   <span>总宽</span>：<input type="text"  name='n-width' class="zxq_input zxq_input1" id="n-width" key="each">&nbsp;mm</span>
              <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
              <span class="zxq_x1">
              <span>总高</span>：<input type="text" name='n-height' class="zxq_input zxq_input1" id="n-height" key="each">&nbsp;mm</span>
              <span class="i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
              
             <span class="zxq_x1">
                <span>总厚</span>：<input type="text"  name='n-thick' class="zxq_input zxq_input1" id="n-thick" key="each">&nbsp;mm</span>              <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>              
             </div>         
          </div> 
          
          
          
          <div style="clear:both"></div>
           <div style=" padding-top:6px;">
              <div  class="zxq_xtgginfo">水管：</div>
              <div style="text-align:left; float:left; text-align:left;width:670px">
              <span style=" margin-left:12px">
                       <span>进水管直径</span>：<select name="in" class="zxq_input  zxq_input2" style="width:56px" id="inlet">
                       <option value ="">请选择</option>
                       <option value ="左">左</option>
                       <option value ="右">右</option></select></span>           
              <span class="zxq_x1"><input type="text" class="zxq_input" value="输入数值" style="width:56px" id="insize"></span>
              <span class="zxq_x1">
                   <span>出水管直径</span>：<select name="out" class="zxq_input zxq_input2" style="width:56px" id="outlet">
                       <option value ="">请选择</option>
                       <option value ="右">右</option>
                       <option value ="左">左</option></select></span>           
              <span style="margin-left:10px">
              <input type="text" class="zxq_input" value="输入数值" style="width:56px" id="outsize"></span>            
             <span style="padding-left:20px">芯体管带规格</span>：<select name='standard' class="zxq_input zxq_input2" id="standard">
                       <option value ="">请选择规格</option>
                       <option value ="18管双排">18管双排</option>
                       <option value ="22管双排">22管双排</option>
                       <option value ="26管双排">26管双排</option>
                       <option value="22管波8">22管波8</option>
                       <option value="32管波8">32管波8</option>
                       <option value="42管波8">42管波8</option>
                      </select>
            </div>
           
          </div> 
          <div style="clear:both"></div>
           <div style="padding-top:6px;height:24px; line-height:24px">
              <div  class="zxq_xtgginfo" id="install">安装：</div>
              <div style="text-align:left; float:left; text-align:left;width:670px">
             <span style=" margin-left:12px"> 
                    <span>安装方式</span>:&nbsp;&nbsp;
                    <select name="set" class="zxq_input zxq_input2" style="width:110px" id="set" > 
                       <option value ="">选择安装方式</option>
                       <option value ="支架">支架</option>
                       <option value ="框架">框架</option>
                       <option value ="螺栓">螺栓</option>
                     </select>

                </span>  
                <span class="zxq_x1"><span>安装尺寸</span>:&nbsp;&nbsp;&nbsp;<input type="text" class="zxq_input zxq_input1"  style="width:56px" id="installsize" key="each"></span>
                <span class=" i_box" style=" margin-left:5px"><a href="javascript:;" class="J_minus">-</a><input type="text" value="0" class="J_input" /><a href="javascript:;" class="J_add">+</a></span>
                &nbsp;&nbsp;&nbsp;
                <span>放水阀</span>:
                  <select name="subwater" class="zxq_input zxq_input2" style="width:110px" id="subwater" > 
                       <option value ="">选择放水阀方向</option>
                       <option value ="左">左</option>
                       <option value ="右">右</option>
                       <option value ="前左">前左</option>
                       <option value ="前右">前右</option>
                       <option value ="后左">后左</option>
                       <option value ="后右">后右</option>
                       <option value ="上右">上右</option>
                       <option value ="上左">上左</option>
                       <option value ="下右">下右</option>
                       <option value ="下左">下左</option>
                       <option value ="下中">下中</option>
                     </select>          
               <div>
                  <span style=" margin-left:12px">加水口位置</span>:
                  <select name="addwap" class="zxq_input zxq_input2" style="width:110px" id="addwap" > 
                       <option value ="">选择加水口位置</option>
                       <option value ="偏右">偏右</option>
                       <option value ="中间">中间</option>
                       <option value ="居中">居中</option>
                       <option value ="偏左">偏左</option>
                       <option value ="中间偏前">中间偏前</option>
                       <option value ="中间偏右">中间偏右</option>
                       <option value ="中间偏左">中间偏左</option>
                       <option value ="引流管">引流管</option>
                       <option value ="小管">小管</option>
                       <option value ="右侧引出">右侧引出</option>
                       <option value ="引出居中">引出居中</option>
                       <option value ="引出偏右">引出偏右</option> 
                     </select>
                  &nbsp;
                  <span>加水口方向</span>:
                  <select name="addwad" class="zxq_input zxq_input2" style="width:110px" id="addwad" > 
                       <option value ="">选择加水口方向</option>
                       <option value ="左">左</option>
                       <option value ="右">右</option>
                       <option value ="前左">前左</option>
                       <option value ="前中">前中</option>
                       <option value ="前右">前右</option>
                       <option value ="右上">右上</option>
                       <option value ="偏右">偏右</option>
                     </select>
                  <span style="margin-left:100px"><input type="button" value="查 询" class="submit" id="filterbutton"></span>        
              </div>
              </div>
          </div>
          <div style="clear:both"></div>
      </div>
    </div>
    </form>
	</div>
</div>
<div style=" clear:both"></div>
<p class="zxq_slide" id="screen"><a href="" class="zxq_btn-slide">高级筛选</a></p>



