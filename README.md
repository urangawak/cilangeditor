<h3>Codeigniter Language Editor</h3>
<b>System Requirement :</b>
<li>PHP 5.4</li>
<li>Codeigniter 3.x</li>

<b>Language Path : application/language</b><br/>

<b>Usage :</b><br/>
<code>$this->load->library('m_language');</code>

<b>1. Get All Language</b></br>
<code>
$fetchLang=$this->m_language->getAllLanguage();
foreach($fetchLang as $rLang)
{
	echo $r.'<br>';
}
</code>

<b>2. Add Folder Language</b><br/>
<code>
Example : indonesia
$this->m_language->newLanguage("indonesia");
</code>

<b>3. Add File Language</b><br/>
<code>
Example : system_lang.php

$this->m_language->newLanguageFile("indonesia","system");
</code>

<b>4. Add Section</b><br/>
<code>
Example : $lang['title']="Judul";

$this->m_language->newLanguageSection("indonesia","system","title","Judul");
</code>

<b>5. Delete Section</b><br/>
<code>
$this->m_language->deleteLanguageSection("indonesia","system","title");
</code>

<b>6. Delete File</b><br/>
<code>
$this->m_language->deleteLanguageFile("indonesia","system");
</code>

<b>7. Duplicate Language (All Files)</b><br/>
<code>
$this->m_language->copyAllLanguage("indonesia","english);
</code>


<b>8. Save section (one section)</b><br/>
<code>
$arr=array(
'title'=>'Judul Aplikasi',
);
$this->m_language->saveLanguage("indonesia","system",$arr);
</code>

<b>9. Save section (multiple section)</b><br/>
You can create more input html
<code>
<input type="text" name="sec[title]" value="Judul"/>
<input type="text" name="sec[user]" value="Pengguna"/>
<input type="text" name="sec[pass]" value="Kata Kunci"/>

$this->m_language->saveLanguage("indonesia","system",$_POST['sec']);
</code>