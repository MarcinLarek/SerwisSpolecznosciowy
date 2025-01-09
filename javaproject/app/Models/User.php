<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
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

    protected static function boot()
  {
    parent::boot();

    static::created(function ($user) {
        $user->profile()->create([
            'title' => $user->username,
        ]);

        //Mail::to($user->email)->send(new NewUserWelcomeMail());
    });

  }

  public function posts()
  {
      return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
  }

  public function following()
  {
      return $this->belongsToMany(Profile::class);
  }

  public function profile()
  {
      return $this->hasOne(Profile::class);
  }
}
