<?php
use Carbon\Carbon;
use \Mailjet\Resources;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

if(!function_exists('uploadToDiskStorage')){
    function uploadToDiskStorage( $fileObject, array $disk, $oldFile = null ){
        $filename = time(). '-' . sha1(time()) . '.' . $fileObject->getClientOriginalExtension();
        $uploaded = Storage::disk($disk['name'])->putFileAs('', $fileObject, $filename);

        if($uploaded){
            // check old file and remove
            if($oldFile && file_exists(public_path($oldFile))){
                @unlink(public_path($oldFile));
            }

            return $disk['base_path'] . $uploaded;
        }

        return null;

    }
}


if(!function_exists('send_email')){
    function send_email($to_email,$subject,$template,$data){
        Mail::send($template, ['data'=>$data], function($message) use ($subject, $to_email) {
            $message->to($to_email,$subject)->subject($subject);
            $message->from(env('MAIL_FROM_ADDRESS'),$subject);
        });
    }
}

if(!function_exists('format_date')){
    function format_date($date)
    {
        if(empty($date) or $date=='0000-00-00' or $date==null or $date=='1899-12-30' or $date == '01-01-1970'){
            return '';
        }
        else if($date=='-' or $date=='--'){
            return $date;
        }
        else{
            $timestamp = strtotime($date);
            return date('m-d-Y', $timestamp);
        }
    }
}
if(!function_exists('db_format_date')){
    function db_format_date($date)
    {
        if(empty($date)){
            return null;
        }
        else{
            $timestamp = strtotime($date);
            return date('Y-m-d', $timestamp);
        }
    }
}


if(!function_exists('check_attachment')){
    function check_attachment($type,$customer_id){
        $data=\App\Models\Customer\Attachment::where('type',$type)->where('customer_id',$customer_id)->first();
        return $data;
    }
}



if(!function_exists('set_message')){
    function set_message($affected_rows,$module,$action){
      if($affected_rows) {
            $message['title']= 'Success';
            $message['text'] = $module." Information ".$action." Successfully";
        }
        else {
            $message['title']= 'Error';
            $message['text'] = "Something went wrong";
            }
            return $message;
    }
}
if(!function_exists('userdp')){
    function userdp($avatar){
        if(File::exists(public_path().'/uploads/users/dp/'.$avatar) && $avatar){
            $dp=url('/').'/public/uploads/users/dp/'.$avatar;
        }
        else{
            $dp=url('public/uploads/users/dp/user4.jpg');
        }
        return $dp;
    }
}


if(!function_exists('check_file')){
    function check_file($path){

        foreach (['http://', 'https://', 'www.'] as $value) {
            if(str_contains($path, $value)){
                return $path;
            }
        }

        if (File::exists(public_path($path)) && !empty($path)) {
            return $path;
        }else{
            return '/images/notfound.png';
        }
                
    }
}



?>
