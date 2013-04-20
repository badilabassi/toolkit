<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// default config variables
c::set(array(
  
  // toolkit version
  'toolkit.version.string' => '2.0',
  'toolkit.version.number' => 2.0,

  // set the default timezone
  'timezone' => 'UTC',

  // secret key
  'cookie.salt' => 'secretTokenForCookieHashes',

  // permissions for new directories
  'dir.make.permissions' => 0755,
  'dir.read.ignore' => array('.', '..', '.DS_Store'),
  
  // the default path for templates
  'tpl.root' => '',

  // upload settings
  'upload.maxsize' => false,

  // banned visitor ips
  'visitor.banned' => array(),

  // a list of detectable mime types, borrowed from Laravel
  'f.mimes' => array(
    'hqx'   => 'application/mac-binhex40',
    'cpt'   => 'application/mac-compactpro',
    'csv'   => array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream'),
    'bin'   => 'application/macbinary',
    'dms'   => 'application/octet-stream',
    'lha'   => 'application/octet-stream',
    'lzh'   => 'application/octet-stream',
    'exe'   => array('application/octet-stream', 'application/x-msdownload'),
    'class' => 'application/octet-stream',
    'psd'   => 'application/x-photoshop',
    'so'    => 'application/octet-stream',
    'sea'   => 'application/octet-stream',
    'dll'   => 'application/octet-stream',
    'oda'   => 'application/oda',
    'pdf'   => array('application/pdf', 'application/x-download'),
    'ai'    => 'application/postscript',
    'eps'   => 'application/postscript',
    'ps'    => 'application/postscript',
    'smi'   => 'application/smil',
    'smil'  => 'application/smil',
    'mif'   => 'application/vnd.mif',
    'xls'   => array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
    'ppt'   => array('application/powerpoint', 'application/vnd.ms-powerpoint'),
    'wbxml' => 'application/wbxml',
    'wmlc'  => 'application/wmlc',
    'dcr'   => 'application/x-director',
    'dir'   => 'application/x-director',
    'dxr'   => 'application/x-director',
    'dvi'   => 'application/x-dvi',
    'gtar'  => 'application/x-gtar',
    'gz'    => 'application/x-gzip',
    'php'   => array('application/x-httpd-php', 'text/x-php'),
    'php4'  => 'application/x-httpd-php',
    'php3'  => 'application/x-httpd-php',
    'phtml' => 'application/x-httpd-php',
    'phps'  => 'application/x-httpd-php-source',
    'js'    => 'application/x-javascript',
    'swf'   => 'application/x-shockwave-flash',
    'sit'   => 'application/x-stuffit',
    'tar'   => 'application/x-tar',
    'tgz'   => array('application/x-tar', 'application/x-gzip-compressed'),
    'xhtml' => 'application/xhtml+xml',
    'xht'   => 'application/xhtml+xml',
    'zip'   => array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
    'mid'   => 'audio/midi',
    'midi'  => 'audio/midi',
    'mpga'  => 'audio/mpeg',
    'mp2'   => 'audio/mpeg',
    'mp3'   => array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
    'aif'   => 'audio/x-aiff',
    'aiff'  => 'audio/x-aiff',
    'aifc'  => 'audio/x-aiff',
    'ram'   => 'audio/x-pn-realaudio',
    'rm'    => 'audio/x-pn-realaudio',
    'rpm'   => 'audio/x-pn-realaudio-plugin',
    'ra'    => 'audio/x-realaudio',
    'rv'    => 'video/vnd.rn-realvideo',
    'wav'   => 'audio/x-wav',
    'bmp'   => 'image/bmp',
    'gif'   => 'image/gif',
    'jpg'   => array('image/jpeg', 'image/pjpeg'),
    'jpeg'  => array('image/jpeg', 'image/pjpeg'),
    'jpe'   => array('image/jpeg', 'image/pjpeg'),
    'png'   => 'image/png',
    'tiff'  => 'image/tiff',
    'tif'   => 'image/tiff',
    'css'   => 'text/css',
    'html'  => 'text/html',
    'htm'   => 'text/html',
    'shtml' => 'text/html',
    'txt'   => 'text/plain',
    'text'  => 'text/plain',
    'log'   => array('text/plain', 'text/x-log'),
    'rtx'   => 'text/richtext',
    'rtf'   => 'text/rtf',
    'xml'   => 'text/xml',
    'xsl'   => 'text/xml',
    'mpeg'  => 'video/mpeg',
    'mpg'   => 'video/mpeg',
    'mpe'   => 'video/mpeg',
    'qt'    => 'video/quicktime',
    'mov'   => 'video/quicktime',
    'avi'   => 'video/x-msvideo',
    'movie' => 'video/x-sgi-movie',
    'doc'   => 'application/msword',
    'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'word'  => array('application/msword', 'application/octet-stream'),
    'xl'    => 'application/excel',
    'eml'   => 'message/rfc822',
    'json'  => array('application/json', 'text/json'),
  ),

  'f.types' => array(

    'image' => array(
      'jpeg',
      'jpg',
      'jpe',
      'gif',
      'png',
      'svg',
      'ico',
      'tif',
      'tiff',
      'bmp',
      'psd',
      'ai',
      'eps', 
      'ps'
    ),

    'document' => array(
      'txt',
      'text',
      'mdown',
      'md',
      'markdown',
      'pdf',
      'doc',
      'docx',
      'word',
      'xl',
      'xls',
      'xlsx',
      'ppt',
      'csv',
      'rtf',
      'rtx',
      'log',
    ),

    'archive' => array(
      'zip',
      'tar',
      'gz',
      'gzip',
      'tgz',
    ),

    'code' => array(
      'js',
      'css',
      'scss',
      'htm',
      'html',
      'shtml',
      'xhtml',
      'php',
      'php3',
      'php4',
      'rb',
      'xml',
      'json',
    ),

    'video' => array(
      'mov',
      'movie',
      'avi',
      'ogg',
      'ogv',
      'webm',
      'flv',
      'swf',
      'mp4',
      'mv4',
      'mpg', 
      'mpe'
    ),

    'audio' => array(
      'mp3',
      'wav',
      'aif',
      'aiff', 
      'midi',
    ),

  ),

));