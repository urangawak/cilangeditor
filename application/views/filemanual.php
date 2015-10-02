<?php
echo form_open(base_url().'editor/savetext');
?>
<input type="hidden" name="lang" value="<?=$lang;?>"/>
<input type="hidden" name="file" value="<?=$file;?>"/>
<div class="form-group">
<textarea class="form-control" rows="18" name="data"><?=$data;?></textarea>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<?php
echo form_close();
?>