<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/default/easyui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/icon.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/manual/manual.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.easyui.min.js'); ?>"></script>
</head>
<body>
    <div class="center-layout">
        <div class="easyui-layout" style="width:100%;height:600px;">
            <div id="p" data-options="region:'west'" title="Menu" style="width:7%;padding:10px">
                <?php 
                    $user_id = $this->session->userdata("user_id");
                    $qmenu=$this->db->query("SELECT a.id,a.title,a.icon,a.uniq_menu FROM menu a INNER JOIN menu_setting b ON a.id = b.menu_id WHERE b.user_id='".$user_id."'");
                    foreach($qmenu->result() as $row){
                ?>
                 <a href="javascript:void(0)" class="easyui-linkbutton to_menu" menu="<?php echo site_url($row->uniq_menu); ?>" style="width:100%" data-options="iconCls:'<?php echo $row->icon; ?>',size:'large',iconAlign:'top'"><?php echo $row->title; ?></a>
                <div style="margin:10px 0;"></div>
                <?php }?>
            </div>
            <div data-options="region:'center'" title="Content">
                <div class="manual-content">
                     <?php $this->load->view($content);?>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(".to_menu").click(function (e){
        $(".manual-content").empty();
         e.preventDefault();
        var menu = $(this).attr('menu');
        $(".manual-content").load(menu, function(response, status, xhr){
          if (xhr.responseText.trim().startsWith("<!doctype html>")) {
            console.log("redirect to login page");
            window.location.href = menu;
          }
        });
    });
</script>
</html>