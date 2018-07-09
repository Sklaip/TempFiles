<?
$config =[
 	'directory_folder_temp' => ''//The path from the site root to the temp folder where all temporary files will be stored
 ];


$directory = $_SERVER['DOCUMENT_ROOT'].$config['directory_folder_temp'].'/temp';//all temporary files are stored in the temp folder

 if(!is_dir($directory)){
    mkdir($directory);
 }

 function object_to_array($data){
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

 class Temp{

 	function saveTempFile($file, $content = null, $number = null){
 		global $directory;
 		$opa = $directory.'/'.$file.'.json';

 		if($number != null){
 			$opa = $directory.'/'.$number.'/'.$file.'.json';
 			if(!is_dir($directory.'/'.$number)){
 				mkdir($directory.'/'.$number);
 			}
 		}
 		
        $fp = fopen($opa, "w");
        fwrite($fp, json_encode($content));
        fclose($fp);
 	}

 	function delTempFile($file, $number = null){
 		global $directory;

 		if($number == null){
          unlink($directory.'/'.$file.'.json');
 		}else{
          unlink($directory.'/'.$number.'/'.$file.'.json');
 		}
 	}

 	function delTempGroup($group){
     global $directory;		
     $dir = $directory.'/'.$group;		
     if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
     }
     rmdir($dir); 		
 	}

 	function getTempFile($file, $group = null){
 	   global $directory;
 	   if($group == null){
         return object_to_array(json_decode(file_get_contents($directory.'/'.$file.'.json')));
 	   }else{
 	   	 return object_to_array(json_decode(file_get_contents($directory.'/'.$group.'/'.$file.'.json')));
 	   }		
 	}

 	function getTempGroup($group){
 		global $directory;
 		$dir = $directory.'/'.$group;
        $files1 = scandir($dir);
        $schet = 0;
        $schrt2 = 0;

        foreach ($files1 as $key => $value) {
        	$schet2++;
        	if($schet2 > 2){
        		$schet++;
                $ret[$schet] = object_to_array(json_decode(file_get_contents($directory.'/'.$group.'/'.$files1[$key]))); 
        	}
        }
        return $ret;
 	}

    function delAll($mode = null){
      global $directory;
       if($mode == "groups"){
        $filelist = glob($directory."/**", GLOB_ONLYDIR);
        foreach ($filelist as $key => $value) {
           $filelist[$key] = explode('/', $filelist[$key]); 
           $filelist[$key] = end($filelist[$key]);
           Temp::delTempGroup($filelist[$key]);
        }
       }else if($mode == "files"){
         $filelist = glob($directory."/**");
         foreach ($filelist as $key => $value) {
           $filelist[$key] = explode('/', $filelist[$key]); 
           $filelist[$key] = end($filelist[$key]);
           $filelist[$key] = explode('.', $filelist[$key]);
           $filelist[$key] = $filelist[$key][0];
           Temp::delTempFile($filelist[$key]);
         }
        }else if($mode == "all"){
            Temp::delAll("groups");
            Temp::delAll("files");
         }
   }  
 }
