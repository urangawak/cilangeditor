<h3>Codeigniter Language Editor</h3>
<b>System Requirement :</b>
<li>PHP 5.4</li>
<li>Codeigniter 3.x</li>

Language Path : application/language

Usage :
$this->load->library('m_language');

1. Get All Language
$fetchLang=$this->m_language->getAllLanguage();
foreach($fetchLang as $rLang)
{
	echo $r.'<br>';
}

2. Add Folder Language
Example : indonesia
$this->m_language->newLanguage("indonesia");

3. Add File Language
Example : system_lang.php

$this->m_language->newLanguageFile("indonesia","system");


4. Add Section
Example : $lang['title']="Judul";

$this->m_language->newLanguageSection("indonesia","system","title","Judul");


5. Delete Section
$this->m_language->deleteLanguageSection("indonesia","system","title");


6. Delete File
$this->m_language->deleteLanguageFile("indonesia","system");

7. Duplicate Language (All Files)
$this->m_language->copyAllLanguage("indonesia","english);

8. Save section (one section)
$arr=array(
'title'=>'Judul Aplikasi',
);
$this->m_language->saveLanguage("indonesia","system",$arr);

9. Save section (multiple section)
You can create more input html

<input type="text" name="sec[title]" value="Judul"/>
<input type="text" name="sec[user]" value="Pengguna"/>
<input type="text" name="sec[pass]" value="Kata Kunci"/>

$this->m_language->saveLanguage("indonesia","system",$_POST['sec']);