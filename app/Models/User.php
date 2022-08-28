<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;
   protected $guarded = array();
    protected $with = ['role'];
    public function role()
    {
        return $this->belongsTo('App\Models\Role\Role', 'role_id', 'id');
    }

    public function training()
    {
        return $this->hasMany('App\Models\Training\TrainingResource', 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Membership\UserSubscription', 'user_id', 'id')->orderBy('id', 'DESC')->limit(1);
    }

    public function membership()
    {
        return $this->hasOne('App\Models\Membership\Membership', 'id' , 'membership_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name',
        'email',
        'password',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail(){
        return $this->email_verified_at != null;
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified(){
        return $this->update([
            'email_verified_at' => now(),
            'status' => 'Active'
        ]);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(){
        $this->notify(new VerifyEmail);
    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification(){
        return $this->email;
    }

    /**
     * Get user total earning commission fro other users enrollment
     */
    public function generateTotalEarning(): string {

        $totalEarning = 0;

        if($this->membership && $this->membership->plan_code == \App\Models\Membership\Membership::PREMIUM_MEMBERSHIP_CODE){

            $inCourses = [
                \App\Models\Training\TrainingResource::COURSE_TYPE,
                \App\Models\Training\TrainingResource::VIDEO_TYPE,
                \App\Models\Training\TrainingResource::CERTIFIED_COURSE_TYPE
            ];

            $totalPremiumCoursesOfCreator = \App\Models\Training\TrainingResource::whereIn('type', $inCourses)->where('user_id', $this->id)->get()->pluck('id');

            if(count($totalPremiumCoursesOfCreator)){
                $totalEnrolled = \App\Models\Training\TrainingEnroll::where('user_id', '!=', $this->id)->whereIn('training_id', $totalPremiumCoursesOfCreator)->count();

                $totalPrice = $this->membership->price * $totalEnrolled;

                if($totalPrice > 0){
                    $totalEarning = (10 / 100) * $totalPrice;
                }

            }

        }
        
        return number_format($totalEarning, 2);
    }

    public function getContentTypeDisplay()
    {
        $membership = $this->membership;
        $display = null;

        if($membership){

            switch ($membership->plan_code) {
                case \App\Models\Membership\Membership::CERTIFIED_MEMBERSHIP_CODE:
                    $display = 'C';
                    break;
                case \App\Models\Membership\Membership::PREMIUM_MEMBERSHIP_CODE:
                    $display = 'P';
                    break;
                case \App\Models\Membership\Membership::BASIC_MEMBERSHIP_CODE:
                    $display = 'B';
                    break;
            }

        }

        return $display;

    }



}
