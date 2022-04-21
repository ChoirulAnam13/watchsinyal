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
    <div style="text-align: center;margin-top:100px;">
        <h2>APP PNL BINANCE</h2>
        <div style="margin:20px 0 10px 0;"></div>
        <div class="center-login">
             <div class="easyui-panel" title="Login to system" style="width:90%;padding:30px 60px;">
                <div style="margin-bottom:10px">
                    <input class="easyui-textbox" id="username" style="width:100%;height:40px;padding:12px" data-options="prompt:'Username',iconCls:'icon-man',iconWidth:38">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="password" type="password" style="width:100%;height:40px;padding:12px" data-options="prompt:'Password',iconCls:'icon-lock',iconWidth:38">
                </div>
                <div>
                    <a href="javascript:void(0)" class="easyui-linkbutton" id="btn-login" data-options="iconCls:'icon-ok'" style="padding:5px 0px;width:100%;">
                        <span style="font-size:14px;">Login</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
      $(document).ready(function() {

        $("#btn-login").click( function() {
            
              var username = $("#username").val();
              var password = $("#password").val();

              if(username.length == "") {

                $.messager.alert('Pemberitahuan','Username belum diinputkan !','warning');

                return false;
              }

              if(password.length == "") {

                $.messager.alert('Pemberitahuan','Password belum diinputkan !','warning');

                return false;
              }

               $.ajax({

                    url: "<?php echo site_url('Login/Checking') ?>",
                    type  : 'POST',
                    async : true,
                    dataType : 'json',
                    data: {
                          "username": username,
                          "password": password
                    },
                    success:function(response){
                        if (response.view_return == "OK") {

                            var win = $.messager.progress({
                                title:'Login Berhasil',
                                msg:'Loading data...'
                            });
                            setTimeout(function(){
                                $.messager.progress('close');
                                window.location.href = "<?php echo site_url('Dashboard') ?>";
                            },2000);

                        }else{
                            $.messager.alert('Gagal','Login gagal !','warning');
                            return false;
                        }

                        console.log(response);

                    },
                    error:function(response){

                        $.messager.alert('Error','Server error !','error');
                        return false;

                        console.log(response);

                      }
                  });
        });
      });
</script>
</html>