<?php
/** FTP class is designed to work with FTP Connections
@author Edwin van Wijk, www.v-wijk.net
@email info@vwijk.net
*/

class ftp {
	/** FTP server */
	var $server="";
	/** FTP server port */
	var $port=21;
	/** FTP user */
	var $user="";
	/** User specific directory (for zip and download) */
	var $userDir="";
	/** password */
	var $password = "";
	/** FTP connection */
	var $connection = "";
	/** Passive FTP connection */
	var $passive = false;
	/** Type of FTP server (UNIX, Windows, ...) */
	var $systype = "";
	/** Binary (1) or ASCII (0) mode */
	var $mode = 0;
	/** Logon indicator */
	var $loggedOn = false;
	/** resume broken downloads */
	var $resumeDownload = false;
	/** temporary download directory on local server */
	var $downloadDir = "";

	/**	constructor
	@param none
	Set FTP settings and logon to the server
	*/
	function ftp($server, $port, $user, $password, $passive=false){
		$this->server = $server;
		$this->port = $port;
		$this->user = $user;
		$this->userDir = $user . "_tmp";
		$this->password = $password;

		// connect to server
		$this->connect();

		// switch to passivemode(?)
		$this->setPassive($passive);
	}

	/** connect to a ftp server */
	function connect() {
		$this->connection = @ftp_connect($this->server, $this->port);
		$this->loggedOn = @ftp_login($this->connection, $this->user, $this->password);
		$this->systype = @ftp_systype($this->connection);
		return;
	}

	/** set passive connection */
	function setPassive($passive) {
		$this->passive=$passive;
		@ftp_pasv($this->connection, $this->passive);
		return;
	}

	/** Set transfermode */
	function setMode($mode=1) {
		$this->mode = $mode;
		return;
	}

	/** set and goto current directory on ftp server */
	function setCurrentDir($dir=false) {
		if ($dir==true)
		{
			ftp_chdir($this->connection, $dir);
		}
		$this->currentDir = ftp_pwd($this->connection);
		return $this->currentDir;
	}

	function getCurrentDirectoryShort() {
		$string = $this->currentDir;
		$stringArray = split("/",$string);
		$level = count($stringArray);
		$returnString = $stringArray[$level-1];
		if(trim($returnString)=="") {
			$returnString = "/";
		}
		return $returnString;
	}

	function setDownloadDir($dir) {
		$this->downloadDir = $dir;
		return;
	}

	function setResumeDownload($resume) {
		$this->resumeDownload = $resume;
		return;
	}

	function chmod($permissions, $file) {
		return @ftp_site($this->connection, "chmod $permissions $file");
	}

	function cd($directory) {
		if ($directory=="..") {
			@ftp_cdup($this->connection);
		} else {
			if(!@ftp_chdir($this->connection, $this->currentDir . $directory)) {
				@ftp_chdir($this->connection, $directory); // Symbolic link directory 
			}
		}
		$this->currentDir=ftp_pwd($this->connection);;
		return;
	}

	/* get file from ftp server */
	function get($file,$destination) {
		if($destination == ""){
			$destination = $this->downloadDir;
		}
		$ok=true;
		if($this->resumeDownload) {
			$fp = fopen($destination . $file, "a+");
			$ok = ftp_fget($this->connection,$fp,"$file",$this->mode, filesize($destination . $file));
		} else {
			$fp = fopen($destination . $file, "w");
			$ok = ftp_fget($this->connection,$fp,"$file",$this->mode);
		}
		fclose($fp);
		return $ok;
	}

	/* put file to ftp server */
	function put($remoteFile,$localFile) {
		$ok=false;
		if(file_exists($localFile)) {
			ftp_put($this->connection, $remoteFile, $localFile, $this->mode);
			$ok=true;
		}
		return $ok;
	}

	/* Download file from server and send it to the browser */
	function download($file) {
		if($this->get($file)) {
			//Send header to browser to receive a file
			header("Content-disposition: attachment; filename=\"$file\"");
			header("Content-type: application/octetstream");
			header("Pragma: ");
			header("Cache-Control: cache");
			header("Expires: 0");
			$data = readfile($this->downloadDir . $file);
			$i=0;
			while ($data[$i] != "")
			{
				$fileStream .= $data[$i];
				$i++;
			}
			unlink($this->downloadDir . $file);
			echo $fileStream;
			exit;
		} else {
			return false;
		}
	}
	
	function upload($uploadFile) {
		$tempFileName = $uploadFile['tmp_name'];
		$fileName = $uploadFile['name'];
		return $this->put($this->currentDir . "/" . filePart(StripSlashes($fileName)), $tempFileName);
	}

	function deleteFile($file) {
		return @ftp_delete($this->connection, "$file");
	}


	function deleteRecursive($baseDirectory,$file){
		if ($fileList = @ftp_nlist($this->connection, "$baseDirectory/$file")){
			for ($x=0;$x<count($fileList);$x++){
				if ($fileList[$x] != '.' && $fileList[$x] != '..' && !@ftp_delete($this->connection, $fileList[$x]))
					deleteRecursive($baseDirectory."/$file",$fileList[$x]);
			}
			@ftp_rmdir($this->connection, "$baseDirectory/$file");
		 } else {
			@ftp_rmdir($this->connection, "$baseDirectory/$file");
		 }
	}

	function rename($old, $new) {
		return @ftp_rename($this->connection, "$old", "$new");
	}

	function makeDir($directory) {
		return @ftp_mkdir($this->connection, "$directory");
	}

	function getRecursive($baseDir,$file){
		$files = $this->ftpRawList($baseDir . "/$file");

		for ($x=0;$x<count($files);$x++){
			if ($files[$x]["name"] != '.' or $files[$x]["name"] != '..') {
				$downloadLocation = $this->downloadDir  . ereg_replace($this->currentDir."/",$this->userDir."/",$baseDir . "/$file/");
				$downloadLocation = ereg_replace("//","/",$downloadLocation);
				$ftpFileDir = ereg_replace($this->currentDir . "/","",$baseDir . "/$file/");
				//print $downloadLocation . "(" . $baseDir . "/$file/" . ")<br>";
				mkdir($downloadLocation);

				if ($files[$x]["is_dir"]==1)
				{
					$this->getRecursive($baseDir . "/$file/",$files[$x]["name"]);
				} else {
					$localFile = $this->downloadDir . $this->userDir . "/" . ereg_replace($this->currentDir . "/","",$baseDir . "/$file/") . $files[$x]["name"];;
					$remoteFile = $baseDir . "/" . $file . "/" . $files[$x]["name"];
					
					if($this->resumeDownload) {
						$fp = fopen($localFile, "a+");
						$ok = ftp_fget($this->connection,$fp,"$remoteFile",$this->mode, filesize($localFile));
					} else {
						$fp = fopen($localFile, "w");
						$ok = ftp_fget($this->connection,$fp,"$remoteFile",$this->mode);
					}
					fclose($fp);
				}
			}
		}
	}


	function ftpRawList($directory) {
		if($directory=="") {
			$directory = $this->currentDir;
		}
		$list=Array();
		$list = ftp_rawlist($this->connection, "-a " . $directory);
		if ($this->systype == "UNIX")
		{
			//$regexp = "([-ldrwxs]{10})[ ]+([0-9]+)[ ]+([A-Z|0-9|-]+)[ ]+([A-Z|0-9|-]+)[ ]+([0-9]+)[ ]+([A-Z]{3}[ ]+[0-9]{1,2}[ ]+[0-9|:]{4,5})[ ]+(.*)";
			//$regexp = "([-ldrwxs]{10})[ ]+([0-9]+)[ ]+([A-Z|0-9|-|_]+)[ ]+([A-Z|0-9|-|_]+)[ ]+([0-9]+)[ ]+([A-Z]{3}[ ]+[0-9]{1,2}[ ]+[0-9|:]{4,5})[ ]+(.*)";
			$regexp = "([-ltdrwxs]{10})[ ]+([0-9]+)[ ]+([A-Z|0-9|-|_]+)[ ]+([A-Z|0-9|-|_]+)[ ]+([0-9]+)[ ]+([A-Z]{3}[ ]+[0-9]{1,2}[ ]+[0-9|:]{4,5})[ ]+(.*)";
			$i=0;
			foreach ($list as $line) 
			{
				$is_dir = $is_link = FALSE;
				$target = "";

				if (eregi($regexp, $line, $regs))
				{
					if (!eregi("^[.]", $regs[7])) //hide hidden files
					if (!eregi("^[.]{2}", $regs[7])) // don't hide hidden files
					{
						$i++;
						if (eregi("^[d]", $regs[1]))
						{
							$is_dir = TRUE;
						}
						elseif (eregi("^[l]", $regs[1])) 
						{ 
							$is_link = TRUE;
							list($regs[7], $target) = split(" -> ", $regs[7]);
						}

						//Get extension from file name
						$regs_ex = explode(".",$regs[7]);
						if ((!$is_dir)&&(count($regs_ex) > 1))
						   $extension = $regs_ex[count($regs_ex)-1];
						else $extension = "";

						$files[$i] = array (
						"is_dir"	=> $is_dir,
						"extension"	=> $extension,
						"name"		=> $regs[7],
						"perms"		=> $regs[1],
						"num"		=> $regs[2],
						"user"		=> $regs[3],
						"group"		=> $regs[4],
						"size"		=> $regs[5],
						"date"		=> $regs[6],
						"is_link"	=> $is_link,
						"target"	=> $target );						
					}
				}
			}
		}
		else
		{
			$regexp = "([0-9\-]{8})[ ]+([0-9:]{5}[APM]{2})[ ]+([0-9|<DIR>]+)[ ]+(.*)";
			foreach ($list as $line) 
			{
				$is_dir = false;
				if (eregi($regexp, $line, $regs)) 
				{
					if (!eregi("^[.]", $regs[4]))
					{
						if($regs[3] == "<DIR>")
						{
							$is_dir = true;
							$regs[3] = '';
						}
						$i++;
	
						// Get extension from filename
						$regs_ex = explode(".",$regs[4]);
						if ((!$is_dir)&&(count($regs_ex) > 1))
						   $extension = $regs_ex[count($regs_ex)-1];
						else $extension = "";

						$files[$i] = array (
							"is_dir"	=> $is_dir,
							"extension"	=> $extension,
							"name"		=> $regs[4],
							"date"		=> $regs[1],
							"time"		=> $regs[2],
							"size"		=> $regs[3],
							"is_link"	=> 0,
							"target"	=> "",
							"num"		=> "" );
					}
				}
			}
		}
		if ( is_array($files)  AND count($files) > 0)
		{
			$files=array_sort_multi($files, 1, 3);
		}
		return $files;
	}

}
?>