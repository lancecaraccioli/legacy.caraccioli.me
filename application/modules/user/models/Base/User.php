<?php
abstract class User_Model_Base_User extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->setTableName('user');
		$this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
		$this->hasColumn('first_name', 'string', 255, array('type' => 'string', 'length' => 255, 'default' => '', 'notnull' => true));
		$this->hasColumn('last_name', 'string', 255, array('type' => 'string', 'length' => 255, 'default' => '', 'notnull' => true));
		$this->hasColumn('email', 'string', 255, array('type' => 'string', 'length' => 255, 'default' => '', 'notnull' => true));
		$this->hasColumn('password', 'string', 255, array('type' => 'string', 'length' => 255, 'default' => '', 'notnull' => true));
		$this->hasColumn('password_plaintext', 'string', 255, array('type' => 'string', 'length' => 255, 'default' => '', 'notnull' => true));
	}

  public function setUp(){
	    $this->actAs('Timestampable');
	    $this->actAs('SoftDelete');
	}

}
