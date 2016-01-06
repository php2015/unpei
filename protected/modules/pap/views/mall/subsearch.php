<div class="content1a">
    <?php if ($m):foreach ($m as $k => $v): ?>
            <div class="content1a_info">
                <?php
                if ($get['sub'] == $v['ID']) {
                    $class = "yjlm_current";
                    $block = 'display:block';
                } else {
//                    if ($k < 5) {
//                        $class = "yjlm_zhankai";
//                        $block = 'display:block';
//                    } else {
                    $class = 'yjlm';
                    $block = '';
//                    }
                }
//                if ($k >= 15) {
//                    $subblock = 'display:none';
//                }
                $search1 = $get;
                unset($search1['sub'], $search1['code'], $search1['page']);
                $search1['sub'] = $v['ID'];
                ?>
        <!--                <div style="<?php //echo $subblock  ?>">-->
                <a href="<?php echo yii::app()->createUrl('pap/mall/search', $search1) ?>"><p class="<?php echo $class ?>"><?php echo $v['Name'] ?></p></a>
                <!--                </div>-->
                <div class="ejlm" style="<?php echo $block ?>">
                    <?php if ($v['codestr'] && $v['codename']): ?>
                        <?php
                        $codearr = explode(',', $v['codestr']);
                        $codename = explode(',', $v['codename']);
                        ?>
                        <ul>
                            <?php foreach ($codearr as $kk => $vv): ?>
                                <?php
                                $search2 = $get;
                                unset($search2['sub'], $search2['code'], $search2['page']);
                                $search2['sub'] = $v['ID'];
                                $search2['code'] = $vv;
                                ?>
                                <li>
                                    <a style="<?php echo $get['code'] == $vv ? 'color:#ec8051' : ''; ?>" href="
                <?php echo yii::app()->createUrl('pap/mall/search', $search2) ?>"><?php echo $codename[$kk] ?>
                                    </a>
                                </li>
                        <?php endforeach; ?>
                        </ul>
        <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="">暂无商品分类</div>
<?php endif; ?>
</div>