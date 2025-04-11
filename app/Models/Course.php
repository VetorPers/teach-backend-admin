<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $name
 * @property string $period
 * @property float $charge
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Course extends Model
{
    use SoftDeletes;

	protected $table = 'courses';

	protected $casts = [
		'teacher_id' => 'int',
		'charge' => 'float'
	];

	protected $fillable = [
		'teacher_id',
		'name',
		'period',
		'charge',
		'description'
	];
}
