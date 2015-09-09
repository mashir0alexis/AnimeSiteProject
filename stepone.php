<?php
####  WARNING! THIS SCRIPT MUST BE PROTECTED FROM PUBLIC ACCESS ###########
## written by veedeoo or PoorBoy 2012
## feel free to use at your application.
## filename : stepone.php
## first we define our file extension allowed. 
$ext = array('.php','.html','.js','.css','.tpl');
## we define our current working directory where the dumper should be looking for files.
$work_directory = getcwd();
## we create a file dumper function
function dump($dir,$ext) {
$d = dir($dir);
while (false!== ($file = $d->read()))
{
$extension = substr($file, strrpos($file, '.'));
## we search the extesion match, otherwise we don't do anything 
if ((array_search($extension, $ext) !== FALSE)){
$d_files[$file] = $file;
}
}
$d->close();
asort($d_files);
return $d_files;
}
?>
<form method = "post" action ="writter.php">
<p>
<label>Select Action</label>
<select name ="action">
<option selected="selected"></option>
<option value = "1">Create New file</option>
<option value ="2">Edit File</option>
</select>
</p>
<!-- we will add existing file edit capabilities here later -->
<!-- we call our file dumper function -->
<!-- sometimes I do a reverse array just like below, pleas look at my function dump above. Pretty cool huh? -->
<?php $array = dump($work_directory,$ext);?>
<p>
<label>Select file to Edit </label>
<select name="editFile">
<?php foreach ($array as $key => $file) {
 $td_item= $file;
 ?>
<option >
<?php echo $td_item;?>
</option>
<?php
}
?>
</select>
</p>
<p>
If new file Selected above, Type file name ONLY!
<br/>
<label>File Name   </label>  <input type = "text" name = "fname"/>
</p>
<p>
Select file extension for the above filename.
<br/>
<label>Select File Type</label>
<select name = "ftype" >
<option>php</option>
<option>html</option>
<option>js</option>
<option>css</option>
<option>tpl</option>
</select>
<br/>
</p>
<p>
<input type="submit" name="process" value="submit">
</p>
</form>