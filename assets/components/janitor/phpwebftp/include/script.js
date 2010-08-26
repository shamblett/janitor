var selectItem = "";
var renameOn = false;
var permissionsOn = false;
permission="";

function logOff() {
	document.actionform.actionType.value="logoff";
	document.actionform.submit();
}

function submitForm(action, file, file2)
{
  document.actionform.actionType.value = action;
  document.actionform.file.value = file;
  document.actionform.file2.value = file2;
  document.actionform.submit();
};

function toggle(layer) {
	if (document.getElementById(layer).style.display=="none")
	{
		document.getElementById(layer).style.display="";
	} else {
		document.getElementById(layer).style.display="none";
	}
}
function setNewFileName()
{
	if(renameOn) {
		document.getElementById("renameFileEntry").style.display="none";
		renameOn = false;
	} else {
		document.actionform.actionType.value="rename";
		document.getElementById("renameFileEntry").style.display="";
		document.renameFile.newName.value=document.actionform.file.value;
		document.renameFile.newName.focus();
		renameOn=true;
	}
};

function renameItem()
{
	oldName = document.actionform.file.value;
	newName = document.renameFile.newName.value
	if (confirm("rename " + document.actionform.file.value + " to " + document.renameFile.newName.value + "?\n"))
	{
		submitForm("rename", oldName, newName)
	}
};

function setPermissions()
{
	if(permissionsOn) {
		document.actionform.actionType.value="";
		document.getElementById("setPermissions").style.display="none";
		permissionsOn = false;
	} else {
		document.actionform.actionType.value="chmod";
		document.getElementById("setPermissions").style.display="";
		permission=document.actionform.permissions.value;
		permissionsOn = true;

		Or=permission.substring(1,2);
		Gr=permission.substring(4,5);
		Pr=permission.substring(7,8);

		Ow=permission.substring(2,3);
		Gw=permission.substring(5,6);
		Pw=permission.substring(8,9);

		Ox=permission.substring(3,4);
		Gx=permission.substring(6,7);
		Px=permission.substring(9,10);

		focus();
		if(Or!="-") { permissions.iOr.checked = true }
		if(Gr!="-") { permissions.iGr.checked = true }
		if(Pr!="-") { permissions.iPr.checked = true }

		if(Ow!="-") { permissions.iOw.checked = true }
		if(Gw!="-") { permissions.iGw.checked = true }
		if(Pw!="-") { permissions.iPw.checked = true }

		if(Ox!="-") { permissions.iOx.checked = true }
		if(Gx!="-") { permissions.iGx.checked = true }
		if(Px!="-") { permissions.iPx.checked = true }
	}
}

function resetEntries()
{
	document.actionform.actionType.value = "";
	document.actionform.delaction.value = "";
	document.actionform.file.value = "";
	document.actionform.file2.value = "";

	counter=0;

	while(document.getElementById("filename" + counter)) {
	  document.getElementById("filename" + counter).style.background = "#F7F7F7";
	  document.getElementById("filename" + counter).style.color = "black";
	  counter++;
	}

	document.getElementById("setPermissions").style.display="none";
	permissionsOn = false;

	document.getElementById("renameFileEntry").style.display="none";
	renameOn = false;

	document.getElementById("fileactions").style.display="none";

}

function selectEntry(action, file, item, permissions, delaction)
{
  resetEntries()
  document.actionform.actionType.value = action;
  document.actionform.delaction.value = delaction;
  document.actionform.file.value = file;
  document.actionform.permissions.value = permissions;
  document.actionform.extension.value = file.substr(file.length-3,3);
  document.getElementById(item).style.color = "#FFFFFF";
  document.getElementById(item).style.background = "#316AC5";
  selectItem=item;
  document.getElementById("fileactions").style.display="";
}


function createDirectory(directory)
{
  if(directory)
  {submitForm("createdir", directory);}
  else
  {alert('Enter a directory name first');}
};

function changeMode(mode)
{
  document.actionform.mode.value = mode;
  document.actionform.submit();
};


function deleteFile()
{
	if (confirm("Really delete this Item ?\n"))
	{
		document.actionform.actionType.value = document.actionform.delaction.value;
		document.actionform.submit();
	}
};

function editFile()
{
	if(document.actionform.delaction.value == "delfile") {
		document.actionform.actionType.value = "edit";
		document.actionform.submit();
	} else {
		alert("Sorry, this function is only available for files");
	}
};

function zipFile()
{
	if(document.actionform.delaction.value == "deldir") {
		document.actionform.actionType.value = "getzip";
		document.actionform.submit();
	} else {
		alert("Sorry, this function is only available for directories");
	}
};

function cancelEditFile()
{
	document.editFileForm.actionType.value = "";
	document.editFileForm.submit();
}

function Confirmation(URL)
{
  if (confirm("Really delete this Item ?\n"))
  {location = String(URL);}
  else
  {
	  //Do nothing
  }
};

function ConfirmationUnzip(URL)
{
  if (confirm("Unzip File in the current dir ?\n"))
  {location = String(URL);}
};


function changePermissions()
{
	O=0;
	P=0;
	G=0;

	if(permissions.iOr.checked == true) { O=O+4 }
	if(permissions.iGr.checked == true) { G=G+4 }
	if(permissions.iPr.checked == true) { P=P+4 }

	if(permissions.iOw.checked == true) { O=O+2 }
	if(permissions.iGw.checked == true) { G=G+2 }
	if(permissions.iPw.checked == true) { P=P+2 }

	if(permissions.iOx.checked == true) { O=O+1 }
	if(permissions.iGx.checked == true) { G=G+1 }
	if(permissions.iPx.checked == true) { P=P+1 }

	document.actionform.permissions.value=O+""+G+""+P;
	document.actionform.action.value="chmod";
	document.actionform.submit()
}