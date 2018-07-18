<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tb_formasi extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'id_nilai' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'flag_untuk' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('tb_formasi');
        }

        public function down()
        {
                $this->dbforge->drop_table('tb_prefrensi');
        }
}
