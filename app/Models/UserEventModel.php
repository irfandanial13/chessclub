<?php

namespace App\Models;

use CodeIgniter\Model;

class UserEventModel extends Model
{
    protected $table = 'user_events';
    protected $allowedFields = ['user_id', 'event_id'];
}
