<?php
namespace App\Master;
use Illuminate\Support\Facades\DB;
use App\Model\Enrolment;
class EnrolmentMaster() {
    public static function getResultByConditions( array $conditions, $page, $pageSize, $sortBy)
    {
        $query = DB::table('users');
        $query->select(['courses.courseName','users.firstName','users.lastName','enrolments.created_at'])
        $query->join('users','users.id','=','enrolments.userID')
        $query->join('courses','courses.courseID','=','enrolments.courseID');
        if($conditions){
            foreach ($conditions as $k=>$v){
                $query->where($k, $v)
            }
        }
        $data = $query->paginate($pageSize, ['*'], 'enrolmentPage', $page);
        return $data;
    }


}


?>