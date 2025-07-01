<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'event_id';
    protected $allowedFields = ['title', 'date', 'location', 'description'];
}
