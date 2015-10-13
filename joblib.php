<?php
function search_job($id) {
  $doc = new DOMDocument();
  $files = array("job.xml", "finishedjob.xml");
  foreach ( $files as $file) {
  $doc->load( $file );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $gid =  $job->getAttribute("id");
  if($gid == $id) {
  $serverip =  $job->getAttribute("serverip");
  $params = $job->getAttribute( "params" );
  $processid = $job->getAttribute( "processid" );
  return $serverip. "," . $params . "," . $processid;
  }
  }
  }
}

function search_dev_by_id($id) {
  $doc = new DOMDocument();
  $files = array("job.xml", "finishedjob.xml");
  foreach ( $files as $file) {
  $doc->load( $file );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $gid =  $job->getAttribute("id");
  if($gid == $id) {
  $device =  $job->getAttribute("dev");
  return $device;
  }
  }
  }
}


function check_dut_status($device) {
  $doc = new DOMDocument();
  $doc->load( 'dev.xml' );

  $devs = $doc->getElementsByTagName( "dev" );
  foreach( $devs as $dev )
  {
    $dut =  $dev->getAttribute("name");
    if ($device == $dut) {
        $status = $dev->getAttribute("inuse");
        break;
    }
  }
  return $status;
}

function find_cmd_by_jobid($id) {
  $doc = new DOMDocument();
  $files = array("job.xml", "finishedjob.xml");
  foreach ( $files as $file) {
  $doc->load( $file );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $gid =  $job->getAttribute("id");
  if($gid == $id) {
  $cmd = $job->getAttribute( "cmd" );
  return $cmd;
  }
  }
  }
}

function find_des_by_id($id) {
  $doc = new DOMDocument();
  $files = array("config.xml");
  foreach ( $files as $file) {
  $doc->load( $file );

  $items = $doc->getElementsByTagName( "config" );
  foreach( $items as $item )
  {
  $gid =  $item->getAttribute("id");
  if($gid == $id) {
  $des = $item->getAttribute( "des" );
  return $des;
  }
  }
  }
}

?>
