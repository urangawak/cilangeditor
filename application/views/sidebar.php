<div class="panel panel-default">
<div class="panel-heading"><h3>Bahasa</h3></div>
<div class="panel-body">
<script>
$(document).ready(function(){
$(".copyas").each(function(){
	$(this).click(function(){
		var did=$(this).attr('data-id');
		$(".modalcopy").modal("show");
		$("#copyaslang").val(did);
	});
});

});
</script>
<div class="modal fade modalcopy" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Duplikat Bahasa</h4>
      </div>
      <div class="modal-body">
      <?php
      echo form_open(base_url().'editor/copyas');
      ?>
      <input type="hidden" id="copyaslang" name="lang" value=""/>
      <label>Bahasa Baru</label>
      <div class="form-group">
      <input type="text" name="newlang" class="form-control" required=""/>
      </div>
      <button type="submit" class="btn btn-primary btn-md">Duplikasi</button>
      <?php
      echo form_close();
      ?>
      </div>
    </div>
  </div>
</div>

<?php
$d=$this->m_language->getAllLanguage();
foreach($d as $r){
	echo '<label>';
	?>
	<a href="<?=base_url().'editor/getlang?lang='.$r;?>"><?=strtoupper($r);?></a>
	<?php
	echo '</label>';
	?>
	<a onclick="return confirm('Yakin ingin menghapus bahasa ini?');" href="<?=base_url();?>editor/dellang?lang=<?=$r;?>" class="text-danger"> Hapus</a>
	<a data-id="<?=$r;?>" href="javascript:;" class="text-success copyas"> Copy As</a><br/>
	<?php
}
?>
</div>
<div class="panel-footer">
<?php
$att=array(
'class'=>'',
);
echo form_open(base_url().'editor/addlanguage',$att);
?>
<label>Tambah Bahasa</label>
<div class="form-group">	
	<input type="text" name="lang" class="form-control" required="" placeholder="tulisan kecil"/>
</div>
<button type="submit" class="btn btn-primary btn-md">Tambah</button>
<?php
echo form_close();
?>
</div>
</div>