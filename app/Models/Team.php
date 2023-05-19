<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Exception;

class Team extends Model
{
    use HasFactory;

    protected array $members = [];

    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        $this->guardAgainstTooManyMembers();

        $method = $users instanceof User ? 'save' : 'saveMany';
        $this->members()->$method($users);
    }


    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
       return $this->members()->count();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function guardAgainstTooManyMembers(): void
    {
        if ($this->count() >= $this->size)
        {
            throw new Exception();
        }
    }

    public function remove($users = null)
    {
        if($users instanceof  User){
            return $users->leaveTeam();
        }
        return $this->removeMany($users);
    }

    public function removeMany($users)
    {
        $userIds = $users->pluck('id');
        $this->members()->whereIn('id', $userIds)->update(['team_id' => null]);
    }

    public function restart()
    {
        return $this->members()->update(['team_id' => null]);
    }
}
