<table class="table table-bordered table-hover">
<thead>
	<th>Nama</th>
	<th>Info</th>	
	<th></th>
</thead>
<tbody>
<?php
$d=$this->m_language->getAllLanguageFile($lang);
foreach($d as $r){
	$c=$this->m_language->getCountSection($lang,$r);
	$path=APPPATH.'language/'.$lang.'/'.$r.'_lang.php';
?>
	<tr>
		<td><?=ucfirst($r);?></td>
		<td>
			<?php
			$lastMod=fileInfo($path,'date');
			$size=number_format(fileInfo($path,'size')/1024,2);
			echo '<li>Jumlah item : '.$c.'</li>';
			echo '<li>Diperbaharui : '.date("d-M-Y H:i:s",$lastMod).'</li>';
			echo '<li>Ukuran : '.$size.' KB</li>';
			?>
		</td>		
		<td width="20%">
			<a href="<?=base_url();?>editor/getsection?lang=<?=$lang;?>&file=<?=$r;?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-search"></span></a>
			<a href="<?=base_url();?>editor/changemanual?lang=<?=$lang;?>&file=<?=$r;?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
			<a onclick="return confirm('Yakin ingin menghapus file ini?');" href="<?=base_url();?>editor/delfile?lang=<?=$lang;?>&file=<?=$r;?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
	</tr>
<?php
}
?>
</tbody>
<tfoot>
	<tr>
		<td colspan="3">
		<?php
		$att=array(
		'class'=>'form-inline',
		);
		echo form_open(base_url().'editor/addfile',$att);
		?>
		<input type="hidden" name="lang" value="<?=$lang;?>"/>
		<div class="form-group">
			<label>Tambah File</label>
			<input type="text" name="file" class="form-control" required="" placeholder="tulisan kecil"/>
		</div>
		<button type="submit" class="btn btn-primary btn-md">Tambah</button>
		<br/>
		<small class="text-info">Tambah file tanpa menambahkan ekstensi _lang.php</small>
		<?php
		echo form_close();
		?>
		</td>
	</tr>
</tfoot>
</table>