<?php 

namespace App\Helpers;
use Mail;
use Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
class CustomHelper
{
   public static function saveImageData($image)
   {      
      $imageFileName = time().'.' .$image->getClientOriginalExtension();
      $s3 = \Storage::disk('s3');
      $s3->put($imageFileName, file_get_contents($image),'public');
      $profilePic = 'https://s3-ap- southeast-1.amazonaws.com/med-aws/'.$imageFileName;
   }

   public static function getDays()
   {      
      $days=array( 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday' );
      return $days;
   } 

    public static function getMonths()
    {      
        $months=array( 1 => 'January', 2 => 'February', 3 => 'March',4 => 'April ', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December' );
        return $months;
    } 
   
    public static function getOpenDays($day)
    {
        $days=self::getDays();
        $selectedDays=explode(',',$day);
        $res="";
        if($day !="")
        {       
            foreach($selectedDays as $kry=>$value)
            {
                if($res=="")
                {
                    $res=$days[$value];
                }
                else
                {
                    $res=$res.', '.$days[$value];
                }
            }     
        }   

        return $res;
    } 

    public static function getSeasonMonths($month)
    {
        $months=self::getMonths();
        $selectedMonths=explode(',',$month);
        $res="";
        if($month !="")
        {
            foreach($selectedMonths as $kry=>$value)
            {
                if($res=="")
                {
                    $res=$months[$value];
                }
                else
                {
                    $res=$res.', '.$months[$value];
                }
            }    
        }    

        return $res;
    }
   

   public static function saveImageOnCloudanary($images)
   {      
      $imageName = time().'.'.$images->getClientOriginalExtension();
      $t = Storage::disk('s3')->put($imageName, file_get_contents($images));
      $imageName = Storage::disk('s3')->url($imageName);
      return $imageName;
   }	
   
   public static function getUnreadNotifications($phar_id)
   {
      $unreadNotifications=PharmacyNotifications::where('phar_id',$phar_id)->where('is_read','0')->orderBy('created_at','desc')->get();
      return $unreadNotifications;
   }


   public static function sendAndroidPush($deviceToken, $msg, $badge = 1, $pushType = '',$order_id,$notification_id) 
   {
      if (is_array($deviceToken)) 
      {
         $registrationIDs = $deviceToken;
      } 
      else
      {
         $registrationIDs = array($deviceToken);
      }
      
      $id = rand(1, 100);
       //$url = 'https://android.googleapis.com/gcm/send';
      $url = 'https://fcm.googleapis.com/fcm/send';
      $fields = array(
         'registration_ids' => $registrationIDs,
         'data' => array(
            "message" => $msg,
            "pushType"=>$pushType,
            "orderId"=>$order_id,
            "notificationId"=>$notification_id,
         ),
      );

      $headers = array(
         'Authorization: key=AIzaSyB-4RDT7ZuCUw2xP2H-sBz6j-7kfSzoR5Q',
         'Content-Type: application/json'
      );
       //Open connection
       $ch = curl_init();

       //Set the url, number of POST vars, POST data
       curl_setopt($ch, CURLOPT_URL, $url);

       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

       //Execute post
       $result = curl_exec($ch);

       curl_close($ch);

       // echo "<pre>";
       // print_r($result);
       // echo "</pre>";
       // die;
   }

   public static function sendIphonePush($deviceToken, $message, $badge = 1, $pushType = '',$order_id,$notification_id) 
   {
      $apnsHost = 'gateway.sandbox.push.apple.com'; //developement	
      //$apnsHost = 'gateway.push.apple.com'; //production
      $apnsPort = '2195';
      $apnsCert = '/var/www/html/med-me-QA/PushCertMedDEV.pem';
      $passPhrase = '';
      $streamContext = stream_context_create();
      stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
      $apnsConnection = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
      $payload['aps'] = array("alert" => $message, 'badge' => (int) $badge, "push_type" => $pushType,'orderId'=>$order_id,"notificationId"=>$notification_id);
      $payload = json_encode($payload);

      try 
      {
         if ($message != "") 
         {
            $apnsMessage = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
            if (fwrite($apnsConnection, $apnsMessage)) 
            {
                //echo "true";
            } 
            else
            {
                //echo "false";
            }
         }
      } 
      catch (Exception $e) 
      {
         echo 'Caught exception: ' . $e->getMessage() . "\n";
      }
   }
   
   public static function generatePush($deviceType, $deviceToken, $message, $pushType = '',$order_id,$notification_id) 
   {
      $badge = 0;
      if($deviceType =='1') 
      {
         self::sendAndroidPush($deviceToken, $message, $badge, $pushType,$order_id,$notification_id);
      } 
      else if($deviceType =='2') 
      {
         self::sendIphonePush($deviceToken, $message, $badge, $pushType,$order_id,$notification_id);
      } 
   }
   
   public static function sendMail($template,$data) 
   {
      $mail=Mail::send($template, $data, function($message) use ($data)
      {
         $message->from('jaber5754@gmail.com', "Med-Me");
         $message->subject($data['subject']);
         $message->to($data['email']);
      });
   }
   
}