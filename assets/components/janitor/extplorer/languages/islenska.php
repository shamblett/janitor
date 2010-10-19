<?php

// �slenska fyrir joomlaXplorer ver 1.2.1 (translated by gudjon@247.is)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y/m/d H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "Villa(ur)",
	"back"			=> "Bakka",

	// root
	"home"			=> "Mappa heimasv��isins er ekki til, vinsamlegast kanna�u stillingarnar.",
	"abovehome"		=> "�essi mappa getur ekki veri� sta�sett fyrir ofan heimasv��i� �itt.",
	"targetabovehome"	=> "Mappan getur ekki veri� sta�sett fyrir ofan heimasv��i� �itt.",

	// exist
	"direxist"		=> "�essi mappa er ekki til.",
	//"filedoesexist"	=> "�etta skjal er �egar til.",
	"fileexist"		=> "�essi skr� er ekki til.",
	"itemdoesexist"		=> "�essi hlutur er �egar til.",
	"itemexist"		=> "�essi hlutur er ekki til.",
	"targetexist"		=> "�essi mappa er ekki til.",
	"targetdoesexist"	=> "�essi hlutur er �egar til.",

	// open
	"opendir"		=> "Gat ekki opna� m�ppuna.",
	"readdir"		=> "Gat ekki lesi� m�ppuna.",

	// access
	"accessdir"		=> "�� hefur ekki a�gang a� �essari m�ppu.",
	"accessfile"		=> "�� hefur ekki a�gang a� �essari skr�.",
	"accessitem"		=> "�� hefur ekki a�gang a� �essum hlut.",
	"accessfunc"		=> "�� hefur ekki a�gang a� �essari skipun.",
	"accesstarget"		=> "�� hefur ekki a�gang a� �essari m�ppu.",

	// actions
	"permread"		=> "Gat ekki s�tt a�gangsst�ringar.",
	"permchange"		=> "Gat ekki breytt a�gangsst�ringum.",
	"openfile"		=> "Gat ekki opna� skjali�.",
	"savefile"		=> "Vistun skjalsins mist�kst.",
	"createfile"		=> "Gat ekki b�i� til skr�nna.",
	"createdir"		=> "Gat ekki b�i� til skr�nna.",
	"uploadfile"		=> "Gat ekki s�tt skr�nna.",
	"copyitem"		=> "Afritun mist�kst.",
	"moveitem"		=> "Ekki t�kst a� f�ra skr�nna.",
	"delitem"		=> "Ekki t�kst a� ey�a skr�nni.",
	"chpass"		=> "Mist�kst a� breyta lykilor�inu.",
	"deluser"		=> "Gat ekki fjarl�gt notanda.",
	"adduser"		=> "Gat ekki b�tt inn notanda.",
	"saveuser"		=> "Saving user failed.",
	"searchnothing"		=> "You must supply something to search for.",

	// misc
	"miscnofunc"		=> "Virknin er ekki tilt�k.",
	"miscfilesize"		=> "Skr�inn er of st�r.",
	"miscfilepart"		=> "Hluti af skr�nni var s�ttur.",
	"miscnoname"		=> "Vinsamlegast skr��u inn nafn.",
	"miscselitems"		=> "�� hefur ekki vali� neina hluti.",
	"miscdelitems"		=> "Ertu viss um a� ey�a �essum {0} hlut(um)?",
	"miscdeluser"		=> "Ertu viss um a� vilja ey�a �essum notanda '{0}'?",
	"miscnopassdiff"	=> "N�a lykilor�i� er eins.",
	"miscnopassmatch"	=> "Lykilor�in standast ekki.",
	"miscfieldmissed"	=> "Ekki voru allir reiti r�tt �tfylltir.",
	"miscnouserpass"	=> "Notendanafn e�a lykilor� rangt.",
	"miscselfremove"	=> "�� getur ekki fjarl�gt sj�fan �ig.",
	"miscuserexist"		=> "Notandi er �egar til.",
	"miscnofinduser"	=> "Finn ekki notanda.",
	"extract_noarchive" => "Skr�inn er ekki �j�ppu� safnskr�.",
	"extract_unknowntype" => "��ekkt safnskr�",
	
	'chmod_none_not_allowed' => 'Changing Permissions to <none> is not allowed',
	'archive_dir_notexists' => 'The Save-To Directory you have specified does not exist.',
	'archive_dir_unwritable' => 'Please specify a writable directory to save the archive to.',
	'archive_creation_failed' => 'Failed saving the Archive File'
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "BREYTA A�GANGSST�RINGUM",
	"editlink"		=> "BREYTA",
	"downlink"		=> "NI�URHALA",
	"uplink"		=> "UPP",
	"homelink"		=> "HEIM",
	"reloadlink"		=> "ENDURHLA�A",
	"copylink"		=> "AFRITA",
	"movelink"		=> "F�RA",
	"dellink"		=> "EY�A",
	"comprlink"		=> "GEYMA",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "�TSKR�",
	"uploadlink"		=> "UPPHALA",
	"searchlink"		=> "LEIT",
	"extractlink"	=> "Af�jappa",
	'chmodlink'		=> 'Breyta (chmod) A�gangsst�ringum (m�ppu/skr�(a))', // new mic
	'mossysinfolink'	=> 'eXtplorer uppl�singar (eXtplorer, Server, PHP, mySQL)', // new mic
	'logolink'		=> 'Fara � heimas��u joomlaXplorer (new window)', // new mic

	// list
	"nameheader"		=> "Nafn",
	"sizeheader"		=> "St�r�",
	"typeheader"		=> "Ger�",
	"modifheader"		=> "Breytt",
	"permheader"		=> "A�gangur",
	"actionheader"		=> "A�ger�ir",
	"pathheader"		=> "Sl��",

	// buttons
	"btncancel"		=> "H�tta",
	"btnsave"		=> "Vista",
	"btnchange"		=> "Breyta",
	"btnreset"		=> "Endurstilla",
	"btnclose"		=> "Loka",
	"btncreate"		=> "B�a til",
	"btnsearch"		=> "Leita",
	"btnupload"		=> "Upphala",
	"btncopy"		=> "Afrita",
	"btnmove"		=> "F�ra",
	"btnlogin"		=> "Innskr�",
	"btnlogout"		=> "�tskr�",
	"btnadd"		=> "B�ta inn",
	"btnedit"		=> "Breyta",
	"btnremove"		=> "Taka �t",

	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'RENAME',
	'confirm_delete_file' => 'Are you sure you want to delete this file? \\n%s',
	'success_delete_file' => 'Item(s) successfully deleted.',
	'success_rename_file' => 'The directory/file %s was successfully renamed to %s.',
	
	// actions
	"actdir"		=> "Mappa",
	"actperms"		=> "Breyta a�gangsst�ringum",
	"actedit"		=> "Breyta skjali",
	"actsearchresults"	=> "Ni�urst��ur leitar",
	"actcopyitems"		=> "Afrita hlut(i)",
	"actcopyfrom"		=> "Afrita fr� /%s til /%s ",
	"actmoveitems"		=> "F�ra hlut(i)",
	"actmovefrom"		=> "F�ra fr� /%s til /%s ",
	"actlogin"		=> "Innskr�",
	"actloginheader"	=> "Innskr� til a� nota QuiXplorer",
	"actadmin"		=> "Kerfisstj�rn",
	"actchpwd"		=> "Breyta lykilor�i",
	"actusers"		=> "Notendur",
	"actarchive"		=> "Geyma hlut(i)",
	"actupload"		=> "Upphala skr�(m)",

	// misc
	"miscitems"		=> "Hlut(i)",
	"miscfree"		=> "Fr�tt",
	"miscusername"		=> "Notendanafn",
	"miscpassword"		=> "Lykilor�",
	"miscoldpass"		=> "Gamla lykilor�i�",
	"miscnewpass"		=> "N�tt lykilor�",
	"miscconfpass"		=> "Sta�festa lykilor�",
	"miscconfnewpass"	=> "Sta�festa n�tt lykilor�",
	"miscchpass"		=> "Breyta lykilor�i",
	"mischomedir"		=> "Heimasv��i",
	"mischomeurl"		=> "Sl��",
	"miscshowhidden"	=> "S�na falda hluti",
	"mischidepattern"	=> "Hylja sl��",
	"miscperms"		=> "A�gangsst�ring",
	"miscuseritems"		=> "(nafn, heimasv��i, s�na falda hluti, a�gangsst�ringar, virkur)",
	"miscadduser"		=> "B�ta vi� notenda",
	"miscedituser"		=> "breyta notanda '%s'",
	"miscactive"		=> "Virkur",
	"misclang"		=> "Tungum�l",
	"miscnoresult"		=> "Engar ni�urst��ur fengust.",
	"miscsubdirs"		=> "Leita � undirm�ppum",
	"miscpermnames"		=> array("Sko�a eing�ngu","Breyta","Breyta lykilor�i","Breyta & Breyta lykior�i",
					"Administrator"),
	"miscyesno"		=> array("J�","Nei","J","N"),
	"miscchmod"		=> array("Eigandi", "H�pur", "Almennt"),

	// from here all new by mic
	'miscowner'			=> 'Eigandi',
	'miscownerdesc'		=> '<strong>L�sing:</strong><br />Notandi (UID) /<br />H�pur (GID)<br />Leyfi:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> 'eXtplorer Uppl�singar',
	'sisysteminfo'		=> 'Kerfisuppl�singar',
	'sibuilton'			=> 'St�rikerfi',
	'sidbversion'		=> '�tg�fa gagnagrunns (MySQL)',
	'siphpversion'		=> 'PHP �tg�fa',
	'siphpupdate'		=> 'Uppl�singar: <span style="color: red;">PHP sem �� ert a� nota er <strong>ekki</strong> raunverulega!</span><br />To guarantee all functions and features of eXtplorer and addons,<br />you should use as minimum <strong>PHP.Version 4.3</strong>!',
	'siwebserver'		=> 'Webserver',
	'siwebsphpif'		=> 'WebServer - PHP Interface',
	'simamboversion'	=> 'eXtplorer �tg�fa',
	'siuseragent'		=> '�tg�fa Vafrara',
	'sirelevantsettings' => 'Important PHP Settings',
	'sisafemode'		=> 'Safe Mode',
	'sibasedir'			=> 'Open basedir',
	'sidisplayerrors'	=> 'PHP Errors',
	'sishortopentags'	=> 'Short Open Tags',
	'sifileuploads'		=> 'Datei Uploads',
	'simagicquotes'		=> 'Magic Quotes',
	'siregglobals'		=> 'Register Globals',
	'sioutputbuf'		=> 'Output Buffer',
	'sisesssavepath'	=> 'Session Savepath',
	'sisessautostart'	=> 'Session auto start',
	'sixmlenabled'		=> 'XML enabled',
	'sizlibenabled'		=> 'ZLIB enabled',
	'sidisabledfuncs'	=> 'Non enabled functions',
	'sieditor'			=> 'WYSIWYG Editor',
	'siconfigfile'		=> 'Config file',
	'siphpinfo'			=> 'PHP Info',
	'siphpinformation'	=> 'PHP Information',
	'sipermissions'		=> 'Permissions',
	'sidirperms'		=> 'Directory permissions',
	'sidirpermsmess'	=> 'To be shure that all functions and features of eXtplorer are working correct, following folders should have permission to write [chmod 0777]',
	'sionoff'			=> array( '�', 'Af' ),
	
	'extract_warning' => "Villtu af�jappa �essari skr�? H�r?\\nA�rar skr�r g�tu veri� yfirskrifa�ar ef ekki er fari� varlega!",
	'extract_success' => "A�j�ppun t�kst",
	'extract_failure' => "Af�j�ppun mist�kst",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file",
	
	// added by Paulino Michelazzo (paulino@michelazzo.com.br) to fun_chmod.php file
	'recurse_subdirs'	=> 'Recurse into subdirectories?',
	
	// added by Paulino Michelazzo (paulino@michelazzo.com.br) to footer.php file
	'check_version'	=> 'Check for latest version',
	
	// added by Paulino Michelazzo (paulino@michelazzo.com.br) to fun_rename.php file
	'rename_file'	=>	'Rename a directory or file...',
	'newname'		=>	'New Name',
	
	// added by Paulino Michelazzo (paulino@michelazzo.com.br) to fun_edit.php file
	'returndir'	=>	'Return to directory after saving?',
	'line'		=> 	'Line',
	'column'	=>	'Column',
	'wordwrap'	=>	'Wordwrap: (IE only)',
	'copyfile'	=>	'Copy file into this filename',
	
	// Bookmarks
	'quick_jump' => 'Quick Jump To',
	'already_bookmarked' => 'This directory is already bookmarked',
	'bookmark_was_added' => 'This directory was added to the bookmark list.',
	'not_a_bookmark' => 'This directory is not a bookmark.',
	'bookmark_was_removed' => 'This directory was removed from the bookmark list.',
	'bookmarkfile_not_writable' => "Failed to %s the bookmark.\n The Bookmark File '%s' \nis not writable.",
	
	'lbl_add_bookmark' => 'Add this Directory as Bookmark',
	'lbl_remove_bookmark' => 'Remove this Directory from the Bookmark List',
	
	'enter_alias_name' => 'Please enter the alias name for this bookmark',
	
	'normal_compression' => 'normal compression',
	'good_compression' => 'good compression',
	'best_compression' => 'best compression',
	'no_compression' => 'no compression',
	
	'creating_archive' => 'Creating Archive File...',
	'processed_x_files' => 'Processed %s of %s Files',
	
	'ftp_header' => 'Local FTP Authentication',
	'ftp_login_lbl' => 'Please enter the login credentials for the FTP server',
	'ftp_login_name' => 'FTP User Name',
	'ftp_login_pass' => 'FTP Password',
	'ftp_hostname_port' => 'FTP Server Hostname and Port <br />(Port is optional)',
	'ftp_login_check' => 'Checking FTP connection...',
	'ftp_connection_failed' => "The FTP server could not be contacted. \nPlease check that the FTP server is running on your server.",
	'ftp_login_failed' => "The FTP login failed. Please check the username and password and try again.",
		
	'switch_file_mode' => 'Current mode: <strong>%s</strong>. You could switch to %s mode.',
	'symlink_target' => 'Target of the Symbolic Link',
	
	"permchange"		=> "CHMOD Success:",
	"savefile"		=> "The File was saved.",
	"moveitem"		=> "Moving succeeded.",
	"copyitem"		=> "Copying succeeded.",
	'archive_name' 	=> 'Name of the Archive File',
	'archive_saveToDir' 	=> 'Save the Archive in this directory',
	
	'editor_simple'	=> 'Simple Editor Mode',
	'editor_syntaxhighlight'	=> 'Syntax-Highlighted Mode',

	'newlink'	=> 'New File/Directory',
	'show_directories' => 'Show Directories',
	'actlogin_success' => 'Login successful!',
	'actlogin_failure' => 'Login failed, try again.',
	'directory_tree' => 'Directory Tree',
	'browsing_directory' => 'Browsing Directory',
	'filter_grid' => 'Filter',
	'paging_page' => 'Page',
	'paging_of_X' => 'of {0}',
	'paging_firstpage' => 'First Page',
	'paging_lastpage' => 'Last Page',
	'paging_nextpage' => 'Next Page',
	'paging_prevpage' => 'Previous Page',
	
	'paging_info' => 'Displaying Items {0} - {1} of {2}',
	'paging_noitems' => 'No items to display',
	'aboutlink' => 'About...',
	'password_warning_title' => 'Important - Change your Password!',
	'password_warning_text' => 'The user account you are logged in with (admin with password admin) corresponds to the default eXtplorer priviliged account. Your eXtplorer installation is open to intrusion and you should immediately fix this security hole!',
	'change_password_success' => 'Your Password has been changed!',
	'success' => 'Success',
	'failure' => 'Failure',
	'dialog_title' => 'Website Dialog',
	'upload_processing' => 'Processing Upload, please wait...',
	'upload_completed' => 'Upload successful!',
	'acttransfer' => 'Transfer from another Server',
	'transfer_processing' => 'Processing Server-to-Server Transfer, please wait...',
	'transfer_completed' => 'Transfer completed!',
	'max_file_size' => 'Maximum File Size',
	'max_post_size' => 'Maximum Upload Limit',
	'done' => 'Done.',
	'permissions_processing' => 'Applying Permissions, please wait...',
	'archive_created' => 'The Archive File has been created!',
	'save_processing' => 'Saving File...',
	'current_user' => 'This script currently runs with the permissions of the following user:',
	'your_version' => 'Your Version',
	'search_processing' => 'Searching, please wait...',
	'url_to_file' => 'URL of the File',
	'file' => 'File'
);
?>
