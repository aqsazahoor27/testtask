<?php

namespace App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $guarded = array();
    protected $table = 'portal_settings';

    public const USERS_DP_DISK = [
        'name' => 'users_dp',
        'base_path' => '/storage/users/dp/',
    ];
    
    public const USERS_COVER_DISK = [
        'name' => 'users_cover',
        'base_path' => '/storage/users/cover/',
    ];

    public const TRAINING_DISK = [
        'name' => 'trainings',
        'base_path' => '/storage/trainings/',
    ];

    public const LESSON_DISK = [
        'name' => 'lessons',
        'base_path' => '/storage/lessons/',
    ];

    public const SETTING_DISK = [
        'name' => 'settings',
        'base_path' => '/storage/settings/',
    ];
    public const GALLERY_DISK = [
        'name' => 'gallery',
        'base_path' => '/storage/gallery/',
    ];
    public const DISK_COLLECTION = [
        '-uploads-users-dp' => self::USERS_DP_DISK,
        '-uploads-users-cover' => self::USERS_COVER_DISK,
        '-uploads-tutorials' => self::TRAINING_DISK,
        '-uploads-gallery' => self::GALLERY_DISK,
        '-uploads-pages' => self::LESSON_DISK
    ];


}

?>

