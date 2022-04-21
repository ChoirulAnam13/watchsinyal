 <table class="easyui-datagrid" data-options="border:false,singleSelect:true,fit:true,fitColumns:true">
    <thead>
        <tr>
            <th width="80">BNB/BUSD</th>
            <th width="80">BTC/BUSD</th>
            <th width="80">ETH/BUSD</th>
            <th width="80">BUSD/IDR</th>
        </tr>
         <tr>
            <td id="bnb"></td>
            <td id="btc"></td>
            <td id="eth"></td>
            <td id="idr"></td>
         </tr>
    </thead>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        getPrice();
    });
    function getPrice(){
        $.ajax({
          type: "GET",
          url: "<?php echo site_url('Pnl/getPrice') ?>",
          cache: false,
          success: function(data){
            var res = JSON.parse(data);
            console.log(res);
            if (res==null) {
                 $("#bnb").text("...");
                 $("#btc").text("...");
                 $("#eth").text("...");
                 $("#idr").text("...");
            }else{
                 $("#bnb").text(res.bnb);
                 $("#btc").text(res.btc);
                 $("#eth").text(res.eth);
                 $("#idr").text(res.idr);
            }
          }
        });
    }
</script>