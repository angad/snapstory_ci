<?php

  $err = "Error"; 
  $dir = "./";
  if (isset($_GET["file"])) {
    if ($_GET["file"] === $_SERVER["PHP_SELF"]) exit($err);
    if (isset($_GET["dir"])) {
      $gdir = $_GET["dir"];
      $dir = ((($gdir[0] === ".") && ($gdir[1] === "/")) ? "" : "./");
      $dir .= $gdir . (($gdir[strlen($gdir) - 1] === "/") ? "" : "/");
      }
    if (!is_dir($dir)) $dir = "./";
    $file = $dir;
    $gfile = $_GET["file"];
    if (($gfile[0] === ".") && ($gfile[1] === "/")) {
      $gfile = explode("/", $gfile);
      $gfile = $gfile[sizeof($gfile) - 1];
      }
    $file .= $gfile;
    $ext_i = strrpos($file, ".");
    if ($ext_i === false) exit($err);
    $ext = substr($file, $ext_i + 1);
    if ((!is_readable($file)) || (!is_file($file))) exit($err);
    $filesize = @filesize($gfile);
    if ($filesize !== false) header("Content-length: " . $filesize);
    if (!strcasecmp($ext, "png")) header("Content-type: image/png"); // display PNG images inline
    else if (!strcasecmp($ext, "gif")) header("Content-type: image/gif"); // display GIF images inline
    else if ((!strcasecmp($ext, "rar")) || (!strcasecmp($ext, "zip"))) header("Content-disposition: attachment; filename=\"" . $gfile . "\""); // download RAR and ZIP archives
    else if ((!strcasecmp($ext, "php")) || (!strcasecmp($ext, "htm")) || (!strcasecmp($ext, "html"))) { // redirect for PHP and HTML pages
      if (isset($_SERVER["HTTP_HOST"])) $host = $_SERVER["HTTP_HOST"];
      else $host = $_SERVER["SERVER_NAME"]; // this only applies on certain servers (not 110mb; such as my local testing server)
      header("Location: http://" . $host . substr($file, 1)); // redirect header requires a full path
      exit;
      }
    echo file_get_contents($file); // output the contents of the file, if not one of the above specified filetypes it will be printed as plain-text
    }
  else echo $err;
  ?>
