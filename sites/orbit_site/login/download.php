<?

require_once 'access.class.php';
$user = new flexibleAccess();
if ( $_GET['logout'] == 1 ) 
	$user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	//for ORBIT  $user->is_loaded()
if ( !$user->is_loaded() )
{
	//Login stuff:
	if ( isset($_POST['uname']) && isset($_POST['pwd'])){
	  if ( !$user->login($_POST['uname'],$_POST['pwd'],$_POST['remember'] )){//Mention that we don't have to use addslashes as the class do the job
		require_once("./inc/header.php");
		echo '<div id="loginIncorrect">Wrong username and/or password</div>';
		
	  }else{
	    //user is now loaded
	    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	  }
	}
	require_once("./inc/header.php");
	echo '<div id="login"><h1>Orbit Admin Login</h1>
	<p><form method="post" action="'.$_SERVER['PHP_SELF'].'" />
	 username: <input type="text" name="uname" /><br /><br />
	 password: <input type="password" name="pwd" /><br /><br />
	 <input type="submit" value="login" />
	</form>
	</p>
	</div>';
	//Remember me? <input type="checkbox" name="remember" value="1" /><br /><br />
}else{
	//User is loaded
	require_once("./inc/header.php");  
	echo '<div id="loginInfo">';
	echo 'Welcome ' . $user->get_property('username');
	echo '<br/>';
	echo '<a href="'.$_SERVER['PHP_SELF'].'?logout=1">logout</a></div>';
	echo '<div id=\"adminNav\">
	      <ul>
	      <li><a href=index.php>Home</span></a></li>
	      <li><a href=what.php>What is it?</a></li>
	      <li><a href=download.php><span class="selected">Download</span></a></li>
	      <li><a href=screens.php>Screenshots</a></li>
	      <li><a href=contact.php>Contact Us</a></li>
	      <li><a href=legal.php>Legal Notice</a></li>
	      </ul>
		</div>';
	
	// section 1 of pulling and updating
	
	//require_once("./inc/connect_db.php");
	//require_once 'access.class.php';
	
	$con = mysql_connect("db409391490.db.1and1.com","dbo409391490","camilla11");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("db409391490", $con);
	
	
	// section 2
	if ($submit == "update") {
		
		$id = addslashes($id);
		$version = addslashes($version);
		$content1 = addslashes($content1);
		$content2 = addslashes($content2);
		$content3 = addslashes($content3);
		$content4 = addslashes($content4);
		$feature_text = addslashes($feature_text);
		
		mysql_query("UPDATE download
			SET version = '$version',
			content1 = '$content1',
			content2 = '$content2',
			content3 = '$content3',
			content4 = '$content4'
			WHERE id= '1' ");
	}
	
	// section 3
	
	$result = mysql_query("SELECT * FROM download");
	
	while($row = mysql_fetch_array($result))
	{
		$version = $row[1];
		$content1 = $row[2];
		$content2 = $row[3];
		$content3 = $row[4];
		$content4 = $row[5];
	}
		
	
	echo("<form method=\"post\" id=\"contentForm\" action=\"download.php\">
		&nbsp;List Title:<br /><input type=\"text\" size=\"20\" value=\"$version\" name=\"version\" /><br /><br />
		&nbsp;List Item 1:<br /><input type=\"text\" size=\"75\" value=\"$content1\" name=\"content1\" /><br /><br />
		&nbsp;List Item 2:<br /><input type=\"text\" size=\"75\" value=\"$content2\" name=\"content2\" /><br /><br />		
		&nbsp;List Item 3:<br /><input type=\"text\" size=\"75\" value=\"$content3\" name=\"content3\" /><br /><br />
		&nbsp;List Item 4:<br /><input type=\"text\" size=\"75\" value=\"$content4\" name=\"content4\" /><br /><br />
		<input type=\"submit\" name=\"submit\" value=\"update\">
		");
	
	echo("</form>
	");  
}


require_once("./inc/footer.php");

?>

