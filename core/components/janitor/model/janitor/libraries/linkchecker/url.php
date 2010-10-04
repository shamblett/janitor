<?php
//
// URL - Scriptol Library
// http://www.scriptol.com/compiler/
// Licence: LPGL
//
// (c) 2008 Scriptol.com
//
// Modified for use in the Janitor 3PC for MODx Revolution
// S. Hamblett Sep 2010

class LinkURL {

    var $extensions=array(".html",".php",".htm",".php3",".php4",".php5",".asp",".shtml",".dhtml",".jsp",".xhtml",".stm");
    var $log;
    var $differed="";
    var $DIFFEREDFLAG=0;

    function LinkURL(&$logger) {

        $this->log = $logger;

    }

    function setDiffered($diff) {

        $this->differred = $diff;
    }

    function setDifferedFlag($diffflag) {

        $this->DIFFERREDFLAG = $diffflag;
    }
    
function cdisplay($line)
{
   fwrite($this->log,$line);
   fwrite($this->log,"\n");
   return;
}

function display($message,$url,$flag)
{
   $i=intval($message);
   
   if($message===404)
   {
      $message="**BROKEN** ";
   }
   else
   {
      if($message===301)
      {
         $message="Redirect ";
      }
   else
   {
      if($message===200)
      {
         $message="OK       ";
      }
   else
   {
      if($message===0)
      {
         $message="**Bad URL**  ";
      }
   }}}
   if($flag===true)
   {
      if($this->DIFFEREDFLAG)
      {
         $this->cdisplay($this->differed);
      }

      fwrite($this->log,"$message $url\n");
      $this->DIFFEREDFLAG=false;
   }
   return;
}

function sockAccess($url)
{
   $errno="";
   $errstr="";
   $page="";
   $site="";
   $fp=0;
   if(strlen($url)<8)
   {
      return 0;
   }
   if(strtolower(substr($url,0,7))!="http://")
   {
      return 0;
   }
   $l=strpos($url,"/",8);
   if($l<1)
   {
      $site=substr($url,7);
      $page="/";
   }
   else
   {
      $site=substr($url,7,$l-(7)+strlen($url)*($l<0));
      $page=substr($url,$l);
   }
   $fp=@fsockopen($site,80,$errno,$errstr,30);

   if($fp===false)
   {
      fwrite($this->log, "Error $errstr ($errno) for $url viewed as site:$site page:$page\n");
      return 0;
   }
   $out="GET /$page HTTP/1.1\r\n";
   $out.="Host: $site\r\n";
   $out.="Connection: Close\r\n\r\n";

   fwrite($fp,$out);
   $content=fgets($fp);
   $code=trim(substr($content,9,4));
   fclose($fp);
   return intval($code);
}

function url_exists($url)
{
   $status=$this->sockAccess($url);
   if($status!=200)
   {
      return false;
   }
   return true;
}

function findDefault($thedir)
{
   $url="";
   reset($this->extensions);
   do
   {
      $ext= current($this->extensions);
      $url=$thedir."index".$ext;
      if($this->url_exists($url))
      {
         return $url;
      }
   }
   while(!(next($this->extensions) === false));

   reset($this->extensions);
   do
   {
      $ext= current($this->extensions);
      $url=$thedir."default".$ext;
      if($this->url_exists($url))
      {
         return $url;
      }
   }
   while(!(next($this->extensions) === false));

   reset($this->extensions);
   do
   {
      $ext= current($this->extensions);
      $url=$thedir."home".$ext;
      if($this->url_exists($url))
      {
         return $url;
      }
   }
   while(!(next($this->extensions) === false));

   reset($this->extensions);
   do
   {
      $ext= current($this->extensions);
      $url=$thedir."accueil".$ext;
      if($this->url_exists($url))
      {
         return $url;
      }
   }
   while(!(next($this->extensions) === false));

   $url=$thedir."index";
   if($this->url_exists($url))
   {
      return $url;
   }
   $url=$thedir."home";
   if($this->url_exists($url))
   {
      return $url;
   }
   $url=$thedir."accueil";
   if($this->url_exists($url))
   {
      return $url;
   }
   $url=$thedir."default";
   if($this->url_exists($url))
   {
      return $url;
   }
   return $thedir;
}

// convert local to URL and to unix
function setURL($name)
{
   for($i=0;$i<strlen($name);$i++)
   {
      if($name{$i}==="\\")
      {
         $name{$i}="/";
      }
   }
   return $name;
}

function textToUTF8($content)
{
   $content=str_replace("&","&amp;",$content);
   $content=str_replace("<","&lt;",$content);
   $content=str_replace(">","&gt;",$content);
   return $content;
}

// remove trailing slash or backslash
function noSlash($pth)
{
   $c=substr($pth,-1);
   if(($c==="/")||($c==="\\"))
   {
      return substr($pth,0,-1);
   }
   return $pth;
}

function siteOffset($theurl)
{
   $offset=0;
   $offset=strpos($theurl,"http://");
   if($offset===false)
   {
      $offset=strpos($theurl,"ftp://");
      if($offset===false)
      {
         $offset=strpos($theurl,"https://");
         if($offset!=false)
         {
            $offset+=8;
         }
      }
      else
      {
         $offset+=6;
      }
   }
   else
   {
      $offset+=7;
   }
   return $offset;
}

// test if this is a remote  address (host included in the string)
function hasProtocol($theurl)
{
   $lowname=strtolower(ltrim($theurl));
   if(substr($lowname,0,7)==="http://")
   {
      return true;
   }
   if(substr($lowname,0,6)==="ftp://")
   {
      return true;
   }
   if(substr($lowname,0,8)==="https://")
   {
      return true;
   }
   return false;
}

// return remote part and local part
function splitURL($theurl)
{
   $offset=$this->siteOffset($theurl);
   if($offset===false)
   {
      return array("",$theurl);
   }
   $offset=strpos($theurl,"/",$offset);
   if($offset===false)
   {
      return array($theurl,"");
   }
   return array(substr($theurl,0,$offset),substr($theurl,$offset+1));
}

// get the remote part of URL
function getURL($theurl)
{
   $offset=$this->siteOffset($theurl);
   $offset=strpos($theurl,"/",$offset);
   if($offset===false)
   {
      return $theurl;
   }
   return substr($theurl,0,$offset);
}

function setWindows($name)
{
   for($i=0;$i<strlen($name);$i++)
   {
      if($name{$i}==="/")
      {
         $name{$i}="\\";
      }
   }
   return $name;
}

// if drive letter in path, change drive
function changeDir($pth)
{
   chdir($pth);
   return;
}

// Check if the source ends with the string search
function endWith($source,$search)
{
   $last=substr($search,-1);
   if(($last==="/")||($last==="\\"))
   {
      $search=substr($search,0,-1);
   }
   $lsea=strlen($search);
   $lsrc=strlen($source);
   if($lsrc<$lsea)
   {
      return false;
   }
   if(substr($source,-$lsea)===$search)
   {
      return true;
   }
   return false;
}

}
