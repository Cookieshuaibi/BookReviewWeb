<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }
}