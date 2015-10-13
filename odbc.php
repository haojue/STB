function HR_OpenConn( )
{
	global $hrconn;
	global $HR_DSN;
	global $HR_USER;
	global $HR_PASS;		
	if ( !$hrconn )
	{
			if ( !function_exists( "odbc_pconnect" ) )
			{
					echo "PHP error£¬can't invoke ODBC";
					exit( );
			}
			$C = @odbc_pconnect( $HR_DSN,$HR_USER,$HR_PASS);
	}
	else
	{
			$C = $hrconn;
	}	
	if ( (!$C) or ($C==0) )
	{
			echo "can't connect to HR database";
			exit( );
	}	
	return $C;
}

function hrquery($c,$sqlstr)
{
	$query=odbc_exec($c,$sqlstr);
	if (!$query)
	{
		echo "Exec SQL error<br> $sqlstr ";
		exit();
	}
	$cursor=odbc_fetch_array($query);
	return $cursor;
}

include_once( "inc/odbc_conf.php" );
if ( !$hrconn )
{
	$hrconn = HR_OpenConn( );
}
