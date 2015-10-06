<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Language Editor</title>
    <link href="<?=base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=base_url();?>jquery-1.11.3.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	body
	{		
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-weight: 400;
		padding: 40px;
	}	
	</style>
  </head>
  <body>
    <div class="container">
    	<div class="col-md-4">
    		<?php $this->load->view('sidebar');?>
    	</div>
    	<div class="col-md-8">
    	<?php
		$langV=$this->input->get('lang');
		$fileV=$this->input->get('file');
		if(!empty($langV)){
			$metainfo=$this->m_language->metaInfo($langV);
			$metaoutput='<strong>Lang ID : '.$metainfo['langid'].'</strong><br>';
			if(!empty($fileV)){
				echo '<h4>Bahasa : '.strtoupper($langV).' , File : '.strtoupper($fileV).'</h4>';				
			}else{
				echo '<h4>Bahasa : '.strtoupper($langV).'</h4>';
			}
			echo $metaoutput;
			
		}		
		
		?>