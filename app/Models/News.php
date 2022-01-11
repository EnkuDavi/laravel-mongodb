<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class News extends Eloquent
{
	
	protected $table = 'news';
	use HybridRelations;
	public $timestamps = true;

	protected $fillable = [
		'tipe_berita',
		'judul',
		'status',
		'deskripsi_singkat',
		'deskripsi_berita',
		'gambar',
		'event_id'
	];
}