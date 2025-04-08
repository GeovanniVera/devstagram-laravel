<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'username',
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

    /**
     * Relaciones 
     */


    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }
    /**
     * Post Methods
     */
    
    public function postsCount(){
        return $this->posts()->count();
    }

    /**
     * Followers Methods
     */
    

    public function followersCount(){
        return $this->followers()->count();
    }

    public function checkFollower(User $user){
        return $this->followers->contains($user->id);
    }

    public function followingsCount(){
        return $this->followings()->count();
    }
    
    public function checkFollowing(User $user){
        return $this->followings->contains($user->id);
    }
    
}
