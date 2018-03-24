<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tb_prefrensi extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'hasil_pref' => array(
                                'type' => 'DOUBLE',
                        ),
                        'flag_untuk' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('tb_prefrensi');
        }

        public function down()
        {
                $this->dbforge->drop_table('tb_prefrensi');
        }
}
