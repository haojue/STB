<?php
$data = <<<XML
<?xml version='1.0'?>
<departs>
<depart>
<name>production support</name>
<employees>
<employee>
<serial_no>100001</serial_no>
<name>Simon</name>
<age>24</age>
<birthday>1982-11-06</birthday>
<salary>5000.00</salary>
<bonus>1000.00</bonus>
</employee>
<employee>
<serial_no>100002</serial_no>
<name>Elaine</name>
<age>24</age>
<birthday>1982-01-01</birthday>
<salary>6000.00</salary>
<bonus>2000.00</bonus>
</employee>
</employees>
</depart>
<depart>
<name>testing center</name>
<employees>
<employee>
<serial_no>110001</serial_no>
<name>Helen</name>
<age>23</age>
<birthday>1983-07-21</birthday>
<salary>5000.00</salary>
<bonus>1000.00</bonus>
</employee>
</employees>
</depart>
</departs>
XML;
$xml = simplexml_load_string($data);
#print_r($xml);
 $depart = $xml->addChild('depart');
 $depart->addChild('name', 'sales');
 $depart->addChild('employees');
 $depart = $xml->depart[2]->employees->addChild('employee');
$newxml = $xml->asXML();
$fp = fopen("newxml.xml", "w"); 
fwrite($fp, $newxml);
fclose($fp);
print_r($xml);
# $character = $xml->book[0]->characters->addChild('character');
# $character->addChild('name', 'Yellow Cat');
#  $character->addChild('desc', 'aloof');

?>