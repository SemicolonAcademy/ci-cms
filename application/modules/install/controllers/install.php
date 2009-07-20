<?php 

class Install extends Controller 
{
	function Install()
	{
		parent::Controller();
		$this->load->database();
	}
	
	function index()
	{
		echo "<p>You are about to install CI-CMS</p>";
		echo "<p>Before you continue, <ol><li>check that you have a file database.php in your configuration folder and all values are ok.</li><li>make writable the <b>media</b> folder</li></p>";
		echo "<p>If you get a database error in the next step then your database.php file is not ok</p>";
		echo "<p>" . anchor('install/step1', 'Click here to continue') . "</p>";

	}
	
	function step1()
	{
		$folders = array(
			'./media/images', 
			'./media/images/o', 
			'./media/images/m', 
			'./media/images/s',
			'./media/files',
			'./media/captcha'
		);
		
		foreach ($folders as $f)
		{
			if( @mkdir($f))
			{
				echo "Folder $f created<br />";
			}
			else
			{
				echo "<span style='color: red'>ERROR: folder $f not created.</span> Please create it manually.<br />";
			}
		}
			
		echo "<p>" . anchor('install/step2', 'Click here to continue') . "</p>";
		
	}
	
	
	function step2()
	{
	
		$this->load->dbforge();	

		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'code' => array(
				'type' => 'CHAR',
				'constraint' => 5
			 ),
			'name' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '100',
					 'default' => ''
			  ),
			 'ordering' => array(
				'type' => 'INT',
				'constraint' => 5,
				'default' => 0
			 ),
			'active' => array(
					 'type' => 'TINYINT',
					 'constraint' => '1',
					'default' => 1
			  ),
			'default' => array(
					 'type' => 'TINYINT',
					 'constraint' => '2',
					'default' => 0
			  )
		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('code');
		$this->dbforge->create_table('languages', TRUE);
		
		$data = array('code' => 'en', 'name' => 'English');
		$this->db->insert('languages', $data);
		$data = array('code' => 'it', 'name' => 'Italiano');
		$this->db->insert('languages', $data);
		$data = array('code' => 'fr', 'name' => 'Fran�ais');
		$this->db->insert('languages', $data);
		$data = array('code' => 'mg', 'name' => 'Malagasy');
		$this->db->insert('languages', $data);
		
		

  
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
			 ),
			'active' => array(
					 'type' => 'TINYINT',
					 'constraint' => '1',
					'default' => 1
			  ),
			'weight' => array(
					 'type' => 'INT',
					 'constraint' => '3',
					'default' => 0
			  ),
			'title' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'uri' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'lang' => array(
					 'type' => 'CHAR',
					 'constraint' => '5',
			  )
		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('active');
		$this->dbforge->add_key('weight');
		$this->dbforge->add_key('parent_id');
		$this->dbforge->create_table('navigation', TRUE);
		
		$data = array('id' => 19, 'parent_id' => 0, 'title' => 'leftmenu', 'uri' => '', 'lang' => 'en');
		$this->db->insert('navigation', $data);

		$data = array('id' => 1, 'parent_id' => 19, 'title' => 'Menu', 'uri' => '', 'lang' => 'en');
		$this->db->insert('navigation', $data);

		$data = array('id' => 2, 'parent_id' => 1, 'title' => 'Home', 'uri' => 'home', 'lang' => 'en');
		$this->db->insert('navigation', $data);

		$data = array('id' => 3, 'parent_id' => 1, 'title' => 'About', 'uri' => 'about', 'lang' => 'en');
		$this->db->insert('navigation', $data);

		$data = array('id' => 20, 'parent_id' => 0, 'title' => 'leftmenu', 'uri' => '', 'lang' => 'fr');
		$this->db->insert('navigation', $data);
		$data = array('id' => 4, 'parent_id' => 20, 'title' => 'Menu', 'uri' => '', 'lang' => 'fr');
		$this->db->insert('navigation', $data);

		$data = array('id' => 5, 'parent_id' => 4, 'title' => 'Accueil', 'uri' => 'accueil', 'lang' => 'fr');
		$this->db->insert('navigation', $data);

		$data = array('id' => 6, 'parent_id' => 4, 'title' => 'A propos', 'uri' => 'a-propos', 'lang' => 'fr');
		$this->db->insert('navigation', $data);

		$data = array('id' => 21, 'parent_id' => 0, 'title' => 'leftmenu', 'uri' => '', 'lang' => 'it');
		$this->db->insert('navigation', $data);
		$data = array('id' => 7, 'parent_id' => 21, 'title' => 'Menu', 'uri' => '', 'lang' => 'it');
		$this->db->insert('navigation', $data);

		$data = array('id' => 8, 'parent_id' => 7, 'title' => 'Home', 'uri' => 'home', 'lang' => 'it');
		$this->db->insert('navigation', $data);

		$data = array('id' => 9, 'parent_id' => 7, 'title' => 'About', 'uri' => 'about', 'lang' => 'it');
		$this->db->insert('navigation', $data);

		$data = array('id' => 10, 'parent_id' => 0, 'title' => 'topmenu', 'uri' => '', 'lang' => 'en');
		$this->db->insert('navigation', $data);
		$data = array('id' => 11, 'parent_id' => 10, 'title' => 'Contact us', 'uri' => 'contact-us', 'lang' => 'en');
		$this->db->insert('navigation', $data);
		$data = array('id' => 12, 'parent_id' => 10, 'title' => 'Google', 'uri' => 'http://google.com', 'lang' => 'en');
		$this->db->insert('navigation', $data);
		
		$data = array('id' => 13, 'parent_id' => 0, 'title' => 'topmenu', 'uri' => '', 'lang' => 'fr');
		$this->db->insert('navigation', $data);
		$data = array('id' => 14, 'parent_id' => 13, 'title' => 'Contact us', 'uri' => 'contact-us', 'lang' => 'fr');
		$this->db->insert('navigation', $data);
		$data = array('id' => 15, 'parent_id' => 13, 'title' => 'Google', 'uri' => 'http://google.com', 'lang' => 'fr');
		$this->db->insert('navigation', $data);
		
		$data = array('id' => 16, 'parent_id' => 0, 'title' => 'topmenu', 'uri' => '', 'lang' => 'it');
		$this->db->insert('navigation', $data);
		$data = array('id' => 17, 'parent_id' => 16, 'title' => 'Contact us', 'uri' => 'contact-us', 'lang' => 'it');
		$this->db->insert('navigation', $data);
		$data = array('id' => 18, 'parent_id' => 16, 'title' => 'Google', 'uri' => 'http://google.com', 'lang' => 'it');
		$this->db->insert('navigation', $data);
		
		
		
		echo "<p>Step 2 completed. " . anchor('install/step3', 'Click here to continue') . "</p>";

	
	}
	
	function step3()
	{
		$this->load->dbforge();	
	
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
			 ),
			'active' => array(
					 'type' => 'TINYINT',
					 'constraint' => '1',
					'default' => 1
			  ),
			'weight' => array(
					 'type' => 'INT',
					 'constraint' => '3',
					'default' => 0
			  ),
			'title' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'uri' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'lang' => array(
					 'type' => 'CHAR',
					 'constraint' => '5',
					 'default' => 'en'
			  ),
			'meta_keywords' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'meta_description' => array(
					 'type' => 'TEXT',
					 'null' => true
			  ),
			'body' => array(
					 'type' => 'TEXT',
					 'null' => true
			  ),
			'hit' => array(
					 'type' => 'INT',
					 'constraint' => '11',
					'default' => 0
			  ),
			'options' => array(
					 'type' => 'TEXT',
					 'null' => true
			  ),
			'email' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			 'date' => array(
					 'type' => 'INT',
					 'constraint' => '11',
					 'default' => mktime()
			  )

		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('uri');
		$this->dbforge->add_key('active');
		$this->dbforge->create_table('pages', TRUE);


		$data = array('title' => 'This is just a test', 'uri' => 'home', 'lang' => 'en', 'body' => '<p>This is how it looks in <b>English</b>. To modify this text go to  <i>admin/pages</i>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);
		$data = array('title' => 'About page', 'uri' => 'about', 'lang' => 'en', 'body' => '<p>About this site..</p>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);

		$data = array('title' => 'This is just a test', 'uri' => 'home', 'lang' => 'fr', 'body' => '<p>This is how it looks in <b>French</b>. To modify this text go to  <i>admin/pages</i>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);
		$data = array('title' => 'About page', 'uri' => 'about', 'lang' => 'fr', 'body' => '<p>About this site..</p>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);

		$data = array('title' => 'This is just a test', 'uri' => 'home', 'lang' => 'it', 'body' => '<p>This is how it looks in <b>Italian</b>. To modify this text go to  <i>admin/pages</i>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);
		$data = array('title' => 'About page', 'uri' => 'about', 'lang' => 'it', 'body' => '<p>About this site..</p>', 'options' => 'a:4:{s:13:"show_subpages";s:1:"1";s:15:"show_navigation";s:1:"1";s:14:"allow_comments";s:1:"0";s:6:"notify";s:1:"0";}');
		$this->db->insert('pages', $data);
		

		//page comments
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'page_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
			 ),
			'status' => array(
					 'type' => 'TINYINT',
					 'constraint' => '1',
					'default' => 1
			  ),
			'weight' => array(
					 'type' => 'INT',
					 'constraint' => '3',
					'default' => 0
			  ),
			'author' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'website' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'website' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'body' => array(
					 'type' => 'TEXT',
					 'null' => true
			  ),
			'email' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			'ip' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '255',
					 'default' => ''
			  ),
			 'date' => array(
					 'type' => 'INT',
					 'constraint' => '11',
					 'default' => mktime()
			  )

		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('page_id');
		$this->dbforge->add_key('date');
		$this->dbforge->create_table('page_comments', TRUE);		
		
		
  		$fields = array(
			'session_id' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 40,
					 'default' => '0'
			  ),
			 'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 16,
				'default' => '0'
			 ),
			'user_agent' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 50,
					 'default' => ''
			  ),
			'last_activity' => array(
					 'type' => 'INT',
					 'constraint' => '10',
					'default' => 0
			  ),
			'user_data' => array(
					 'type' => 'TEXT'
			  ),
		);
		
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('session_id', TRUE);
		$this->dbforge->create_table('sessions', TRUE);

		echo "<p>Step 3 completed. " . anchor('install/step4', 'Click here to continue') . "</p>";
	
	}
	
	function step4()
	{
		$this->load->dbforge();	
		//settings
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => '0'
			 ),
			 'value' => array(
				'type' => 'TEXT',
				'default' => ''
			 )
		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('name');
		$this->dbforge->create_table('settings', TRUE);
		
		$data = array('name' => 'site_name', 'value' => 'CI-CMS');
		$this->db->insert('settings', $data);
		
		$data = array('name' => 'meta_keywords', 'value' => 'CI-CMS');
		$this->db->insert('settings', $data);
		$data = array('name' => 'meta_description', 'value' => 'CI-CMS, another content managment system');
		$this->db->insert('settings', $data);
		$data = array('name' => 'cache', 'value' => '0');
		$this->db->insert('settings', $data);
		$data = array('name' => 'cache_time', 'value' => '300');
		$this->db->insert('settings', $data);
		$data = array('name' => 'theme', 'value' => 'default');
		$this->db->insert('settings', $data);
		$data = array('name' => 'template', 'value' => 'index');
		$this->db->insert('settings', $data);
		$data = array('name' => 'page_home', 'value' => 'home');
		$this->db->insert('settings', $data);
		$data = array('name' => 'debug', 'value' => '0');
		$this->db->insert('settings', $data);
		$data = array('name' => 'version', 'value' => '0.9.0.0');
		$this->db->insert('settings', $data);
		$data = array('name' => 'page_approve_comments', 'value' => '1');
		$this->db->insert('settings', $data);
		$data = array('name' => 'page_notify_admin', 'value' => '1');
		$this->db->insert('settings', $data);
		$data = array('name' => 'news_settings', 'value' => serialize(array('allow_comments' => 1,'approve_comments' => 1)));
		$this->db->insert('settings', $data);
		

		//users
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'default' => ''
			 ),
			 'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'default' => ''
			 ),
			 'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => ''
			 ),
			 'status' => array(
				'type' => 'VARCHAR',
				'constraint' => 10,
				'default' => 'active'
			),
			 'lastvisit' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
			),
			 'registered' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
			),
			 'activation' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => ''
			 )
		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('username');
		$this->dbforge->add_key('status');
		$this->dbforge->create_table('users', TRUE);
		
		//modules
  		$fields = array(
			'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'unsigned' => TRUE,
					 'auto_increment' => TRUE
			  ),
			 'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'default' => ''
			 ),
			 'with_admin' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 0
			),
			 'version' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'default' => ''
			 ),
			 'status' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 0
			),
			 'ordering' => array(
				'type' => 'INT',
				'constraint' => 4,
				'default' => 0
			),
			 'info' => array(
				'type' => 'TEXT'
				),
			 'description' => array(
				'type' => 'TEXT'
			)
		);
		$this->dbforge->add_field($fields); 
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('name');
		$this->dbforge->create_table('modules', TRUE);
		
		$this->db->query("INSERT INTO " . $this->db->dbprefix('modules') . " (id, name, with_admin, version, status, ordering, info, description) VALUES (1, 'admin', 0, '1.0.1', 1, 5, '', 'Admin core module'), (2, 'module', 0, '1.0.0', 1, 20, '', 'Module core module'), (3, 'page', 1, '1.0.3', 1, 60, '', 'Page core module'), (4, 'language', 1, '1.0.0', 1, 10, '', 'Language core module'), (5, 'member', 1, '1.0.0', 1, 30, '', 'Member core module'), (6, 'search', 0, '1.0.0', 1, 50, '', 'Search core module'), (7, 'news', 1, '1.1.0', 1, 101, '', 'News module')");
		

		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('admins' ) . " ( `id` int(11) NOT NULL auto_increment, `username` varchar(100) NOT NULL default '', `module` varchar(100) NOT NULL default '', `level` tinyint(4) NOT NULL default '0', PRIMARY KEY (`id`), KEY `username` (`username`) ) ");

		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('group_members') . " ( id int(11) NOT NULL auto_increment, g_user varchar(255) NOT NULL default '', g_id varchar(20) NOT NULL default '', g_from int(11) NOT NULL default '0', g_to int(11) NOT NULL default '0', g_date int(11) NOT NULL default '0', PRIMARY KEY (id), KEY g_user (g_user,g_id) )");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('groups') . " ( id int(11) NOT NULL auto_increment, g_id varchar(20) NOT NULL default '', g_name varchar(255) NOT NULL default '', g_desc text NOT NULL, g_date int(11) NOT NULL default '0', g_info text NOT NULL, PRIMARY KEY (id), UNIQUE KEY g_id (g_id,g_name) )");
		
		$this->db->query("INSERT INTO " . $this->db->dbprefix('groups') . " (g_id, g_name, g_desc) VALUES ('0', 'Everybody', 'This is everybody who visits the site including non members')");

		$this->db->query("INSERT INTO " . $this->db->dbprefix('groups') . " (g_id, g_name, g_desc) VALUES ('1', 'Members Only', 'This is everybody who is member of the site')");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('search_results') . " ( id int(11) NOT NULL auto_increment, s_rows text NOT NULL, s_tosearch varchar(255) NOT NULL default '', s_date int(11) NOT NULL default '0', PRIMARY KEY (id) )");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('images') . " ( `id` int(11) NOT NULL auto_increment, `module` varchar(100) NOT NULL default '', `file` varchar(255) NOT NULL default '', `src_id` int(11) NOT NULL default '0', `ordering` tinyint(4) NOT NULL default '0', `info` text NOT NULL, PRIMARY KEY (`id`) )") ;
		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('captcha') . " (	captcha_id bigint( 13 ) unsigned NOT NULL AUTO_INCREMENT , 	captcha_time int( 10 ) unsigned NOT NULL , 	ip_address varchar( 16 ) default '0' NOT NULL , 	word varchar( 20 ) NOT NULL , 	PRIMARY KEY ( captcha_id ) , 	KEY ( word ) )");
 		
		echo "<p>Step 4 completed. " . anchor('install/step5', 'Click here to continue') . "</p>";
		
	}
	
	function step5()
	{
		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('news') . " ( `id` INT NOT NULL AUTO_INCREMENT , `cat` INT NOT NULL DEFAULT '0', `title` VARCHAR( 255 ) NOT NULL , `uri` VARCHAR( 255 ) NOT NULL , `lang` VARCHAR( 255 ) NOT NULL , `body` TEXT NOT NULL , `allow_comments` tinyint(1) NOT NULL DEFAULT '1', `comments` int(4) NOT NULL, `status` INT(3) NOT NULL DEFAULT '0', `date` INT NOT NULL , `author`VARCHAR( 255 ) NOT NULL , `email` VARCHAR( 255 ) NOT NULL , `notify` TINYINT NOT NULL , `hit` INT(11) NOT NULL DEFAULT '0', `ordering` INT(11) NOT NULL DEFAULT '0', PRIMARY KEY ( `id` ) , INDEX ( `title` ) )"); 

		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('news_comments') . " (   `id` int(11) NOT NULL auto_increment,   `news_id` int(11) NOT NULL,   `status` int(2) NOT NULL DEFAULT '0',   `date` int(11) NOT NULL,   `author` varchar(50) NOT NULL,   `email` varchar(100) NOT NULL,   `website` varchar(150) NOT NULL,   `body` text NOT NULL,   `ip` varchar(150) NOT NULL,     PRIMARY KEY  (`id`),   KEY `news_id` (`news_id`),   KEY `date` (`date`),   KEY `status` (`status`) )");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('captcha') . " ( captcha_id bigint( 13 ) unsigned NOT NULL AUTO_INCREMENT , captcha_time int( 10 ) unsigned NOT NULL , ip_address varchar( 16 ) default '0' NOT NULL , word varchar( 20 ) NOT NULL , PRIMARY KEY ( captcha_id ) , KEY ( word ) )");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . $this->db->dbprefix('news_cat') . "  ( `id` int(11) NOT NULL auto_increment, `pid` int(11) NOT NULL default '0', `title` varchar(255) NOT NULL default '', `icon` varchar(255) NOT NULL default '', `desc` text NOT NULL, `date` int(11) NOT NULL default '0', `username` varchar(20) NOT NULL default '', `lang` char(5) NOT NULL default '', `weight` int(11) NOT NULL default '0', `status` int(5) NOT NULL default '1', `acces` varchar(20) NOT NULL default '0', PRIMARY KEY  (`id`), KEY `title` (`title`) )");
		
		$data = array('title' => 'Your first news', 'uri' => 'your-first-news-en', 'lang' => 'en', 'body' => 'This news is supposed to be in English but I leave it in English now', 'status' => 1, 'date' => mktime());
		$this->db->insert('news', $data);
		$data = array('title' => 'Your first news', 'uri' => 'your-first-news-fr', 'lang' => 'fr', 'body' => 'This news is supposed to be in French but I leave it in English now', 'status' => 1, 'date' => mktime());
		$this->db->insert('news', $data);
		$data = array('title' => 'Your first news', 'uri' => 'your-first-news-it', 'lang' => 'it', 'body' => 'This news is supposed to be in Italian but I leave it in English now', 'status' => 1, 'date' => mktime());
		$this->db->insert('news', $data);

		echo "<p>Step 5 completed. " . anchor('install/step6', 'Click here to continue') . "</p>";
		
	}
	
	function step6()
	{
		echo "Installation done. <br />To go to admin interface ". anchor('admin', 'click here') . "<br/>Now you can visit your site " . anchor('', 'here') ;

	}


}