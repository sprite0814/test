<?php 
namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;
use App\Laravue\JsonResponse;
use App\Model\Enrolments;
use App\Model\EnrolmentStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EnrolmentController extends BaseController
{
    public function list(Request $request){
        $searchParams = $request->all();
        $page = isset($searchParams['page']) ? intval($searchParams['page']) : 1;
        $limit = isset($searchParams['limit']) ? intval($searchParams['limit']) : 10;
        $statusID = isset($searchParams['statusID']) ? intval($searchParams['statusID']) : 0;
        $page  = $page  > 0 ? $page  : 1;
        $limit = $limit > 0 ? $limit : 1;
        $courseName = isset($searchParams['courseName']) ? trim($searchParams['courseName']) : '';
        $userName = isset($searchParams['userName']) ? trim($searchParams['userName']) : '';

        $query = Enrolments::query();
        $query->select(['enrolments.courseID','enrolments.statusID','enrolments.userID','users.name','courses.courseName','users.email','enrolments.created_at','enrolment_statuses.statusName']);
        $query->join('enrolment_statuses','enrolments.statusID','=','enrolment_statuses.statusID');
        $query->join('users','enrolments.userID','=','users.id');
        $query->join('courses','enrolments.courseID','=','courses.courseID');
        if (!empty($courseName)) {
            $query->where('courses.courseName','=', $courseName);
        }
        if (!empty($userName)) {
            $query->where('users.name','=', $userName);
        }
        if (!empty($statusID)) {
            $query->where('enrolments.statusID','=', $statusID);
        }
        $data = $query->paginate($limit,['*'],'page',$page);
        return response()->json($data, Response::HTTP_OK);
    }

    public function StatusList(){
        $data = EnrolmentStatus::all(['statusID','statusName']);
        return response()->json($data, Response::HTTP_OK);
    }

}

?>