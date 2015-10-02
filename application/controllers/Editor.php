<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Editor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('m_language');
    }
    
    function index()
    {
        $this->load->view('header');
        $this->load->view('footer');
    }
    
    function getlang(){
		$d['lang']=$this->input->get('lang');
    	$this->load->view('header');
		$this->load->view('file',$d);
		$this->load->view('footer');
	}
	
	function dellang(){
		$lang=$this->input->get('lang');
		$this->m_language->deleteLanguage($lang);
		redirect(base_url());
	}
	
	function copyas(){
		$lang=$this->input->post('lang');
		$newlang=$this->input->post('newlang');
		$this->m_language->copyAllLanguage($lang,$newlang);
		redirect(base_url().'editor/getlang?lang='.$newlang,'refresh');
	}
	
	function delfile(){
		$lang=$this->input->get('lang');
		$file=$this->input->get('file');
		$this->m_language->deleteLanguageFile($lang,$file);
		redirect(base_url().'editor/getlang?lang='.$lang,'refresh');
	}
	
	function saveall(){
		
		$lang=$this->input->post('lang');
		$file=$this->input->post('file');
		$this->m_language->saveLanguage($lang,$file,$_POST['klang']);
		redirect(base_url().'editor/getsection?lang='.$lang.'&file='.$file,'refresh');
	}
	
	function changemanual(){
		$lang=$this->input->get('lang');
		$file=$this->input->get('file');
		$this->load->view('header');
		$d['data']=$this->m_language->getLanguageText($lang,$file);
		$d['lang']=$lang;
		$d['file']=$file;
		$this->load->view('filemanual',$d);
		$this->load->view('footer');
	}
	
	function savetext(){
		$lang=$this->input->post('lang');
		$file=$this->input->post('file');
		$data=$this->input->post('data');
		$this->m_language->saveLanguageText($lang,$file,$data);
		redirect(base_url().'editor/getsection?lang='.$lang.'&file='.$file,'refresh');
	}
	
	function getsection(){
    	$d['lang']=$this->input->get('lang');
    	$this->load->view('header');
    	$d['file']=$this->input->get('file');
    	
		$this->load->view('section',$d);
		$this->load->view('footer');
	}
	
	function addsection(){
		$lang=$this->input->post('lang');
		$file=$this->input->post('file');
		$sec=$this->input->post('section');
		$val=$this->input->post('sectionvalue');
		$this->m_language->newLanguageSection($lang,$file,$sec,$val);
		redirect(base_url().'editor/getsection?lang='.$lang.'&file='.$file,'refresh');
	}
	
	function delsection(){
		$lang=$this->input->get('lang');
		$file=$this->input->get('file');
		$sec=$this->input->get('section');
		$this->m_language->deleteLanguageSection($lang,$file,$sec);
		redirect(base_url().'editor/getsection?lang='.$lang.'&file='.$file,'refresh');
	}
	
	function addlanguage(){
		$lang=$this->input->post('lang');
		$this->m_language->newLanguage($lang);
		redirect(base_url().'editor/getlang?lang='.$lang,'refresh');
	}
	
	function addfile(){
		$lang=$this->input->post('lang');
		$file=$this->input->post('file');
		$this->m_language->newLanguageFile($lang,$file);
		redirect(base_url().'editor/getlang?lang='.$lang,'refresh');
	}
    
}