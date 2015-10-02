<?php
/**
 * Minang Igniter
 *
 * Engine code untuk pengembangan aplikasi berbasis codeigniter
 * @link	http://ilmuprogrammer.com
 *
 * M_language
 *
 * Description:
 * Librari ini digunakan editing language codeigniter
 * Language file application/language
 *
 * Copy file ini pada application/libraries/M_language.php
 *
 * @copyright	Copyright (c) 2015 Heru Rahmat Akhnuari
 * @version 	1.0
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
defined('BASEPATH') OR exit('No direct script access allowed');

class M_language{


	protected $CI;

	function __construct(){
		$this->CI=& get_instance();
	}

	/**
	 * [getAllLanguage mengambil folder bahasa]
	 * @return array [description]
	 */
	function getAllLanguage(){
		$path=APPPATH.'language';
		$proses=scandir($path);
		$dpath=array_diff($proses, array('.', '..'));
		$output=array();
		foreach($dpath as $rpath=>$vpath){
			if(is_dir($path.'/'.$vpath)){
				$output[]=$vpath;
			}
		}
		return $output;
	}

/**
 * [getAllLanguageFile mengambil file bahasa yg berekstensi _lang.php]
 * @param  string $language [description]
 * @return array           [description]
 */
	function getAllLanguageFile($language){
		$path=APPPATH.'language/'.$language;
		if(is_dir($path)){
			$proses=scandir($path);
			$dpath=array_diff($proses, array('.', '..'));
			$output=array();
			$prefix="_lang.php";
			foreach($dpath as $rpath=>$vpath){
				if(is_file($path.'/'.$vpath)){
					$ext=pathinfo($path.'/'.$vpath,PATHINFO_EXTENSION);
					if($ext=="php"){
						$fLang=str_replace($prefix,"",$vpath);
						$output[]=$fLang;
					}
				}
			}
			return $output;
		}else{
			return null;
		}
	}

/**
 * [getCountSection Jumlah section $lang[] pada file di folder bahasa]
 * @param  string $language [description]
 * @param  string $file     [tidak pake _lang.php]
 * @return integer           [description]
 */
	function getCountSection($language,$file){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			require $path;
			if(!empty($lang)){
				$c=count($lang);
				return $c;
			}else{
				return 0;
			}

		}else{
			return 0;
		}
	}

/**
 * [getAllLanguageSection Mengambil semua data section $lang[] pada file bahasa]
 * @param  [type] $language  [description]
 * @param  [type] $file      [description]
 * @param  [boolean] $realArray [jika false sebagai array jika true sebagai stdClass]
 * @return [type]            [description]
 */
	function getAllLanguageSection($language,$file,$realArray=FALSE){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			require $path;
			if(!empty($lang)){
				if($realArray==TRUE){
				return $lang;
				}else{
					$item=array();
					foreach($lang as $key=>$val){
						$item[]=(object) array(
						'key'=>$key,
						'value'=>$val,
						);
					}
					return (object)$item;
				}
			}else{
				return null;
			}


		}else{
			return null;
		}
	}

/**
 * [saveLanguage Update section pada file bahasa]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  array $arr
 * Contoh pada controller :
 * $arr=array(
 * 'section'=>'value',
 * );
 * @return [boolean]           [description]
 */
	function saveLanguage($language,$file,$arr){

		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;

		if(is_file($path)){

			$this->CI->load->helper('file');
			$output='';
			$output.='<?php '."\n";
			$output.="defined('BASEPATH') OR exit('No direct script access allowed'); \n";
			foreach($arr as $key=>$val){
				$output.="$"."lang['".$key."']='".$val."';\n";
			}
			$output.='?>';
			delete_files($path);
			if(!write_file($path,$output)){
				return false;
			}else{
				return true;
			}

		}else{
			return false;
		}

	}

/**
 * [newLanguage membuat bahasa baru / folder bahasa baru]
 * @param  string $locale [description]
 * @return [type]         [description]
 */
	function newLanguage($locale){
		$path=APPPATH.'language';
		if(is_dir($path)){
			$newpath=$path.'/'.$locale;
			is_dir($newpath) || mkdir($newpath);
			return true;
		}else{
			return false;
		}
	}

/**
 * [newLanguageFile membuat file bahasa baru]
 * @param  [type] $language [description]
 * @param  [string] $file     [tanpa _lang.php]
 * @return [type]           [description]
 */
	function newLanguageFile($language,$file){
		$path=APPPATH.'language/'.$language;
		if(is_dir($path)){
			$prefix="_lang.php";
			$newpath=$path.'/'.$file.$prefix;
			$this->CI->load->helper('file');
			$output='';
			$output.='<?php '."\n";
			$output.="defined('BASEPATH') OR exit('No direct script access allowed'); \n";
			$output.='?>';

			if(!write_file($newpath,$output)){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

/**
 * [newLanguageSection description]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  [string] $section  [description]
 * @param  string $value    [description]
 * @return [type]           [description]
 */
	function newLanguageSection($language,$file,$section,$value=''){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			if($this->checkSectionExists($language,$file,$section)==FALSE){
				$this->CI->load->helper('file');
				$content=file($path);
				$lastline=array_pop($content);
				unset($content[$lastline]);
				$newcontent='';
				foreach($content as $k=>$v){
					$newcontent.=$v;
				}
				$output='';
				$output.=$newcontent;
				$output.="$"."lang['".$section."']='".$value."';\n";
				$output.='?>';
				delete_files($path);
				if(!write_file($path,$output)){
					return false;
				}else{
					return true;
				}
			}else{
				return false;
			}
		}
	}

/**
 * [getLanguageText mengambil semua isi file bahasa, bisa menggunakan textarea]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @return [type]           [description]
 */
	function getLanguageText($language,$file){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			$this->CI->load->helper('file');
			$item=read_file($path);
			return $item;
		}else{
			return "";
		}
	}

/**
 * [saveLanguageText Menyimpan file bahasa dari text]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  [type] $text     [bisa menggunakan textarea]
 * @return [type]           [description]
 */
	function saveLanguageText($language,$file,$text){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			$this->CI->load->helper('file');
			$output='';
			$output.=$text;
			delete_files($path);
			if(!write_file($path,$output)){
				return false;
			}else{
				return true;
			}
		}
	}

/**
 * [deleteLanguageSection Menghapus section pada file bahasa]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  [type] $section  [description]
 * @return [type]           [description]
 */
	function deleteLanguageSection($language,$file,$section){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			if($this->checkSectionExists($language,$file,$section)==FALSE){
				return false;
			}else{
				$this->CI->load->helper('file');
				$content=file($path);
				$lastline=array_pop($content);
				$secID=$this->sectionID($language,$file,$section);
				unset($content[$secID]);
				unset($content[$lastline]);
				$newcontent='';
				foreach($content as $k=>$v){
					$newcontent.=$v;
				}
				$output='';
				$output.=$newcontent;
				$output.='?>';

				delete_files($path);
				if(!write_file($path,$output)){
					return false;
				}else{
					return true;
				}

			}
		}else{
			return false;
		}
	}

/**
 * [deleteLanguageFile Menghapus file bahasa]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @return [type]           [description]
 */
	function deleteLanguageFile($language,$file){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			$proses=unlink($path);
			if($proses==TRUE){
				return true;
			}else{
				return false;
			}
		}
	}

/**
 * [deleteLanguage Menghapus bahasa atau semua file pada folder bahasa]
 * @param  [type] $language [description]
 * @return [type]           [description]
 */
	function deleteLanguage($language){
		$dir=APPPATH.'language/'.$language;
		if(is_dir($dir)){
			$structure = glob(rtrim($dir, "/").'/*');
		    if (is_array($structure)) {
		        foreach($structure as $file) {
		            if (is_dir($file)) RemoveDir($file);
		            elseif (is_file($file)) unlink($file);
		        }
		    }
		    rmdir($dir);
		    return true;
		}else{
			return false;
		}

	}

/**
 * [copyAllLanguage Copy paste file dari folder 1 bahasa ke bahasa lainnya]
 * @param  [type] $language [description]
 * @param  [type] $newlang  [description]
 * @return [type]           [description]
 */
	function copyAllLanguage($language,$newlang){
		$path=APPPATH.'language/'.$language;
		if(is_dir($path)){
			$this->CI->load->helper('file');
			$proses=scandir($path);
			$dpath=array_diff($proses, array('.', '..'));
			$output=array();
			$prefix="_lang.php";
			$this->newLanguage($newlang);
			$pathnew=APPPATH.'language/'.$newlang;
			foreach($dpath as $rpath=>$vpath){
				if(is_file($path.'/'.$vpath)){
					$ext=pathinfo($path.'/'.$vpath,PATHINFO_EXTENSION);
					if($ext=="php"){
						$content=read_file($path.'/'.$vpath);
						write_file($pathnew.'/'.$vpath,$content);
					}
				}
			}
			return true;
		}else{
			return false;
		}
	}

/**
 * [sectionID Mengambil ID dari section]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  [type] $section  [description]
 * @return [type]           [description]
 */
	function sectionID($language,$file,$section){
		$arr=$this->getAllLanguageSection($language,$file,TRUE);
		return array_search($section,array_keys($arr))+2;
	}

/**
 * [checkSectionExists Cek jika section ada]
 * @param  [type] $language [description]
 * @param  [type] $file     [description]
 * @param  [type] $section  [description]
 * @return [type]           [description]
 */
	private function checkSectionExists($language,$file,$section){
		$prefix="_lang.php";
		$path=APPPATH.'language/'.$language.'/'.$file.$prefix;
		if(is_file($path)){
			require $path;
			if(!empty($lang)){
				if(array_key_exists($section,$lang)){
				return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}
	}

}
