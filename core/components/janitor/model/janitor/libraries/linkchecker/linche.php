<?php
//
// Scriptol Link Checker 1.0
// (c) 2008 Scriptol.com
// Free under the GNU GPL 2 License.
// Requires the PHP interpreter.
// Sources are compiled with the Scriptol PHP compiler 7.0
// www.scriptol.com
//
// The program checks the page of a website for broken links.
// Read the manual for details of use at:
//   http://www.scriptol.com/scripts/link-checker.php.
//
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
// Modified for use in the Janitor 3PC for MODx Revolution
// S. Hamblett Sep 2010

include_once("path.php");
include_once("url.php");

class LinkCheck {

    const BANNER = '------------------------------------------------------------------------';

var $RECURSE=false;
var $PROCESSDEFAULT=true;
var $counter=0;
var $brocount=0;
var $redcount=0;
var $checked=array();
var $scanned=array();
var $extensions=array(".html",".php",".htm",".php3",".php4",".php5",".asp",".shtml",".dhtml",".jsp",".xhtml",".stm");
var $DEBUG=false;
var $VERBOSE=false;
var $QUIET=false;
var $website="";
var $server="";
var $domain="";
var $baseLength=0;
var $differed="";
var $DIFFEREDFLAG=0;
var $log=0;
var $linkurl;
var $outFile = '';
var $summary;

function LinkCheck() {
        
}

function getLogFile() {

    return $this->outFile;
}

function getSummary() {

    return $this->summary;
}

function usage()
{
    /* "\n";
    "Link Checher - (c) 2008 Scriptol.com - Freeware.", "\n";
    "-----------------------------------------------", "\n";
    "Syntax:", "\n";
    "  solp linche [options] url", "\n";
    "Options:", "\n";
    "  -r follow links (default the page only).", "\n";
    "  -v verbose, display more infos.", "\n";
    "  -q quiet, display nothing.", "\n";
    "Arguments:", "\n";
    "  url: http address of a page, usually the home page.", "\n";
    "Logs stored into links.log.", "\n";
    "More info at: http://www.scriptol.com/scripts/", "\n";*/
   exit(0);
   return;
}

function splitSite($url)
{
   $pos=strpos($url,'/',8);
   if($pos===false)
   {
      $ext=Path::getExtension($url);
      
      if(!in_array($ext,$this->extensions))
      {
         return array($url,"");
      }
      die("$url not a valid url");
   }
   $site=substr($url,0,$pos);
   $filename=substr($url,$pos+1);
   return array($site,$filename);
}

function isInternal($url)
{
   $l=strlen($this->website);
   $url=strtolower($url);

   if($this->website===substr($url,0,$l))
   {
      return true;
   }
   return false;
}

function checkLink($url)
{
   $this->counter+=1;

   $status=$this->linkurl->sockAccess($url);
   
   if($status===404)
   {
      $this->linkurl->display($status,$url,true);
      $this->brocount+=1;
   }
   else
   {
      if($status===301)
      {
         $this->linkurl->display($status,$url,true);
         $this->redcount+=1;
      }
   else
   {
      if($status===200)
      {
         $this->linkurl->display($status,$url,true);
      }
   else
   {
      if($status===0)
      {
         $this->linkurl->display($status,$url,true);
         $this->brocount+=1;
      }
   else
   {
      $this->linkurl->display($status,$url,true);
   }
   }}}
  
   $this->checked[$url]=$status;
   return $status;
}

function pageScan($fname,$caller)
{
   $current=null;
   $elem=null;
   $xres=0;
   $links=array();
   $d=new DOMDocument();

   
    $xres = @$d->loadHTMLFile($fname);
  
   if($xres===false)
   {
      fwrite($this->log, "Error \"$fname\" not found in $caller\n");
      $this->brocount+=1;
      return array();
   }
   $dnl=$d->getElementsByTagName("a");
   if($dnl->length===0)
   {
      return array();
   }
   for($i=0;$i<=$dnl->length;$i++)
   {
      $current=$dnl->item($i);
      if($current===null)
      {
         continue;
      }
      $elem=$current;
      if($elem->hasAttribute("href"))
      {
         if ( strstr($elem->getAttribute("href"), "localhost") === false) {
          array_push($links,$elem->getAttribute("href"));
         }
      }
   }
   return $links;
}

function httpCheck($page,$caller)
{
   $links=array();
   $todo=array();
   $reldir="";
   $src="";
   $ext="";
   if(trim($page) ==false)
   {
      return;
   }
   if($page{0}===".")
   {
      return;
   }
 
   if(@array_key_exists($page,$this->scanned))
   {
      return;
   }
   $this->scanned[$page]=200;
   $this->checked[$page]=200;
   
   $this->differed="\n$page\n".str_repeat("-",strlen($page));
   $this->DIFFEREDFLAG=true;
   $this->linkurl->setDiffered($this->differed);
   $this->linkurl->setDifferedFlag($this->DIFFEREDFLAG);

   $infos=pathinfo($page);
   $reldir=@strtolower($infos{'dirname'});
   $src=@strtolower($infos{'filename'});
   $ext=@strtolower($infos{'extension'});
   $extArray = explode('?', $ext);
   $ext = $extArray[0];
   
   if(substr($page,-1,1)==="/")
   {
      $l=intVal(strlen($this->website));
      $reldir=$page;
      $src="";

   }
   else
   {
      if($ext!=false)
      {
         $ext=".".$ext;
         if(!in_array($ext,$this->extensions))
         {
            return;
         }
         $src.=$ext;
      }
   }
  
   $links=$this->pageScan($page,$caller);
   if(count($links)===0)
   {
      return;
   }
   $l=count($links);
   for($i=0;$i<$l;$i++)
   {
      $link=$links[$i];
      if($link{0}==="#")
      {
         continue;
      }
      $p=strpos($link,"#",0);
      if($p!=0)
      {
         $link=substr($link,0,$p);
      }
      if(!$this->linkurl->hasProtocol($link))
      {
         if(strlen($link)>7)
         {
            if(substr($link,0,7)==="mailto:")
            {
               continue;
            }
         }
         $link=Path::merge($reldir,$link);
      }
      if(trim($link) ==false)
      {
         continue;
      }
      if(@array_key_exists($link,$this->checked))
      {
         $this->linkurl->display($this->checked[$link],$link,false);
         continue;
      }
      if($this->isInternal($link))
      {
         if($this->PROCESSDEFAULT)
         {
            if(substr($link,-1)==="/")
            {
               $home=$this->linkurl->findDefault($link);
               if(@array_key_exists($home,$checked)===false)
               {
                  $this->checked[$home]=200;
               }
            }
         }
         array_push($todo,$link);
      }
      $st=$this->checkLink($link);
      $this->checked[$link]=$st;
   }
   reset($todo);
   do
   {
      $link= current($todo);
      if(@array_key_exists($link,$this->scanned))
      {
         continue;
      }
      if(@array_key_exists($link,$this->checked)===false)
      {
         continue;
      }
      if($this->checked[$link]===200)
      {
         $this->httpCheck($link,$page);
      }
   }
   while(!(next($todo) === false));

   return;
}

function httpProcess($page)
{
   if(substr($page,-1)==="/")
   {
      $page=$this->linkurl->findDefault($page);
   }
   $this->httpCheck($page,"command line");
   return;
}

function runCheck($pageSet, $logpath)
{  

   /* Initialize logging */
   $datePart = date('d-m-y-Hi');
   $outFile = $logpath . 'linkcheck-' . $datePart . '.log';
   $this->log=fopen($outFile,"w");
   $this->outFile = $outFile;

   /* Always verbose */
   $this->VERBOSE=true;

   /* URL class */
   $this->linkurl = new LinkURL($this->log);
   
   /* Page check loop */
   fwrite($this->log, PHP_EOL);
   $datePart = date('d-m-y-H:i');
   fwrite($this->log, "Checking started at - " . $datePart);
   fwrite($this->log, PHP_EOL);

   foreach ( $pageSet as $pageData ) {

       $this->server=$pageData['page'];
       $pageArray = explode('?', $pageData['page']);
       $pageId = $pageArray[1];
       $_I1=$this->splitSite($this->server);
       $this->website=reset($_I1);
       $filename=next($_I1);
       $this->website=strtolower($this->website);
       $this->domain=substr($this->website,7);
       $this->baseLength=intVal(strlen($this->domain)+7);

       /* Process this page */
       fwrite($this->log, PHP_EOL);
       fwrite($this->log, LinkCheck::BANNER);
       fwrite($this->log, PHP_EOL);
       fwrite($this->log, "Processing page - " . $pageId . " - " . $pageData['title']);
       fwrite($this->log, PHP_EOL);
       fwrite($this->log, LinkCheck::BANNER);
       fwrite($this->log, PHP_EOL);
       $this->httpProcess($this->server);

   }

   /* Summarise and exit */
   $sp=count($pageSet);
   $this->summary .= PHP_EOL;
   $this->summary = "Summary :- ";
   $this->summary .= PHP_EOL;
   $this->summary .= "$this->brocount broken link(s), ";
   $this->summary .= "$this->redcount redirects, in ";
   $this->summary .= "$this->counter links checked in ";
   if ( $sp > 1 ) {
       $this->summary .= "pages.";
   } else {
       $this->summary .= "page.";
   }
   $this->summary .= PHP_EOL;
   $datePart = date('d-m-y-H:i');
   $this->summary .= "Checking finished at - " . $datePart;
   $this->summary .= PHP_EOL;

   fwrite($this->log, PHP_EOL);
   fwrite($this->log, LinkCheck::BANNER);
   fwrite($this->log, PHP_EOL);
   fwrite($this->log, $this->summary);
   fwrite($this->log, LinkCheck::BANNER);
   fwrite($this->log, PHP_EOL);

   fclose($this->log);



   return 0;

}

}
