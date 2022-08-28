<?php

namespace App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class UserVerifyAccounts extends Model

{
    protected $guarded = array();
    protected $table = 'user_verify_accounts';

    public function user() {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

}

?>

