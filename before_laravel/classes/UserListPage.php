<?php
require_once(SQL_LIB_URL);
class UserListPage extends Page
{
	protected $search;
	function __construct()
	{
		parent::__construct(null);
		$this->set('title','User List');
		
		//$extFiles['stylesheet']=array(css1,css2);
		//$extFiles['javascript']=array(js1,js2);
		//parent::__construct($extFiles);
	}
	function echoPageBody()
	{
		
		echo "<p>This is the " . $this->get('title') . " page </p>";
		$this->searchTypeHandler();
		$this->echoUserList();
	}
	
	function searchTypeHandler()
	{
		$this->search="All";
		if (isset($_GET['htype']))
		{
			$this->search=$_GET['htype'];
		}
	}
	
	function echoUserList()
	{
		$result=queryDisplayUsers($this->search);
		echo '
		<ul id="userList">';
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			echo '
			<li><a href ="' . VIEW_PROFILE_URL . '?username=' . $row['username'] . '">' . htmlspecialchars($row['username']) . '</a></li>';
		}
		echo "</ul>";
		
	}
}

?>