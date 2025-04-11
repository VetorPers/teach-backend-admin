<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Teacher
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string|null $avatar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Teacher extends Model
{
	protected $table = 'teachers';

	protected $fillable = [
		'username',
		'password',
		'name',
		'avatar'
	];
}
