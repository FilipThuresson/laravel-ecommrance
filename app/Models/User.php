<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function can($ability, $arguments = [])
    {
        if ($this->hasRole('super admin')) {
            return true;
        }
        return parent::can($ability, $arguments);
    }

    public function initials() {
        $ret = '';
        foreach (explode(' ', $this->name) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }

    public function isDeactivated(): bool {
        return $this->deleted_at !== null;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->where('read_at', '=', null);
    }

    public function hasUnreadNotifications() {
        return $this->notifications->where('read_at', null)->count() > 0;
    }

    public function isActive()
    {
        return DB::table('sessions')
            ->where('user_id', $this->id)
            ->where('last_activity', '>=', now()->timestamp - config('session.lifetime') * 60)
            ->exists();
    }

    public function lastActive()
    {
        return DB::table('sessions')
            ->where('user_id', $this->id)
            ->orderBy('last_activity', 'desc')
            ->first();
    }
}
