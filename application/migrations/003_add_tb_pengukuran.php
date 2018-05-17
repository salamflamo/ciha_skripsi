<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tb_pengukuran extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama_flag' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'keterangan' => array(
                                'type' => 'TEXT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('tb_pengukuran');
        }

        public function down()
        {
                $this->dbforge->drop_table('tb_pengukuran');
        }
}
