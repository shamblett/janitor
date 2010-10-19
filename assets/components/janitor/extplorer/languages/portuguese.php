<?php

// Portuguese Language Module for joomlaXplorer (translated by Paulo Brito, geral@oitavaesfera.com, http://www.oitavaesfera.com)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "d/m/y H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "ERRO(S)",
	"back"			=> "Voltar",
	
	// root
	"home"			=> "A directoria inicial n�o existe, verifique as configura��es.",
	"abovehome"		=> "A directoria actual n�o pode estar acima da directoria inicial.",
	"targetabovehome"	=> "A directoria alvo n�o pode estar acima da directoria principal.",
	
	// exist
	"direxist"		=> "Esta directoria n�o existe.",
	//"filedoesexist"	=> "Este ficheiro j� existe.",
	"fileexist"		=> "Este ficheiro n�o existe.",
	"itemdoesexist"		=> "Este item j� existe.",
	"itemexist"		=> "Este item n�o existe.",
	"targetexist"		=> "A directoria n�o existe.",
	"targetdoesexist"	=> "A directoria j� existe.",
	
	// open
	"opendir"		=> "N�o � poss�vel abrir a directoria.",
	"readdir"		=> "N�o � poss�vel ler a directoria.",
	
	// access
	"accessdir"		=> "N�o est� autorizado a aceder a esta directoria.",
	"accessfile"		=> "N�o est� autorizado a aceder a este ficheiro.",
	"accessitem"		=> "N�o est� autorizado a aceder a este item.",
	"accessfunc"		=> "N�o est� autorizado a usar esta fun��o.",
	"accesstarget"		=> "N�o est� autorizado a aceder � directoria.",
	
	// actions
	"permread"		=> "N�o foi poss�vel visualizar as permiss�es.",
	"permchange"		=> "N�o foi poss�vel modificar as permiss�es.",
	"openfile"		=> "N�o foi poss�vel abrir o ficheiro.",
	"savefile"		=> "N�o foi poss�vel gravar o ficheiro.",
	"createfile"		=> "N�o foi poss�vel criar o ficheiro.",
	"createdir"		=> "N�o foi poss�vel criar a directoria.",
	"uploadfile"		=> "N�o foi poss�vel o envio do ficheiro.",
	"copyitem"		=> "N�o foi poss�vel a c�pia.",
	"moveitem"		=> "N�o foi poss�vel mover.",
	"delitem"		=> "N�o foi poss�vel apagar o ficheiro.",
	"chpass"		=> "N�o foi poss�vel modificar a password.",
	"deluser"		=> "N�o foi poss�vel remover o utilizador.",
	"adduser"		=> "N�o foi poss�vel adicionar o utilizador.",
	"saveuser"		=> "N�o foi poss�vel gravar o utilizador.",
	"searchnothing"		=> "Deve ser inserido um valor para ser feita a procura.",
	
	// misc
	"miscnofunc"		=> "Fun��o n�o dispon�vel.",
	"miscfilesize"		=> "O ficheiro ultrapassa o tamanho m�ximo permitido.",
	"miscfilepart"		=> "O ficheiro foi apenas enviado parcialmente.",
	"miscnoname"		=> "Deve ser fornecido um nome.",
	"miscselitems"		=> "N�o foi seleccionado qualquer item.",
	"miscdelitems"		=> "Tem certeza que deseja apagar este(s) {0} item(s)?",
	"miscdeluser"		=> "Tem certeza que deseja apagar o utilizador '{0}'?",
	"miscnopassdiff"	=> "A nova password n�o � diferente da actual.",
	"miscnopassmatch"	=> "As passwords n�o s�o iguais.",
	"miscfieldmissed"	=> "Um campo importante est� vazio.",
	"miscnouserpass"	=> "Username ou password incorrectos.",
	"miscselfremove"	=> "N�o pode remover-se a si pr�prio.",
	"miscuserexist"		=> "O utilizador j� existe.",
	"miscnofinduser"	=> "N�o foi poss�vel encontrar o utilizador.",
	"extract_noarchive" => "O Ficheiro n�o � um arquivo de extrac��o.",
	"extract_unknowntype" => "Tipo de Arquivo Desconhecido",
	
	'chmod_none_not_allowed' => 'Changing Permissions to <none> is not allowed',
	'archive_dir_notexists' => 'The Save-To Directory you have specified does not exist.',
	'archive_dir_unwritable' => 'Please specify a writable directory to save the archive to.',
	'archive_creation_failed' => 'Failed saving the Archive File'
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "MODIFICAR PERMISS�ES",
	"editlink"		=> "EDITAR",
	"downlink"		=> "DOWNLOAD",
	"uplink"		=> "CIMA",
	"homelink"		=> "P�GINA INICIAL",
	"reloadlink"		=> "ACTUALIZAR",
	"copylink"		=> "COPIAR",
	"movelink"		=> "MOVER",
	"dellink"		=> "APAGAR",
	"comprlink"		=> "ARQUIVO",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "LOGOUT",
	"uploadlink"		=> "UPLOAD",
	"searchlink"		=> "PROCURAR",
	"extractlink"	=> "Extrair Arquivo",
	'chmodlink'		=> 'Modificar as Permiss�es (chmod) (Pasta/Ficheiro(s))', // new mic
	'mossysinfolink'	=> 'eXtplorer Informa��o do Sistema (eXtplorer, Server, PHP, mySQL)', // new mic
	'logolink'		=> 'Ir para o site do joomlaXplorer (nova janela)', // new mic
	
	// list
	"nameheader"		=> "Nome",
	"sizeheader"		=> "Tamanho",
	"typeheader"		=> "Tipo",
	"modifheader"		=> "Modificado",
	"permheader"		=> "Permiss�es",
	"actionheader"		=> "Ac��es",
	"pathheader"		=> "Caminho",
	
	// buttons
	"btncancel"		=> "Cancelar",
	"btnsave"		=> "Gravar",
	"btnchange"		=> "Modificar",
	"btnreset"		=> "Reiniciar",
	"btnclose"		=> "Fechar",
	"btncreate"		=> "Criar",
	"btnsearch"		=> "Procurar",
	"btnupload"		=> "Upload",
	"btncopy"		=> "Copiar",
	"btnmove"		=> "Mover",
	"btnlogin"		=> "Login",
	"btnlogout"		=> "Logout",
	"btnadd"		=> "Novo",
	"btnedit"		=> "Editar",
	"btnremove"		=> "Remover",
	
	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'RENOMEAR',
	'confirm_delete_file' => 'Tem a certeza que deseja apagar este ficheiro? \\n%s',
	'success_delete_file' => 'Item(s) apagado com sucesso.',
	'success_rename_file' => 'A directoria/ficheiro %s foi renomeada com sucesso para %s.',
	
	
	// actions
	"actdir"		=> "Directoria",
	"actperms"		=> "Modificar permiss�es",
	"actedit"		=> "Editar ficheiro",
	"actsearchresults"	=> "Resultados da procura",
	"actcopyitems"		=> "Copiar item(s)",
	"actcopyfrom"		=> "Copiar de /%s para /%s ",
	"actmoveitems"		=> "Mover item(s)",
	"actmovefrom"		=> "Mover de /%s para /%s ",
	"actlogin"		=> "Login",
	"actloginheader"	=> "Fa�a o login para usar o QuiXplorer",
	"actadmin"		=> "Administra��o",
	"actchpwd"		=> "Modificar password",
	"actusers"		=> "utilizadores",
	"actarchive"		=> "Arquivo de item(s)",
	"actupload"		=> "Upload de ficheiro(s)",
	
	// misc
	"miscitems"		=> "Item(s)",
	"miscfree"		=> "Livres",
	"miscusername"		=> "Username",
	"miscpassword"		=> "Password",
	"miscoldpass"		=> "Password antiga",
	"miscnewpass"		=> "Nova password",
	"miscconfpass"		=> "Confirmar password",
	"miscconfnewpass"	=> "Confirmar a nova password",
	"miscchpass"		=> "Modificar password",
	"mischomedir"		=> "Directoria inicial",
	"mischomeurl"		=> "URL da p�gina inicial",
	"miscshowhidden"	=> "Mostrar items escondidos",
	"mischidepattern"	=> "Esconder esquema",
	"miscperms"		=> "Permiss�es",
	"miscuseritems"		=> "(nome, directoria inicial, mostrar items escondidos, permiss�es, activo)",
	"miscadduser"		=> "novo utilizador",
	"miscedituser"		=> "editar utilizador '%s'",
	"miscactive"		=> "Activo",
	"misclang"		=> "Linguagem",
	"miscnoresult"		=> "N�o h� resultados dispon�veis.",
	"miscsubdirs"		=> "Procurar subdirectorias",
	"miscpermnames"		=> array("Ver apenas","Modificar","Alterar password","Modificar a password",
					"Administrador"),
	"miscyesno"		=> array("Sim","N�o","Y","N"),
	"miscchmod"		=> array("Propriet�rio", "Grupo", "P�blico"),
	// from here all new by mic
	'miscowner'			=> 'Propriet�rio',
	'miscownerdesc'		=> '<strong>Desccri��o:</strong><br />Utilizador (UID) /<br />Grupo (GID)<br />Permiss�es Actuais:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> 'eXtplorer Info Sistema',
	'sisysteminfo'		=> 'Info Sistema',
	'sibuilton'			=> 'Sistema Operativo',
	'sidbversion'		=> 'Vers�o da Base de Dados (MySQL)',
	'siphpversion'		=> 'Vers�o de PHP',
	'siphpupdate'		=> 'INFORMA��O: <span style="color: red;">A vers�o de PHP usada <strong>n�o est�</strong> actualizada!</span><br />Para garantir todas as fun��es e possibilidades do eXtplorer e dos addons,<br />deve estar a usar pelo menos a <strong>Vers�o 4.3 do PHP</strong>!',
	'siwebserver'		=> 'Servidor Web',
	'siwebsphpif'		=> 'Servidor Web - PHP Interface',
	'simamboversion'	=> 'eXtplorer Vers�o',
	'siuseragent'		=> 'Vers�o do Browser',
	'sirelevantsettings' => 'Configura��es de PHP Importantes',
	'sisafemode'		=> 'Safe Mode',
	'sibasedir'			=> 'Open basedir',
	'sidisplayerrors'	=> 'Erros de PHP',
	'sishortopentags'	=> 'Short Open Tags',
	'sifileuploads'		=> 'Datei Uploads',
	'simagicquotes'		=> 'Magic Quotes',
	'siregglobals'		=> 'Registar Globais',
	'sioutputbuf'		=> 'Output Buffer',
	'sisesssavepath'	=> 'Session Savepath',
	'sisessautostart'	=> 'Session auto start',
	'sixmlenabled'		=> 'XML enabled',
	'sizlibenabled'		=> 'ZLIB enabled',
	'sidisabledfuncs'	=> 'Non enabled functions',
	'sieditor'			=> 'Editor WYSIWYG',
	'siconfigfile'		=> 'Configuration File',
	'siphpinfo'			=> 'PHP Info',
	'siphpinformation'	=> 'PHP Information',
	'sipermissions'		=> 'Permissions',
	'sidirperms'		=> 'Directory Permissions',
	'sidirpermsmess'	=> 'Para ter certeza que todas as fun��es e possibilidades do eXtplorer est�o a funcionar correctamente, as seguintes pastas devem ter a permiss�o de escrita [chmod 0777]',
	'sionoff'			=> array( 'On', 'Off' ),
	
	'extract_warning' => "Deseja mesmo extrair este ficheiro? Aqui?\\nIsto ir� apagar ficheiros existentes se n�o for usado com cuidado!",
	'extract_success' => "A extrac��o foi um sucesso",
	'extract_failure' => "A extrac��o falhou",
	
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
