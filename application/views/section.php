<script>
$(document).ready(function(){
	$("#ss").click(function(){
		$("#myModal").modal("show");
	});
});
</script>
<button class="btn btn-success" data-toggle="modal" id="ss">
  <span class="glyphicon glyphicon-plus"></span> Item Baru
</button>
<a href="<?=base_url();?>editor/changemanual?lang=<?=$lang;?>&file=<?=$file;?>" class="btn btn-primary">Edit Manual</a>
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Item Baru</h4>
      	</div>
      	<div class="modal-body">
      	<div id="newsection">		
		<?php
		$att=array(
		'class'=>'form-horizontal',
		);
		echo form_open(base_url().'editor/addsection',$att);
		?>
		<input type="hidden" name="lang" value="<?=$lang;?>"/>
		<input type="hidden" name="file" value="<?=$file;?>"/>
		<div class="form-group">
		<label class="col-sm-2 control-label">Section</label>
		<div class="col-md-8">
		<input type="text" name="section" class="form-control"/>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 control-label">Value</label>
		<div class="col-md-10">
		<textarea name="sectionvalue" class="form-control"></textarea>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-md-8">
		<button type="submit" class="btn btn-primary">Tambah</button>
		<button type="button" id="closeadd" class="btn btn-default" data-dismiss="modal">Batal</button>
		</div>
		</div>
		<?php echo form_close();?>
		</div>
		</div>
    </div>
  </div>
</div>


<br/>
<br/>
<?php
$this->load->library('m_language');
$d=$this->m_language->getAllLanguageSection($lang,$file,FALSE);
echo form_open(base_url().'editor/saveall');
?>
<input type="hidden" name="lang" value="<?=$lang;?>"/>
<input type="hidden" name="file" value="<?=$file;?>"/>
<table class="table table-bordered table-hover">
<thead>
	<th>Item</th>
	<th>Terjemahan</th>
	<th>#</th>
</thead>
<tbody>
<?php
if(!empty($d)){
foreach($d as $r){
	
	?>
	<tr>
		<td><?=ucfirst($r->key);?></td>
		<td>
			<textarea class="form-control" name="klang[<?=$r->key;?>]"><?=$r->value;?></textarea>			
		</td>
		<td width="5%">
			<a onclick="return confirm('Yakin ingin menghapus item ini?');" href="<?=base_url();?>editor/delsection?lang=<?=$lang;?>&file=<?=$file;?>&section=<?=$r->key;?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
	</tr>	
	<?php
}	
}

?>
</tbody>
</table>
<button type="submit" class="btn btn-md btn-primary pull-right">Simpan Semua</button>
<?php
echo form_close();
?>
