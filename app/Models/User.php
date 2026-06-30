<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'username',
        'password_hash',
        'email',
        'role',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id', 'id_user');
    }

    public function feedbackResponses()
    {
        return $this->hasMany(FeedbackResponse::class, 'admin_id', 'id_user');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id_user')->orderBy('created_at', 'desc');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPelapor(): bool
    {
        return $this->role === 'pelapor';
    }
}