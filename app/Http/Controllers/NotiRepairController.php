<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Repository\MastbranchRepository;
use App\Repository\NotirepairRepository;
use App\Repository\EquipmentRepository;
use App\Repository\EquipmentTypeRepository;
use App\Repository\PermissionBMRepository;
use App\Repository\StatustrackingRepository;

use App\Models\Notirepair;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\EmailCenter;
use App\Mail\NotiMail;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notification;

class NotiRepairController extends Controller
{
    // public static function getallManegers(){
    //     $manegers = NotirepairRepository::getAllNotirepair();
    //     return view('notirepair',compact('manegers'));
    // }
    public static function getallManegers()
    {
        $manegers = NotirepairRepository::getAllNames();
        return view('/branch', compact('manegers'));
    }

    public static function showallManegers()
    {
        $manegers = NotirepairRepository::getAllNotirepair();
        return view('zone', ['manegers' => $manegers]);
    }


    public static function showallZoneEmail()
    {
        $zoneEmail = NotirepairRepository::getSelectZoneEmail();
        return view('zoneemail', compact('zoneEmail'));
    }
    public function handleForm(Request $request)
    {
        $request->validate([
            'branch' => 'required|string',
            'zone' => 'required|string',
            'equipment' => 'required|string',
        ]);

        // เก็บลง session หรือส่งต่อ
        session([
            'selected_branch' => $request->branch,
            'selected_zone' => $request->zone,
            'selected_equipment' => $request->category,
        ]);

        return redirect('repair/form'); // หรือแสดงหน้าถัดไป
    }

    public static function ShowRepairForm()
    {
        $permis = Session::get('permis_BM');
        $manegers = NotirepairRepository::getAllNotirepair();
        $equipmenttype = EquipmentTypeRepository::getallEquipmentType();
        if ($permis == 'N' || $permis == 'n') {
            $branch = MastbranchRepository::selectbranch();
            return view('repair', compact('branch', 'manegers', 'equipmenttype'));
        } else {
            $branchid = PermissionBMRepository::getBranchCode(Session::get('staffcode'));
            $branchname = MastbranchRepository::getBranchName($branchid);
            return view('repairBM', compact('branchid', 'branchname', 'manegers', 'equipmenttype'));
        }
    }
    public function ShowRepairFormBM()
{
    // 1. ดึงข้อมูล User ปัจจุบัน
    $staffcode = Session::get('staffcode');

    // 2. ดึงรหัสสาขาของ BM คนนี้
    $branchid = PermissionBMRepository::getBranchCode($staffcode);
    
    // 3. ดึงชื่อสาขา
    $branchname = MastbranchRepository::getBranchName($branchid);

    // 4. ดึงข้อมูลอื่นๆ ที่ต้องใช้ในหน้าเว็บ (Zone และ หมวดหมู่)
    $manegers = NotirepairRepository::getAllNotirepair(); // เอาไว้เลือก Zone
    $equipmenttype = EquipmentTypeRepository::getallEquipmentType(); // เอาไว้เลือกหมวดหมู่

    // 5. ส่งไปที่ View 'repairBM' (ไฟล์ที่คุณเพิ่งสร้าง)
    return view('repairBM', compact('branchid', 'branchname', 'manegers', 'equipmenttype'));
}

    public static function saveNotiRepair(Request $req)
    {
        $formToken = $req->input('submission_token');
        $sessionToken = Session::get('submission_token');
        if (!$formToken || $formToken !== $sessionToken) {
            return redirect()->back()->with('error', 'ฟอร์มนี้ถูกส่งไปแล้ว กรุณาอย่าส่งซ้ำ');
        }
        $maxSize = 25 * 1024 * 1024;
        $countfiles = count($req->file('filepic'));
        if ($countfiles > 5) {
            return redirect()->back()->with('error', 'อัพโหลดได้ไม่เกิน 5 ไฟล์ กรุณาเลือกไฟล์ใหม่');
        }
        foreach ($req->file('filepic') as $file) {
            if ($file->getSize() > $maxSize) {
                // return response()->json(['error' => 'File size exceeds the 25 MB limit.'], 413);
                return redirect()->back()->with('error', 'ขนาดไฟล์เกิน 25 MB กรุณาเลือกไฟล์ใหม่');
            }
        }
        Session::forget('submission_token');
        $noti = NotirepairRepository::saveNotiRepair($req->category, $req->detail, $req->email2, $req->email1);
        // $uploadedFiles = []; // เก็บ path ของไฟล์ที่จะส่งทางเมล

        // $mimeType = [];
        // $branchEmail = MastbranchRepository::getallBranchEmail();
        foreach ($req->file('filepic') as $file) {
            $file->getClientOriginalName();
            $filename = explode('.', $file->getClientOriginalName());
            $fileName = $filename[0] . "upload" . date("Y-m-d") . "." . $file->getClientOriginalExtension();
            $path = Storage::putFileAs('public/', $file, $fileName);
            $fileup = new FileUpload();
            $fileup->filename = $fileName;
            $fileup->filepath = $path;
            $fileup->NotirepairId = $noti->NotirepairId;
            $fileup->save();
            $realPath = Storage::path($path);
            $imageData = Storage::get($path);

            // $uploadedFiles[] = [
            //     'data' => base64_encode($imageData),
            //     'mime' => str_replace('image/', '', mime_content_type($realPath))
            // ];
        }

        $branchDisplay = $req->branchid . ' ' . $req->branch;

        if ($req->email1 == 'example@mail.com') {

            $data = [

                'title' => 'เเจ้งซ่อมอุปกรณ์',
                // 'img' => $uploadedFiles,
                // 'mime'=>$mimeType,
                'linkmail' => url("picshow/" . $noti->NotirepairId),
                'branch' => 'ไม่มีอีเมลสาขา',
                'branchname' => $branchDisplay,
                // 'branchname'=>$req->branch,
                //branch มาจาก <input type="text" name="branch" value="{{ $branchname }}">
                'name' => $req->session()->get('staffname'),
                // 'branchname'=>$branchname,

                //ใช้อันนี้
                // 'zone'=>$req->zone,
                'zone' => $req->email2,
                //zone มาจาก <input type="text" name="zone" value="{{ $zonename}}"> หน้าrepair2
                'staffname' => $req->zone,
                'equipmentname' => EquipmentRepository::getEquipmentnameByID($req->category)->equipmentName,
                'detail' => $req->detail
            ];
        } else {

            $data = [

                'title' => 'เเจ้งซ่อมอุปกรณ์',
                // 'img' => $uploadedFiles,
                // 'mime'=>$mimeType,
                'linkmail' => url("picshow/" . $noti->NotirepairId),
                // 'branchname'=>$req->branchname,
                // 'emailZone'=>$req->emailZone,
                // 'zonename'=>$req->zonename,
                'branch' => $req->email1,
                // 'branchname'=>$req->branch,
                'branchname' => $branchDisplay,
                //branch มาจาก <input type="text" name="branch" value="{{ $branchname }}">
                'name' => $req->session()->get('staffname'),
                // 'branchname'=>$branchname,

                //ใช้อันนี้
                // 'zone'=>$req->zone,
                'zone' => $req->email2,
                //zone มาจาก <input type="text" name="zone" value="{{ $zonename}}"> หน้าrepair2
                'staffname' => $req->zone,
                'equipmentname' => EquipmentRepository::getEquipmentnameByID($req->category)->equipmentName,
                'detail' => $req->detail
            ];
        }
        // dd($data);
        //   cc
        $toRecipient = $req->email3;
        $ccRecipients = [];

        if (!empty($req->email1)) {
            $ccRecipients[] = $req->email1;
        }
        if (!empty($req->email2)) {
            $ccRecipients[] = $req->email2;
        }
        $dateNotirepair = date("Ymd", strtotime($noti->DateNotirepair));
        $branchCode = $req->branchid;
        $today = Carbon::parse($noti->DateNotirepair)->toDateString();
        $dailyCount = Notirepair::whereDate('DateNotirepair', $today)->count();
        $paddedId = str_pad($dailyCount, 3, '0', STR_PAD_LEFT);
        $subjectname = "เเจ้งปัญหา #MRO-" . $branchCode . "-" . $dateNotirepair . "-" . $paddedId;
        // $equipmentname = EquipmentRepository::getEquipmentnameByID($req->category)->equipmentName;
        // $subjectname = "แจ้งซ่อมอุปกรณ์ " . $equipmentname . " จากสาขา " . $branchDisplay;

        Mail::to($toRecipient)
            ->cc($ccRecipients) // Add all CC recipients at once.
            ->send(new NotiMail($data, $subjectname));

        //ใช้อันนี้
        // Mail::to($req->email1)->send(new NotiMail($data));
        // Mail::to($req->email2)->send(new NotiMail($data));
        // Mail::to($req->email3)->send(new NotiMail($data));
        // dd("Email sent successfully!");
        // $recipients = [
        //     $req->email1,
        //     $req->email2,
        //     $req->email3,
        // ];

        // Mail::to($recipients)->send(new NotiMail($data));
        return redirect()->route('success');
    }
    //ส่วนของ dashbord
    // public static function checkNotiRepair(Request $request)
    // {
    //         $searchTerm = $request->input('search');

    //         // 1) ดึงสถานะล่าสุดจากฐานที่สาม
    //         $latestStatusId = DB::connection('third')
    //             ->table('statustracking')
    //             ->select('NotirepairId', DB::raw('MAX(statustrackingId) as latest_id'))
    //             ->groupBy('NotirepairId');
    
    //         $query = NotiRepair::select(
    //             'notirepair.*',
    //             'latest_status.status as status',
    //             'latest_status.statusDate as statusDate',
    //             'equipment.equipmentName as equipmentName'
    //         )
    //             ->leftJoin('equipment', 'equipment.equipmentId', '=', 'notirepair.equipmentId')
    
    //             // 2) Join subquery
    //             ->leftJoinSub($latestStatusId, 'latest_id_table', function ($join) {
    //                 $join->on('notirepair.NotirepairId', '=', 'latest_id_table.NotirepairId');
    //             })
    
    //             // 3) Join ตาราง statustracking จากฐานข้อมูล third
    //             ->leftJoin(
    //                 DB::raw(env('THIRD_DB_DATABASE') . '.statustracking as latest_status'),
    //                 function ($join) {
    //                     $join->on('latest_status.NotirepairId', '=', 'notirepair.NotirepairId')
    //                         ->on('latest_status.statustrackingId', '=', 'latest_id_table.latest_id');
    //                 }
    //             )
    
    //             // 4) Filter
    //             ->where(function ($q) {
    //                 $q->where('latest_status.status', '!=', 'ยังไม่ได้รับของ');
    //             })
    //             ->orderBy('notirepair.DateNotirepair', 'desc');
    //             if ($searchTerm) {
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('notirepair.NotirepairId', 'like', "%$searchTerm%")
    //                     ->orWhere('equipment.equipmentName', 'like', "%$searchTerm%")
    //                     ->orWhere('notirepair.DeatailNotirepair', 'like', "%$searchTerm%")
    //                     ->orWhere('latest_status.status', 'like', "%$searchTerm%");
    //             });
    //         }
    
    //         $noti = $query->paginate(2)->withQueryString();
    //         return view('dashborad.notirepairlist', compact('noti'));
    //     }
 
      
    // }
    // ///////// login //////
    public static function checkNotiRepair(Request $request)
    {
        //ส่วนของหน้า login
        $role = Session::get('role');
        if($role ==='AdminTechnicianStore'){
            $searchTerm = $request->input('search');

            // 1) ดึงสถานะล่าสุดจากฐานที่สาม
            $latestStatusId = DB::connection('third')
                ->table('statustracking')
                ->select('NotirepairId', DB::raw('MAX(statustrackingId) as latest_id'))
                ->groupBy('NotirepairId');
    
            $query = NotiRepair::select(
                'notirepair.*',
                'latest_status.status as status',
                'latest_status.statusDate as statusDate',
                'equipment.equipmentName as equipmentName'
            )
                ->leftJoin('equipment', 'equipment.equipmentId', '=', 'notirepair.equipmentId')
    
                // 2) Join subquery
                ->leftJoinSub($latestStatusId, 'latest_id_table', function ($join) {
                    $join->on('notirepair.NotirepairId', '=', 'latest_id_table.NotirepairId');
                })
    
                // 3) Join ตาราง statustracking จากฐานข้อมูล third
                ->leftJoin(
                    DB::raw(env('THIRD_DB_DATABASE') . '.statustracking as latest_status'),
                    function ($join) {
                        $join->on('latest_status.NotirepairId', '=', 'notirepair.NotirepairId')
                            ->on('latest_status.statustrackingId', '=', 'latest_id_table.latest_id');
                    }
                )
    
                // 4) Filter
                ->where(function ($q) {
                    $q->where('latest_status.status', '!=', 'ยังไม่ได้รับของ');
                })
                ->orderBy('notirepair.DateNotirepair', 'desc');
    
            // 5) search keyword
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('notirepair.NotirepairId', 'like', "%$searchTerm%")
                        ->orWhere('equipment.equipmentName', 'like', "%$searchTerm%")
                        ->orWhere('notirepair.DeatailNotirepair', 'like', "%$searchTerm%")
                        ->orWhere('latest_status.status', 'like', "%$searchTerm%");
                });
            }
    
            $noti = $query->paginate(2)->withQueryString();
            return view('dashborad.notirepairlist', compact('noti'));
        }
    }

    public static function reciveNotirepair($notirepaitid)
    {
        $recivenoti = NotiRepairRepository::getNotirepirById($notirepaitid);

        return view('dashborad.notripair', compact('recivenoti'));
    }
    //เดิม
    // public static function acceptNotisRepair($notirepaitid){
    //     //acceot พอ save ในการกดรับให้ redirect ไป route Route::get('/updatestatus/form/{notirepaitid}'
    //     //,[NotiRepairContoller::class,'showUpdateStatusForm'])->name('noti.show_update_form');
    // $acceptnoti = StatustrackingRepository::acceptNotirepair($notirepaitid);
    // return redirect()->route('noti.show_update_form', ['notirepaitid' => $notirepaitid])
    //         ->with('success', 'รับเรื่องเรียบร้อยแล้ว! เข้าสู่หน้าอัพเดตสถานะ');


    // }
    public function acceptNotisRepair(Request $request, $notirepaitid)
    {

    $noti = NotiRepair::find($notirepaitid);

        if (!$noti) {
            return redirect()->back()->with('error', 'ไม่พบรายการแจ้งซ่อม');
        }

        // 1. ตรวจสอบสถานะปัจจุบัน (ป้องกันการรับซ้ำ)
        $currentStatus = DB::connection('third')
        ->table('statustracking')
            ->where('NotirepairId', $notirepaitid)
            ->orderByDesc('statustrackingId')
            ->value('status');

        if ($currentStatus && $currentStatus !== 'ยังไม่ได้รับของ') {
            return redirect()->back()->with('error', 'รายการนี้ถูกรับแล้ว สถานะปัจจุบันคือ: ' . $currentStatus);
        }

        // 2. บันทึกสถานะใหม่ลงในตาราง statustracking
        DB::connection('third')
        ->table('statustracking')
        ->insert([
            'NotirepairId' => $notirepaitid,
            'status' => 'ได้รับของเเล้ว',
            'statusDate' => Carbon::now(),
            // 'created_at' => Carbon::now(),
            // 'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'รายการแจ้งซ่อมรหัส ' . $notirepaitid . ' ได้รับเรื่องเรียบร้อยแล้ว');
    }
    public function showUpdateStatusForm($notirepaitid)
    {
        // ดึงข้อมูลการแจ้งซ่อมที่ต้องการอัพเดต
        $updatenoti = StatustrackingRepository::getNotiDetails($notirepaitid);
        if (!$updatenoti) {
            return redirect()->route('noti.list')->with('error', 'ไม่พบรายการแจ้งซ่อม');
        }
        // คืนค่า View dashborad.updatestatus
        return view('dashborad.updatestatus', compact('updatenoti'));
    }
    public function updateStatus(Request $request)
    {
        $notirepaitid = $request->NotirepairId;
        $statusData = $request->status;
        $statusDate = $request->statusDate;
        // $statusDate = Carbon::parse($request->statusDate)->format('d/m/Y'); //เดิมอันนี้เป็น เดือน/วัน/ปี
        // $statusDate = Carbon::createFromFormat('d/m/Y', $request->statusDate)->format('Y-m-d'); //เเต่ต้องมาพิมวันที่อยู่
        //status เป็นเเค่ชื่อที่ตั้งให้เหมือน name ใน html เเต่ตั้งชื่อให้เหมือน database
        // เรียกใช้ Repository เพื่ออัพเดตสถานะ
        StatustrackingRepository::updateNotiStatus($notirepaitid, $statusData, $statusDate);

        // เปลี่ยนเส้นทางกลับไปยังหน้ารายการแจ้งซ่อมพร้อมข้อความสำเร็จ
        return redirect()->route('noti.list')
            ->with('success', 'อัพเดตสถานะเรียบร้อยแล้ว!');
    }
    //dashbord frontstore
    public static function getStatusNotreciveItem($notirepairid)
    {
        $noti = StatustrackingRepository::getLatestStatusByNotiRepairId($notirepairid);
        return $noti;
    }
    public static function getItemrRepair($notirepairid)
    {
        $noti = StatustrackingRepository::acceptNotirepair($notirepairid);
        return view('dashborad.storefront', compact('noti'));
    }
    
    public function getNotiForStoreFront(Request $request)
    {
        $role = Session::get('role');
        if($role === 'Frontstaff'){
        $searchTerm = $request->input('search');
    
        // Subquery: หา statustrackingId ล่าสุด
        $latestStatusId = DB::connection('third')
            ->table('statustracking')
            ->select('NotirepairId', DB::raw('MAX(statustrackingId) as latest_id')) 
            ->groupBy('NotirepairId');
    
        $query = NotiRepair::select(
                'notirepair.*',
                DB::raw("COALESCE(latest_status.status, 'ยังไม่ได้รับของ') as status"),
                'latest_status.statusDate as statusDate',
                'equipment.equipmentName as equipmentName'
            )
            ->leftJoin('equipment', 'equipment.equipmentId', '=', 'notirepair.equipmentId')
    
            ->leftJoinSub($latestStatusId, 'latest_id_table', function($join) {
                $join->on('notirepair.NotirepairId', '=', 'latest_id_table.NotirepairId');
            })
    
            // JOIN ข้าม DB ต้องระบุชื่อฐานข้อมูล
            ->leftJoin(
                DB::raw(env('THIRD_DB_DATABASE') . '.statustracking as latest_status'),
                function($join) {
                    $join->on('latest_status.NotirepairId', '=', 'notirepair.NotirepairId')
                         ->on('latest_status.statustrackingId', '=', 'latest_id_table.latest_id');
                }
            )
    
            ->orderBy('notirepair.DateNotirepair', 'desc');
    
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('notirepair.NotirepairId', 'like', "%$searchTerm%")
                  ->orWhere('equipment.equipmentName', 'like', "%$searchTerm%")
                  ->orWhere('notirepair.DeatailNotirepair', 'like', "%$searchTerm%")
                  ->orWhere(DB::raw("COALESCE(latest_status.status, 'ยังไม่ได้รับของ')"), 'like', "%$searchTerm%");
            });
        }
    
        $noti = $query->paginate(10)->withQueryString(); 
        
        return view('dashborad.storefront', compact('noti'));
    }
    }
    
    // public function getNotiForStoreFront(Request $request)
    // {
    //     $searchTerm = $request->input('search');

    //     // Subquery: หา statustrackingId ล่าสุดของแต่ละรายการแจ้งซ่อม
    //     $latestStatusId = DB::connection('third')
    //         ->table('statustracking')
    //         ->select('NotirepairId', DB::raw('MAX(statustrackingId) as latest_id'))
    //         ->groupBy('NotirepairId');

    //     // Base Query: ดึงข้อมูลแจ้งซ่อมทั้งหมด และ JOIN สถานะล่าสุด
    //     $query = NotiRepair::select(
    //         'notirepair.*',
    //         // 💡 ถ้าสถานะเป็น NULL ให้ใช้ 'ยังไม่ได้รับของ' 
    //         DB::raw("COALESCE(latest_status.status, 'ยังไม่ได้รับของ') as status"),
    //         'latest_status.statusDate as statusDate',
    //         'equipment.equipmentName as equipmentName'
    //     )
    //         ->leftJoin('equipment', 'equipment.equipmentId', '=', 'notirepair.equipmentId')
    //         ->leftJoinSub($latestStatusId, 'latest_id_table', function ($join) {
    //             $join->on('notirepair.NotirepairId', '=', 'latest_id_table.NotirepairId');
    //         })
    //         ->leftJoin('statustracking as latest_status', function ($join) {
    //             $join->on('latest_status.NotirepairId', '=', 'notirepair.NotirepairId')
    //                 ->on('latest_status.statustrackingId', '=', 'latest_id_table.latest_id');
    //         })
    //         ->orderBy('notirepair.DateNotirepair', 'desc');

    //     if ($searchTerm) {
    //         $query->where(function ($q) use ($searchTerm) {
    //             $q->where('notirepair.NotirepairId', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('equipment.equipmentName', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('notirepair.DeatailNotirepair', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere(DB::raw("COALESCE(latest_status.status, 'ยังไม่ได้รับของ')"), 'like', '%' . $searchTerm . '%');
    //         });
    //     }

    //     $noti = $query->paginate(20)->withQueryString();

    //     return view('dashborad.storefront', compact('noti')); // ตรวจสอบพาธ View
    // }
    public static function checkall()
    {
        $check = StatustrackingRepository::getAllStatustracking();
        return $check;
    }
    //dashbord store 
    public static function NotiRepairHistory(){
        $notirepairList = NotirepairRepository::HistoryNotirepair();
        $equipmentList = EquipmentRepository::getallEquipment(); //เอาไอดีคนที่กดรับกดปิดงานฝั่งหน้าร้าน
        
    return view('dashboad.admin',compact('notirepairList','equipmentList'));
    }
    //dashbord AdminIt
    public static function ShowallNotirepair(){
        $notirepairList = NotirepairRepository::getAllNotiRepairWithDetails();
        return view('dashborad.adminall',compact('notirepairList'));
    }
}
