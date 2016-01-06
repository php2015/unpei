<div class="lis-info-list">
    <div class="float_l  m-left15"><input class="checkbox" type="checkbox" name='selectnews' value='<?php echo $data['ID'] ?>'></div>
    <div class="float_l m-left10 info-list <?php echo $data['ReadStatus'] == 1 ? 'info-list-readed' : '' ?>">
        <a href='javascript:;' class='open_news' key='<?php echo $data['ID']?>'>
            <div class="info-time float_l"><?php echo date('Y-m-d H:i:s', $data['CreateTime']); ?></div>
            <div class="float_l info-cons news_title">
                <?php echo $data['Title']; ?>            
            </div>
        </a>
    </div>
    <div class="clear"></div>
    <div class="w600 m_left205 line25 system" style='word-break:break-all'><?php echo $data['Content']; ?></div>
</div>