<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ms_target extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'passing' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'servis' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'block' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'smash' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'receive' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'kekuatan' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'kelincahan' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'daya_lentur' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'daya_ledak_otot' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'daya_tahan' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                        'kecepatan' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                        ),
                ));
                $this->dbforge->add_key('blog_id', TRUE);
                $this->dbforge->create_table('ms_target');
        }

        public function down()
        {
                $this->dbforge->drop_table('ms_target');
        }
}
