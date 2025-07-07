<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPointsToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'points' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'status'
            ],
            'honor_points' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'points'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['points', 'honor_points']);
    }
}
