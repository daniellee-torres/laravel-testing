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

    public function add($user)
    {
        $this->guardAgainstTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';
        $this->members()->$method($user);
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

    /**
     * @test
     */
    public function a_team_can_remove_a_member()
    {



    }

    /**
     * @test
     */
    public function a_team_can_remove_all_members_at_once()
    {

    }


}
