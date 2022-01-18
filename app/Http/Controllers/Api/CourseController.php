<?php 
namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;
use App\Laravue\JsonResponse;
use App\Model\Courses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CourseController extends BaseController
{

    public function getSugesission(Request $request) {
        $sugesstion = [];
        $searchParams = $request->all();
        $keyword = isset($searchParams['courseName']) ? trim($searchParams['courseName']) : '';
        $query = Courses::query();
        $query->select(['courseID','courseName AS value']);
        if (!empty($keyword)) {
            $query->where('courseName','like','%'.$keyword.'%');

        }
        $query->orderBy('courseName','asc');
        $data = $query->limit(5)->get();
        return response()->json($data, Response::HTTP_OK);
    }

}

?>