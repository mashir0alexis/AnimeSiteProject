<?php
####  WARNING! THIS SCRIPT MUST BE PROTECTED FROM PUBLIC ACCESS ###########
## written by veedeoo or PoorBoy 2012
## feel free to use at your application.
## filename: writter.php
## You can Change the work directory if you want.. otherwise files will be created in the same directory as writter.php
$work_directory = getcwd();
echo $work_directory."<br/>";
if(isset($_POST['process'])&& (!empty($_POST['action']))){
    //if(!empty($_POST['action'])){
        $action = $_POST['action'];
    //}
    if($action == 1){
        ## we need to create a new file
        $newFileName = $_POST['fname'];
        $newFileType = $_POST['ftype'];
        $thisNewFile = $work_directory."/".$newFileName.".".$newFileType;
        ## first we need to check if file don't exist
        if (!file_exists($thisNewFile)) {
           ## stop the undefined index error
           $filler = "";
          switch ($newFileType){
            case "php":
            ## must use single quotes when it is necessary
            $filler .='<?php ';
            $filler .="\n\n";
            $filler .='##fileName: '.$newFileName.'.'.$newFileType.'##';
            $filler .="\n\n";
            $filler .='echo "hello World";';
            $filler .="\n\n";
            $filler .='?>';
            break;
            ## our html file
            case "html":
            $filler .='<html>';
            $filler .="\n\n";
            $filler .='<!-- '.$newFileName.'.'.$newFileType.'-->';
            $filler .="\n\n";
            $filler .='<head>';
            $filler .="\n\n";
            $filler .='</head>';
            $filler .="\n\n";
            $filler .='<body>';
            $filler .="\n\n";
            $filler .='<!-- Type your html tags below -->';
            $filler .="\n\n";
            $filler .='</body>';
            $filler .="\n\n";
            $filler .='</html>';
            break;
            default:
            $filler .= "## type your codes here";
            break;
        }
         $writeThisFile = fopen($thisNewFile,"w");
         fwrite($writeThisFile,$filler);
         fclose($writeThisFile); 
      } 
      ## file already exist we don't do anything
      $fileToRead = $newFileName.".".$newFileType;
      $fileLink = $newFileName.".".$newFileType;
    }
    ## If we want to edit existing file
    ## make existing file be the $thisNewFile
    elseif($action == 2){
        $thisNewFile = $work_directory."/".$_POST['editFile'];
        $fileLink = $_POST['editFile'];
        $fileToRead = $fileLink;
    }
 ## even though it is redundant, we need to double check file exist once again before loading it to he editor
if (file_exists($thisNewFile)) {
//$thisFile = $thisNewFile; 
$readThisFile = $fileToRead;
$thisNewFileLink = $fileLink;
}
}
//$loadcontent = $readThisFile; 
    if(isset($_POST['submit'])) {
     $readThisFile = $_POST['nFile'];
     $thisNewFileLink = $_POST['nFile'];
     $codesUpdate = $_POST['string'];
         $codesUpdate = stripslashes($codesUpdate);
        $fp = @fopen($readThisFile, "w");
        if ($fp) {
            fwrite($fp, $codesUpdate);
            fclose($fp);
                               }
                }
    $fp = @fopen($readThisFile, "r");
        $readThisFile = fread($fp, filesize($readThisFile));
        $readThisFile = htmlspecialchars($readThisFile);
        fclose($fp);
?>
<!-- html section .. this can be in separate file -->
<html>
<head>
<style>
textarea{
    width: 700px;
    color: #ffffff;
    border: 3px solid grey;
    padding: 5px;
    font-family: Tahoma, sans-serif;
    background: #000000;
}
</style>
</head>
<body>
<div>
<a href="<?php echo $thisNewFileLink;?>" target="_Blank">Preview</a>
<br/>
<form method=post action="<?php echo $_SERVER['PHP_SELF']?>">
<input type="hidden" name="nFile" value="<?php echo $thisNewFileLink;?>">
<input type="hidden" name="thisFile" value="<?php echo $readThisFile?>">
<pre class="brush: php; highlight: [5, 15]; html-script: true">
<textarea name="string" cols="70" rows="25"><?php echo $readThisFile?></textarea>
</pre>
<br>
<input type="submit" name="submit" value="Save Changes">  
</form>
</div>
</body>
</help>