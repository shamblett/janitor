<?php
	/*
	Copyright (C) 2002-2004 Edwin van Wijk, www.phpwebftp.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

	New in Version 3.3b
	- zip support for zipping and downloading an entire directory
	- moved all ftp functions into a ftp class
	- repaired ascii/binary mode button
	- set default mode to binary
	*/

  /* MODx security check hook */
require_once  dirname(dirname(__FILE__)) . "/common/modx.php";

	include('config.inc.php'); //load configuration
	$currentVersion = "3.3b";

	// Report simple running errors
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	error_reporting(E_ERROR | E_PARSE);

	//Procedure for emptying the tmp directory
	if($clearTemp==true)
	{
		if ($handle = opendir($downloadDir)) {
			while (false !== ($delFile = readdir($handle))) {
				if($delFile!="." and $delFile!="..") {
					unlink($downloadDir . $delFile);
				}
			}
			closedir($handle);
		}
	}


	include("include/functions.inc.php");
	include("include/ftp.class.php");
	
	// Get the POST, GET and SESSION variables (if register_globals=off (PHP4.2.1+))
	// It's a bit of a dirty hack but variables are sometimes GET and sometimes POST variables
	$goPassive=(isset($_POST['goPassive']))?$_POST['goPassive']:$_GET['goPassive'];
	$mode=(isset($_POST['mode']))?$_POST['mode']:$_GET['mode'];
	$actionType=(isset($_POST['actionType']))?$_POST['actionType']:$_GET['actionType'];
	$currentDir=stripSlashes((isset($_POST['currentDir']))?$_POST['currentDir']:$_GET['currentDir']);
	$file=(isset($_POST['file']))?$_POST['file']:$_GET['file'];
	$file2=(isset($_POST['file2']))?$_POST['file2']:$_GET['file2'];
	$permissions=(isset($_POST['permissions']))?$_POST['permissions']:$_GET['permissions'];
	$directory=(isset($_POST['directory']))?$_POST['directory']:$_GET['directory'];
	$fileContent=(isset($_POST['fileContent']))?$_POST['fileContent']:$_GET['fileContent'];

	$file=StripSlashes($file);
	$file2=StripSlashes($file2);

	$mode=(isset($mode))?$mode:1;

	if(isset($_POST['user'])) {
		// we dont care if we are already logged or not in case user provides
		// login information. That allows relogging in without explicitly
		// loging out, eg with the "back" button.
		if ($editDefaultServer)
			$_SESSION['server']=$_POST['server'];
		else
			$_SESSION['server']=$defaultServer;

		$_SESSION['user']=$_POST['user'];
		$_SESSION['password']=$_POST['password'];
		$_SESSION['language']=$_POST['language'];
		$_SESSION['port']=$_POST['port'];
		$_SESSION['passive']=$_POST['passive'];
	}


	if ($actionType=="logoff")
	{
		unset($_SESSION['server']);
		unset($_SESSION['user']);
		unset($_SESSION['password']);
		unset($_SESSION['port']);
		unset($_SESSION['passive']);
	}

	$server=$_SESSION['server'];
	$user=$_SESSION['user'];
	$password=$_SESSION['password'];
	$language=$_SESSION['language'];
	$port=$_SESSION['port'];
	$passive=$_SESSION['passive'];


	// If language is not yet set, check the default language or try to get the language from your browser.
	if($language==""){
		if ($defaultLanguage !="") {
			$language = $defaultLanguage ;
		} else {
			$browser_lang = getenv("http_accept_language");
			$tmplang = $languages[$browser_lang];
			if(file_exists("include/language/" . $tmplang . ".lang.php")) {
				$language = $tmplang;
			} else {
				$language = "english";
			}
		}
	}

	//Include Language file
	include("include/language/" . $language . ".lang.php");   // Selected language

	if ($server!="")
	{
		$ftp = new ftp($server, $port, $user, $password, $passive);
		$ftp->setMode($mode);
		$ftp->setCurrentDir($currentDir);

		// set some default values as defined in config.inc.php
		$ftp->setResumeDownload($resumeDownload);
		$ftp->setDownloadDir($downloadDir);

		if ($ftp->loggedOn)
		{
			$msg = $ftp->getCurrentDirectoryShort();
			// what to do now ???
			if(isset($actionType)) {
				switch ($actionType) {
					case "chmod":	// Change permissions
						if($ftp->chmod($permissions, $file)){
							print $lblFilePermissionChanged;
						} else {
							print $lblCouldNotChangePermissions;
						}
						break;
					case "cd":			// Change directory
						$ftp->cd($file);
						$msg = $lblndexOf . $ftp->getCurrentDirectoryShort();
						break;
					case "get":			// Download file
						$ftp->download($file) or DIE($lblErrorDownloadingFile);
						break;
					case "put":			// Upload file
						$fileObject = $_FILES['file'];
						if($fileObject['size'] > $maxFileSize) {
							$msg = "<B>" . $lblFileSizeTooBig . "</B> (max. " . $maxFileSize . " bytes)<P>";
						} elseif(!$ftp->upload($fileObject)) {
							$msg = $lblFileCouldNotBeUploaded;
						}
						break;
					case "deldir";		// Delete directory
						$ftp->deleteRecursive($file);
						break;
					case "delfile";		// Delete file
						$ftp->deleteFile($file);
						break;
					case "rename";		// Rename file
						if($ftp->rename($file, $file2))	{
							$msg = $file . " " . $lblRenamedTo . " " . $file2;
						} else {
							$msg = $lblCouldNotRename . " " . $file . " " . $lblTo . " " . $file2;
						}
						break;
					case "createdir":  // Create a new directory
						if($ftp->makeDir($file)) {
							$msg = $file . " " . $lblCreated;
						} else {
							$msg = $lblCouldNotCreate . " " . $file;
						}
						break;
					case "edit":
						//First download the file to the server
						$ftp->get($file);

						//Now open the content of the file in an edit window
					?>
						<html>
						<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
							<TITLE>phpWebFTP <?php echo $currentVersion;?> By Edwin van Wijk</TITLE>
							<LINK REL=StyleSheet HREF="style/cm.css" TITLE=Contemporary TYPE="text/css">
							<SCRIPT LANGUAGE="JavaScript" SRC="include/script.js"></SCRIPT>
						</HEAD>
						<body>
						<h2>Edit <?php echo $file;?></h2>
						<FORM METHOD=POST NAME='editFileForm' ACTION="<?php echo $php_self;?>">
							<INPUT TYPE='hidden' NAME='actionType' VALUE='saveFile'>
							<INPUT TYPE='hidden' NAME='currentDir' VALUE='<?php echo $ftp->currentDir;?>'>
							<INPUT TYPE='hidden' NAME='file' VALUE='<?php echo $file;?>'>
							<INPUT TYPE='hidden' NAME='mode' VALUE='<?php echo $ftp->mode;?>'>
							<TEXTAREA NAME="fileContent" ROWS='30' COLS='80'><?php $data = stripslashes(readfile($ftp->downloadDir . $file));?></TEXTAREA>
							<br>
							<INPUT TYPE="submit" value="save"><INPUT TYPE=button OnClick='cancelEditFile();' VALUE="cancel" >
						</FORM>
						</body>
						</html>
					<?php
						unlink($ftp->downloadDir . $file);
						exit;
						break;
					case "saveFile":
						//Write content of fileContent to tempFile
						$tempFile = "tmpFile.txt";
						$fp = fopen($ftp->downloadDir . $tempFile, "w+t");
						if ($bytes=!fwrite($fp, stripslashes($fileContent))) {
						   $msg = $lblFileCouldNotBeUploaded;
						}
						fclose($fp);

						//Upload the file to the server
						if(!$ftp->put($ftp->currentDir . "/" . filePart(StripSlashes($file)),$ftp->downloadDir . $tempFile)) $msg = $lblFileCouldNotBeUploaded;

						//Delete temporary file
						unlink($ftp->downloadDir . $tempFile);
						break;

					case "getzip":
						set_time_limit(3000); //for big archives
						$zipfile = $file . ".zip";
						$dir = $ftp->downloadDir.$ftp->user . "/";   // a directory for every user, just in case...

						header("Content-disposition: attachment; filename=\"$zipfile\"");
						header("Content-type: application/octetstream");
						header("Pragma: ");
						header("Cache-Control: cache");
						header("Expires: 0");

						$zipfile = $ftp->downloadDir . $zipfile;

						//Create temporary diretory 
						mkdir($dir);

						//Get entire directory and store to temporary directory
						$ftp->getRecursive($ftp->currentDir, $file);

						//zip the directory
						$zip = new ss_zip('',6); 
						$zip->zipDirTree($dir, $dir);
						$zip->save($zipfile);

						//send zipfile to the browser
						$filearray = explode("/",$zipfile);
						$file = $filearray[sizeof($filearray)-1];

						$data = readfile($zipfile);
						$i=0;
						while ($data[$i] != "")
						{
							echo $data[$i];
							$i++;
						}

						//Delete zip file
						unlink($zipfile);

						//Delete downloaded files from user specific directory
						deleteRecursive($dir);
						exit;
						break;
				}
			}
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<TITLE>phpWebFTP <?php echo $currentVersion;?> By Edwin van Wijk</TITLE>
	<LINK REL=StyleSheet HREF="style/cm.css" TITLE=Contemporary TYPE="text/css">
	<SCRIPT LANGUAGE="JavaScript" SRC="include/script.js"></SCRIPT>
</HEAD>
<BODY>
<TABLE CELLPADDING=0 CELLSPACING=0 HEIGHT="600">
<TR><TD>
	<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH='100%'>
		<TR>
			<TD CLASS=titlebar COLSPAN=3>
				<B>phpWebFTP <?php echo $lblVersion;?> <?php echo $currentVersion;?></B>
			</TD>
		</TR>
		<TR>
			<TD CLASS=menu>
			<?php
			$newMode=($ftp->mode==1)?0:1;
			?>
				<?php if($ftp->loggedOn) { ?>
				<TABLE CELLPADDING=0 CELLSPACING=0><TR>

				<TD VALIGN=CENTER>&nbsp;<A HREF='javascript:submitForm("cd","..")'><IMG SRC="img/parent.gif" HEIGHT=24 WIDTH=24 ALIGN=TOP BORDER=0></A></TD>
				<TD VALIGN=CENTER><nobr><A HREF='javascript:submitForm("cd","..")'>&nbsp;<?php echo $lblUp;?></A> </nobr></TD>

				<TD VALIGN=CENTER>&nbsp;<A CLASS=menu HREF="javascript:changeMode('<?php echo $newMode;?>')"><IMG SRC="img/mode.gif" HEIGHT=24 BORDER=0 ALIGN=CENTER></A></TD>
				<TD VALIGN=CENTER><nobr><A CLASS=menu HREF="javascript:changeMode('<?php echo $newMode;?>')">&nbsp;<?php echo $lblChangeMode;?></A> </nobr></TD>

				<TD VALIGN=CENTER>&nbsp;<A CLASS=menu HREF="javascript:logOff()"><IMG SRC="img/logoff.gif" HEIGHT=24 BORDER=0 ALIGN=CENTER></A></TD>
				<TD VALIGN=CENTER><nobr><A CLASS=menu HREF="javascript:logOff()">&nbsp;<?php echo $lblLogOff;?></A> </nobr></TD>

				<TD COLSPAN=6 VALIGN=CENTER class=statusbar width="100%" VALIGN=CENTER ALIGN=RIGHT>
					&nbsp;&nbsp;<?php echo directoryPath($ftp->currentDir, $server);?>
				</TD>
				</TR>
</TABLE>
				<?php } else { ?>
				<TABLE CELLPADDING=0 CELLSPACING=0><TR>
				<TD VALIGN=CENTER>&nbsp;<A CLASS=menu HREF="javascript:logOff()"><IMG SRC="img/logoff.gif" HEIGHT=24 BORDER=0 ALIGN=CENTER></A> </TD>
				<TD VALIGN=CENTER>&nbsp;<A CLASS=menu HREF="javascript:logOff()"><?php echo $lblRetry;?></A> </TD>
				</TR></TABLE>

				<?php } ?>
			</TD>
			</FORM>
		</TR>
	</TABLE>
</TD></TR>
<TR><TD HEIGHT="100%">
	<FORM NAME="actionform" METHOD=POST ACTION='<?php echo $PHP_SELF;?>'>
		<INPUT TYPE='hidden' NAME='actionType' VALUE=''>
		<INPUT TYPE='hidden' NAME='delaction' VALUE=''>
		<INPUT TYPE='hidden' NAME='currentDir' VALUE='<?php echo $ftp->currentDir;?>'>
		<INPUT TYPE='hidden' NAME='file' VALUE=''>
		<INPUT TYPE='hidden' NAME='file2' VALUE=''>
		<INPUT TYPE='hidden' NAME='extension' VALUE=''>
		<INPUT TYPE='hidden' NAME='permissions' VALUE=''>
		<INPUT TYPE='hidden' NAME='mode' VALUE='<?php echo $ftp->mode;?>' STYLE='border: none; background-color: #EFEFEF;'>
	</FORM>
	<HR>

	<TABLE HEIGHT="100%">
		<TR>
		<TD class=leftmenu VALIGN=TOP width=210>
			<DIV ALIGN=CENTER>
				<BR>
				<!-- File and folder -->
				<TABLE CELLPADDING=0 CELLSPACING=0 class=item>
					<TR>
						<TD VALIGN=TOP class=itemhead>
							<B><?php echo $lblFileTasks;?></B>
						</TD>
						</FORM>
					</TR>
					<TR>
						<TD VALIGN=TOP class=leftmenuitem>

							<DIV id="fileactions" style='display:none;'>
							<TABLE>
								<!-- Delete File -->
								<TR>
									<TD VALIGN=CENTER><IMG SRC="img/menu_delete.gif"></TD>
									<TD VALIGN=CENTER>
										<A HREF='javascript:deleteFile()' class=leftmenulink><?php echo $lblDeleteFile;?></A>
									</TD>
								</TR>

								<TR>
									<TD VALIGN=CENTER><IMG SRC="img/zip.gif"></TD>
									<TD VALIGN=CENTER>
										<A HREF='javascript:zipFile()' class=leftmenulink><?php echo "Zip & download";?></A>
									</TD>
								</TR>

								<TR>
									<TD VALIGN=CENTER><IMG SRC="img/menu_edit.gif"></TD>
									<TD VALIGN=CENTER>
										<A HREF='javascript:editFile()' class=leftmenulink><?php echo $lblEditFile;?></A>
									</TD>
								</TR>

								<TR>
									<TD VALIGN=top><IMG SRC="img/menu_rename.gif"></TD>
									<TD VALIGN=top>
										<A HREF='javascript:setNewFileName("<?php echo $myDir["name"];?>")' class=leftmenulink><?php echo $lblRename;?></A>
										<!-- Rename file -->
										<DIV ID='renameFileEntry' style='display:none;'>
											<FORM NAME=renameFile>
											<TABLE CELLSPACING=0 class=lined align=center>
												<TR>
													<TD class=tinyblue>
													<B><?php echo $lblNewName;?></B><BR>
													<INPUT TYPE="text" NAME="newName" value=""></TD>
												</TR>
												</TABLE>
											<BR>
											<DIV ALIGN=CENTER><INPUT TYPE=button OnClick='renameItem();' VALUE='<?php echo $lblRename;?>'></DIV>
											</FORM>
											<BR>
										</DIV>
									</TD>
								</TR>

								<TR>
									<TD VALIGN=top><IMG SRC="img/menu_settings.gif"></TD>
									<TD VALIGN=top>
										<A HREF='javascript:;' OnClick='setPermissions()' class=leftmenulink><?php echo $lblSetPermissions;?></A>
										<!-- Change permissions -->
										<DIV ID='setPermissions' style='display:none;'>
											<FORM NAME=permissions>
											<TABLE CELLSPACING=0 class=lined align=center>
											<TR>
												<TD class=tinyblue ALIGN=CENTER><B><?php echo $lblOwner;?></B></TD>
												<TD class=tiny ALIGN=CENTER><B><?php echo $lblGroup;?></B></TD>
												<TD class=tinywhite ALIGN=CENTER><B><?php echo $lblPublic;?></B></TD>
											</TR>
											<TR>
												<TD class=tinyblue><INPUT TYPE="checkbox" NAME="iOr"> <?php echo $lblRead;?></TD>
												<TD class=tiny><INPUT TYPE="checkbox" NAME="iGr"> <?php echo $lblRead;?></TD>
												<TD class=tinywhite><INPUT TYPE="checkbox" NAME="iPr"> <?php echo $lblRead;?></TD>
											</TR>
											<TR>
												<TD class=tinyblue><INPUT TYPE="checkbox" NAME="iOw"> <?php echo $lblWrite;?></TD>
												<TD class=tiny><INPUT TYPE="checkbox" NAME="iGw"> <?php echo $lblWrite;?></TD>
												<TD class=tinywhite><INPUT TYPE="checkbox" NAME="iPw"> <?php echo $lblWrite;?></TD>
											</TR>
											<TR>
												<TD class=tinyblue><INPUT TYPE="checkbox" NAME="iOx"> <?php echo $lblExecute;?></TD>
												<TD class=tiny><INPUT TYPE="checkbox" NAME="iGx"> <?php echo $lblExecute;?></TD>
												<TD class=tinywhite><INPUT TYPE="checkbox" NAME="iPx"> <?php echo $lblExecute;?></TD>
											</TR>

											</TABLE>
											<BR>
											<DIV ALIGN=CENTER><INPUT TYPE=button OnClick='changePermissions()' VALUE='<?php echo $lblSetPermissions;?>'></DIV>
											</FORM>
											<BR>
										</DIV>
									</TD>
								</TR>
							</TABLE>
							</DIV>


							<!-- Standaard actions -->
							<TABLE>
								<TR>
									<TD VALIGN=top><IMG SRC="img/upload.gif" BORDER="0" ALT=""></TD>
									<TD VALIGN=top>
										<A HREF="JavaScript:toggle('uploadform');" class=leftmenulink><?php echo $lblUploadFile;?></A>
											<FORM id="uploadform" style='display:none;' NAME='putForm' ENCTYPE="multipart/form-data" METHOD=POST ACTION="<?php echo $PHP_SELF;?>">
												<INPUT TYPE="hidden" NAME="actionType" VALUE="put">
												<INPUT TYPE='hidden' NAME='currentDir' VALUE='<?php echo $ftp->currentDir;?>'>
												<INPUT TYPE='hidden' NAME='mode' VALUE='<?php echo $ftp->mode;?>'>
												<INPUT TYPE="file" NAME="file" size=8 STYLE="width:10px; font-size:7pt;" onChange='document.uploadform.submit();'><BR>
												<INPUT TYPE="SUBMIT" VALUE="OK" STYLE='width=150px; font-size:7pt;'>
											</FORM>
									</TD>
								</TR>
								<TR>
									<TD VALIGN=top><IMG SRC="img/createdir.gif" BORDER="0" ALT=""></TD>
									<TD VALIGN=top>
										<A HREF="JavaScript:toggle('createform');" class=leftmenulink><?php echo $lblCreateDirectory;?></A>
										<FORM id="createform" style='display:none;' METHOD=POST NAME='dirinput' ACTION="<?php echo $PHP_SELF;?>">
											<INPUT TYPE="text" NAME="directory" VALUE="" STYLE="width:100px; font-size:7pt;">
											<INPUT TYPE="BUTTON" VALUE="OK" OnClick='javascript:createDirectory(dirinput.directory.value)' STYLE="width:40px; font-size:7pt;">
										</FORM>
									</TD>
								</TR>
								<TR>
									<TD VALIGN=top><IMG SRC="img/gotodir.gif" BORDER="0" ALT=""></TD>
									<TD VALIGN=top>
										<A HREF="JavaScript:toggle('gotoform');" class=leftmenulink><?php echo $lblGoToDirectory;?></A>
										<FORM id="gotoform" style='display:none;' NAME='cdDirect' METHOD=POST ACTION='<?php echo $PHP_SELF;?>'>
											<INPUT TYPE='hidden' NAME='actionType' VALUE='cd'>
											<INPUT TYPE='hidden' NAME='currentDir' VALUE='<?php echo $ftp->currentDir;?>'>
											<INPUT TYPE="text" NAME="file" VALUE="" STYLE="width:100px; font-size:7pt;">
											<INPUT TYPE="SUBMIT" VALUE="OK" STYLE="width:40px; font-size:7pt;">
										</FORM>
									</TD>
								</TR>
							</TABLE>
						</TD>
					</TR>
				</TABLE>
				<P>
				<!-- Details -->
				<TABLE CELLPADDING=0 CELLSPACING=0 class=item>
					<TR>
						<TD VALIGN=TOP class=itemhead>
							<B><?php echo $lblDetails;?></B>
						</TD>
						</FORM>
					</TR>
					<TR>
						<TD VALIGN=TOP class=leftmenuitem style='color:black' >
							<BR>
							<B><?php echo $msg;?></B>
							<P>
							<?php echo ($ftp->loggedOn)?"$lblConnectedTo  $server:$port ($ftp->systype)":$lblNotConnected;?>
							<P>
							<?php echo $lblTransferMode;?> :<?php echo $ftp->mode==1?$lblBinaryMode:$lblASCIIMode;?>
							<BR><BR>
						</TD>
					</TR>

				</TABLE>

			</DIV>
		</TD>
		<TD VALIGN=TOP>
			<P>
			<TABLE WIDTH="650" CELLSPACING=0 CELLPADDING=0 onClick='resetEntries()'>
				<TR>
					<TD COLSPAN=2 class=listhead><?php echo $lblName;?></TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead align=right><?php echo $lblSize;?>&nbsp;</TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead><?php echo $lblFileType;?>&nbsp;</TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead><?php echo $lblDate;?></TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead><?php echo $lblPermissions;?></TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead><?php echo $lblOwner;?></TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
					<TD class=listhead><?php echo $lblGroup;?></TD>
					<TD class=listhead><IMG SRC="img/listheaddiv.gif"></TD>
				</TR>
	 		<?php
				$list = $ftp->ftpRawList();

				if (is_array($list))
				{
					// Directories
					$counter=0;
					foreach($list as $myDir)
					{
						if ($myDir["is_dir"]==1)
						{
							$fileAction = "cd";
							$fileName = $myDir["name"];
							$fileSize="";
							$delAction = "deldir";
							$fileType['description'] = 'File Folder';
							$fileType['imgfilename'] = 'folder.gif';
						}

						if ($myDir["is_link"]==1)
						{
							$fileAction = "cd";
							$fileName = $myDir["target"];
							$fileSize="";
							$delAction = "delfile";
							$fileType['description'] = 'Symbolic Link';
							$fileType['imgfilename'] = 'link.gif';
						}

						if ($myDir["is_link"]!=1 && $myDir["is_dir"]!=1)
						{
						    $fileType = fileDescription($myDir["name"]);
							$fileAction = "get";
							$fileName = $myDir["name"];
							$image = "file.gif";
							if($myDir["size"]<1024) {
								$fileSize= $myDir["size"] . " bytes ";
									$fileSize=number_format($myDir["size"], 0, ',', '.') . " bytes";
							} else {
								if($myDir["size"]<1073741824) {
									$fileSize=number_format($myDir["size"]/1024, 0, ',', '.') . " KB";
								} else {
									$fileSize=number_format($myDir["size"]/1048576, 0, ',', '.') . " MB";
								}
							}

							
							$delAction = "delfile";
						}
				?>

							<TR>
							<TD class=filenamecol width=20><A HREF='javascript:selectEntry("<?php echo $fileAction;?>","<?php echo $fileName;?>","filename<?php echo $counter;?>","<?php echo $myDir["perms"];?>","<?php echo $delAction;?>")' ondblclick='submitForm("<?php echo $fileAction;?>","<?php echo $fileName;?>")'><IMG SRC="img/<?php echo $fileType['imgfilename'];?>" ALIGN=TOP BORDER=0></A></TD>
							<TD class=filenamecol><span id='filename<?php echo $counter;?>'><A HREF='javascript:selectEntry("<?php echo $fileAction;?>","<?php echo $fileName;?>","filename<?php echo $counter;?>","<?php echo $myDir["perms"];?>","<?php echo $delAction;?>")' ondblclick='submitForm("<?php echo $fileAction;?>","<?php echo $fileName;?>")'><?php echo $fileName;?></A></span></TD>
							<TD>&nbsp;</TD>
							<TD ALIGN=RIGHT><?php echo $fileSize;?></TD>
							<TD>&nbsp;</TD>
							<TD ALIGN=left><?php echo $fileType['description'];?></TD>
							<TD>&nbsp;</TD>
							<TD><?php echo $myDir["date"];?></TD>
							<TD>&nbsp;</TD>
							<TD><?php echo $myDir["perms"];?></TD>
							<TD>&nbsp;</TD>
							<TD><?php echo $myDir["user"];?></TD>
							<TD>&nbsp;</TD>
							<TD><?php echo $myDir["group"];?></TD>
							<TD>&nbsp;</TD>
							</TR>
				<?php
						$counter++;
					}
				} else {
				?>
							<TR>
							<TD colspan=14><BR><B><?php echo $lblDirectoryEmpty;?>...</B></TD>
							</TR>
				<?php
				}
				print "	</TABLE></TD></TR></TABLE>";
			}
			else
			{
				if(!isset($msg))
				{
					$msg = "$lblCouldNotConnectToServer  $server:$port $lblWithUser $user<P><A HREF='" . $_SERVER["PHP_SELF"] . "'>$lblTryAgain</A>";
					unset($_SESSION['server']);
					unset($_SESSION['user']);
					unset($_SESSION['password']);
					unset($_SESSION['port']);
					session_destroy();
				}
	?>
</TD></TR></TABLE>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<TITLE>phpWebFTP <?php echo $currentVersion;?> By Edwin van Wijk</TITLE>
	<LINK REL=StyleSheet HREF="style/cm.css" TITLE=Contemporary TYPE="text/css">
	<SCRIPT LANGUAGE="JavaScript" SRC="include/script.js"></SCRIPT>
</HEAD>
<BODY>
<?php
			print $msg;
		}
	}
	else // Still need to logon...
	{
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<TITLE>phpWebFTP <?php echo $currentVersion;?> By Edwin van Wijk</TITLE>
	<LINK REL=StyleSheet HREF="style/cm.css" TITLE=Contemporary TYPE="text/css">
	<SCRIPT LANGUAGE="JavaScript" SRC="include/script.js"></SCRIPT>
</HEAD>
<BODY>
		<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH='100%'>
			<TR>
				<TD CLASS=titlebar>
					<B>phpWebFTP <?php echo $lblVersion;?> <?php echo $currentVersion;?></B>
				</TD>
			</TR>
			<TR>
				<TD CLASS=menu>
					<TABLE CELLPADDING=0 CELLSPACING=0><TR>
					<TD VALIGN=CENTER><IMG SRC="img/1px.gif" HEIGHT=24 BORDER=0 ALIGN=CENTER></TD>
					<TD VALIGN=CENTER>&nbsp;</TD>
					</TR></TABLE>
				</TD>
			</TR>
		</TABLE>

		<FORM NAME=login action='<?php echo $_SERVER['PHP_SELF'];?>' METHOD=POST>
		<TABLE class=login cellpadding=3>
			<TR>
				<TD COLSPAN=3><B>&nbsp;<?php echo $lblLogIn;?></B></TD>
			</TR>
			<TR>
				<TD COLSPAN=3><IMG SRC="img/1px.gif" HEIGHT=60></TD>
			</TR>
			<TR>
				<TD COLSPAN=3>&nbsp;<?php echo $lblConnectToFTPServer;?></TD>
			</TR>
			<TR>
				<TD VALIGN=TOP>&nbsp;<?php echo $lblServer;?></TD>
				<TD VALIGN=TOP>
					<?php
						if($defaultServer == "") {
							print "<INPUT TYPE=TEXT NAME=server SIZE=15>&nbsp;";
						} else {
							$inputType=($editDefaultServer==true)?"TEXT":"HIDDEN";
							print "<INPUT TYPE=" . $inputType . " NAME=server VALUE=" . $defaultServer . ">";
							if($editDefaultServer==false) {
								print "<B>" . $defaultServer . "</B>&nbsp;";
							}
						}
					?>
				</TD>
				<TD VALIGN=TOP>
					<TABLE CELLSPACING=0>
						<TR>
							<TD><?php echo $lblPort;?></TD>
							<TD><INPUT TYPE=TEXT NAME=port SIZE=2 VALUE=21></TD>
						</TR>
						<TR>
							<TD><?php echo $lblPasive;?></TD>
							<TD><INPUT TYPE="checkbox" NAME="goPassive"></TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD>&nbsp;<?php echo $lblUser;?></TD>
				<TD>
					<INPUT TYPE=TEXT NAME=user SIZE=18>
				</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD>&nbsp;<?php echo $lblPassword;?></TD>
				<TD><INPUT TYPE=PASSWORD NAME=password SIZE=18></TD>
				<TD><INPUT TYPE=SUBMIT VALUE="Log on"></TD>
			</TR>

			<?php
				if($defaultLanguage == "") {
			?>
			<TR>
				<TD>&nbsp;<?php echo $lblLanguage;?></TD>
				<TD colspan=2>
					<?php

					?>
					<SELECT NAME="language">
					<?php
						if ($handle = opendir('include/language/')) {
							//Read file in directory and store them in an Array
							while (false !== ($file = readdir($handle))) {
								$fileArray[$file] = $file;
							}
							//Sort the array
							ksort($fileArray);

							foreach($fileArray as $file) {
								if ($file != "." && $file != ".." ) {
								    $file=str_replace(".lang.php","",$file);
								    $counter=0;
								    foreach($languages as $thislang)
								    {
								        if($thislang==$file)
								        {
								            $counter++;
								        }
								    }
								    if($counter>0) {
										$langName=strtoupper(substr($file,0,1)) . substr($file,1);
					?>
										<OPTION VALUE="<?php echo $file;?>" <?php echo ($language==$file)?"selected":"";?>><?php echo $langName;?></OPTION>
					<?php
								    }

								}
							}
							closedir($handle);
						}
			 				?>
					</SELECT>
			</TR>
			<?php
				} // End default server
			?>
			<TR>
				<TD COLSPAN=2><IMG SRC="img/1px.gif" HEIGHT=5></TD>
			</TR>
		</TABLE>
		<TABLE WIDTH=328>
		<TR>
				<TD COLSPAN=2 VALIGN=TOP class=leftmenuitem>
					<DIV style='font-size:7pt;'>
					<?php echo $lblDisclaimer;?>
					<BR><BR>
					phpWebFTP <?php echo $lblVersion;?> <?php echo $currentVersion;?><BR>
					&copy; 2002-2006, Edwin van Wijk,<BR>
					Tailored for MODx Revolution by S. Hamblett 2010
					<A HREF="http://www.phpwebftp.com" style='font-size:7pt;'>www.phpwebftp.com</A>
					</div>
					<P>
				</TD>
			</TR>
			<TR>
			<TD ALIGN=LEFT>&nbsp;</TD>
			<TD ALIGN=RIGHT>
				&nbsp;
			</TD>
			</TR>
		</TABLE>
		</FORM>
<?php
	}
?>
<P>
</BODY>
</HTML>
