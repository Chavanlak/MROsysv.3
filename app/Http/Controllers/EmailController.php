<?php

namespace App\Http\Controllers;
use App\Models\FileUpload;
use App\Mail\MultipleGmailSender;
use Illuminate\Http\Request;
// use Mail;
Use App\Mail\MarkMail;
use App\Models\Emailrepair;
use App\Repository\EmailRepairRepository;
use App\Repository\EquipmentRepository;
use App\Repository\EquipmentTypeRepository;
use Illuminate\Support\Facades\Mail;
use App\Repository\NotirepairRepository;
use Illuminate\Support\Facades\Storage;
class EmailController extends Controller
{
    public function sendMultipleGmails()
    {
        $recipientEmail = 'another_email@example.com'; // The email address to send to

        $emailsToSend = [
            [
                'subject' => 'Your First Gmail Subject ',
                'content' => 'This is the content for the first email.',
            ],
            [
                'subject' => 'Your Second Gmail Subject ',
                'content' => 'Here\'s the content for the second email, with more details.',
            ],
            [
                'subject' => 'Third Gmail from Laravel ',
                'content' => 'And this is the last email content example.',
            ],
        ];

        foreach ($emailsToSend as $email) {
            Mail::to($recipientEmail)->send(new MultipleGmailSender($email['content'], $email['subject']));
        }
        // foreach ($emailsToSend as $email) {
        //     Mail::to($recipientEmail)->queue(new MultipleGmailSender($email['content'], $email['subject']));
        // }

        return "Multiple Gmails sent successfully to " . $recipientEmail . "!";
    }
    public static function sendEmailTother() {
        $details =[
        'subject' => 'แจ้งซ่อมอุปกรณ์',
        'body' => 'สวัสดีครับ นี่คือข้อความทดสอบการส่งเมล'
        ];

       Mail::raw($details['body'], function($message) use ($details) {
        $message->to('smartmeow11@gmail.com') // ผู้รับ
                ->subject($details['subject']);
    });

        return "Email sent successfully!";
    }

//     public static function saveNotiRepair(Request $req)
//     {
//     $noti = NotirepairRepository::saveNotiRepair($req->category, $req->detail,$req->zoneMail);

//     $uploadedFiles = [];

//     foreach($req->file('filepic') as $file){
//         $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//         $fileName = $filename."_upload_".date("Y-m-d").".".$file->getClientOriginalExtension();
//         $path = Storage::putFileAs('public/', $file, $fileName);

//         $fileup = new FileUpload();
//         $fileup->filename = $fileName;
//         $fileup->filepath = $path;
//         $fileup->NotirepairId = $noti->NotirepairId;
//         $fileup->save();

//         // เก็บ path ไว้ใช้แนบในอีเมล
//         $uploadedFiles[] = storage_path('app/'.$path);
//     }

//     // ส่งอีเมลพร้อมแนบไฟล์
//     Mail::raw("รายละเอียดการแจ้งซ่อม: ".$req->detail, function($message) use ($uploadedFiles) {
//         $message->to('smartmeow11@gmail.com')
//                 ->subject('แจ้งซ่อมใหม่เข้ามา');

//         foreach ($uploadedFiles as $filePath) {
//             $message->attach($filePath);
//         }
//     });

//     // return redirect('/repair');
//         return "Email sent successfully!";
// }
public function index()
    {
        $data = [
            'title' => 'Example',
            'url' => 'tgirepaircenter@gmail.com'
        ];
       Mail::to("tgirepaircenter@gmail.com")->send(new MarkMail($data));
       dd("Email sent successfully!");
    }
    public static function showEmail(){
        $emails = EmailRepairRepository::getAllEmailRepairs();
        // $equipments = EquipmentRepository::getallEquipment();
        $types = EquipmentTypeRepository::getallEquipmentType();
        $equipments = EquipmentRepository::getAllDataWithTypename();
        return view('dashborad.admin',compact('emails','types','equipments'));
    }
    public static function getEmailByAdmin(Request $request){
        $email = EmailRepairRepository::AddEmailRepair($request->emailRepair);

        if($email) {
            // ✅ ใช้ back() เพื่อกลับไปหน้าฟอร์มเดิม + ส่งข้อความ success
            return back()->with('success', 'บันทึกข้อมูลอีเมลเรียบร้อยแล้ว!');
            
            // หรือถ้าอยากระบุ Route ชัดเจนใช้:
            // return redirect()->route('addemail')->with('success', 'บันทึกข้อมูลอีเมลเรียบร้อยแล้ว!');
        } else {
            return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึก');
        }
      
     
    }
    public static function getEquipmenttypeByAdmin(Request $request){
        $typename = $request->typeName;
        $emailRepairId = $request->emailRepairId;
        // $typename = EquipmentTypeRepository::addEquipmenttype($request->typeName);
        $result = EquipmentTypeRepository::addEquipmenttype($typename,$emailRepairId);
        if($result){
            return back()->with('success','เพิ่มข้อมูลประเภทอุปกรณ์เรียบร้อยเเล้ว');
        }
        else {
            return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึก');
        }
    }
    public static function getEquipmentByAdmin(Request $request){
        $typeId = $request->typeId;
        $equipment = EquipmentRepository::addEquipment($request->equipment,$typeId);
        if ($equipment) {
      
            return back()->with('success', 'เพิ่มอุปกรณ์เรียบร้อยแล้ว');       
        } else {
        
            return back()->with('error', 'เกิดข้อผิดพลาดในการเพิ่มอุปกรณ์');
        }
    }
    public static function removeEquipment($equipmentId){
        EquipmentRepository::deleteEquipment($equipmentId);
        return back()->with('success','ลบข้อมูลเรียบร้อยเเล้ว');
    }
    }
    

