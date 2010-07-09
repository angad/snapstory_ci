<html>
<head>
<title>Secure File Upload in PHP | Code@AngadSG</title>
<link rel='stylesheet' type='text/css' href='http://code.angad.sg/code.css'>
<!--Syntax Highlighter!-->
<script type='text/javascript' src='http://code.angad.sg/sh/scripts/shCore.js'></script>
<script type='text/javascript' src='http://code.angad.sg/sh/scripts/shBrushPhp.js'></script>
<link type='text/css' rel='stylesheet' href='http://code.angad.sg/sh/styles/shCoreDefault.css'/>
<script type='text/javascript'>SyntaxHighlighter.all();</script>
<!--End SH!-->

</head>
<body>

<h1>code.angad.sg</h1>
<h2>Secure File Upload in PHP</h2>
<div id = 'content'>
<p>
Many web applications, forums, photo galleries etc. allow users to upload files. Providing a secure file upload can be a serious challenging task in PHP web applications. The major security holes that can exist in common file upload applications include file content disclosure (not through the application), remote code execution and hotlinking of files.
</p>
In this article, I am going to cover some important ways of covering the security holes in a file upload web application programmed in PHP.
</p>
<h3>Basic file upload implementation</h3>
<p> An html form that lets user select the file form.html </p>

<pre class='brush:php'>
&lt;form action = 'upload.php' method = 'POST' enctype = 'multipart/form-data'&gt;
Choose File: &lt;input type = 'file' name = 'upfile'/&gt;
&lt;input type = 'submit' value = 'Upload file'/&gt;
&lt;/form&gt;
</pre>

<code>
<h4>Form description</h4>
<p>form action = 'upload.php'           //PHP script which will handle the uploaded file </p>
<p>enctype = 'multipart/form-data'      //<a href = 'http://www.faqs.org/rfcs/rfc1867.html'>RFC1867 - Form-based File Upload in HTML</a> </p>
<p>input type = 'file' 			//specifying a file browse button</p>
</code>

<br/>
<p>An upload script that handles the uploaded file upload.php</p>
<pre class='brush:php'>
//version 1; no security;
&lt;?php

$uploaddir = 'uplaod/';		//Relative path under Web root

if(move_uploaded_file($_FILES['upfile']['tmp_name'], $uploaddir . basename($_FILES['upfile']['name'])))
{
	echo &quot;File uploaded successfully&quot;;
}
else 
{
	echo &quot;File uploading failed&quot;;
}
?&gt;
</pre>
<p> The above implementation allows users to upload any type of file to the upload directory. A user can upload a PHP file and execute any shell commands on the server with web server process privileges. It is a major security holes as SWL queries can be run, malicious files uploaded etc.</p>

<p> The following measures can be taken to make the above basic implementation secure</p>
<h4>
Content-type Verification - Image file content<br/>
File extension verification, before and after upload<br/>
File size check<br/>
Folder Permissions<br/>
Using .htaccess<br/>
Random filenames<br/>
BLOB type storage<br/>
</h4>

<h3>Content-type verification</h3>
This example checks the MIME type in the upload request.

<pre class = "brush:php">
//version 2 : Check MIME type
&lt;?php

if($_FILES['upfile']['type'] ! = &quot;image/gif&quot;) 
{
	echo &quot;Not a GIF image&quot;;
}
else
{

}
$uploaddir = 'uplaod/';		//Relative path under Web root

if(move_uploaded_file($_FILES['upfile']['tmp_name'], $uploaddir . basename($_FILES['upfile']['name'])))
{
	echo &amp;quot;File uploaded successfully&amp;quot;;
}
else 
{
	echo &amp;quot;File uploading failed&amp;quot;;
}
?&amp;gt;
</pre>
<p> You can find some common media types <a href = "http://en.wikipedia.org/wiki/Internet_media_type">here</a></p>

<p>Still there is a security hole in the above implementation (Version 2). The PHP code checks only the Content-type header which can be easily modified to "image/gif" from a "text/plain". A malicious script can upload a malicious PHP file to the server by changing the Content-type header.</p>

<p>Most of the time we have to upload images to a web server.</p>
<p>To ensure that the uploaded file is an image, the PHP function imageinfo() can be used.</p>

<pre class = "brush:php">
//version 3 : Image file verification

</pre>



</body>
</html>
