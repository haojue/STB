<?php
$xmlpatch = 'phpindex.xml';
$_id = '1';
$_title = 'title1';
$_content = 'content1';
$_author = 'author1';
$_sendtime = 'time1';
$_htmlpatch = '1.html';

$doc = new DOMDocument('1.0', 'utf-8');
$doc->formatOutput = true;

$root = $doc->createElement('root');

$index = $doc->createElement('index');

$url = $doc->createAttribute('url');
$patch = $doc->createTextNode($_htmlpatch);
$url->appendChild($patch);

$id = $doc->createAttribute('id');
$newsid = $doc->createTextNode($_id);
$id->appendChild($newsid);

$title = $doc->createAttribute('title');
$newstitle = $doc->createTextNode($_title);
$title->appendChild($newstitle);

$content = $doc->createTextNode($_content);

$author = $doc->createAttribute('author');
$newsauthor = $doc->createTextNode($_author);
$author->appendChild($newsauthor);

$sendtime = $doc->createAttribute('time');
$newssendtime = $doc->createTextNode($_sendtime);
$sendtime->appendChild($newssendtime);

$index->appendChild($id);
$index->appendChild($title);
$index->appendChild($content);
$index->appendChild($url);
$index->appendChild($author);
$index->appendChild($sendtime);

$root->appendChild($index);

$doc->appendChild($root);

$doc->save($xmlpatch);

echo $xmlpatch . ' has create success';

?>
