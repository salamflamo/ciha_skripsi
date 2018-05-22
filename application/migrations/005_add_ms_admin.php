<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ms_admin extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '50',
                        ),
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '50',
                        ),
                        'password' => array(
                                'type' => 'TEXT',
                        ),
                        'session' => array(
                                'type' => 'TEXT',
                        ),
                        'level' => array(
                                'type' => 'INT',
                                'constraint' => '1',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('ms_admin');
        }


        public function down()
        {
                $this->dbforge->drop_table('ms_admin');
        }
}
