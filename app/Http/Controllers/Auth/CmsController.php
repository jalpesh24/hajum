<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Routing\ResponseFactory;
use Auth;
use DB;
use User;
use App\CMS;
use App\Libraries\General;
use Validator;
use Session;

class CmsController extends Controller
{
    private $res;

    public function __construct(ResponseFactory $responseFactory) {
        $this->res = $responseFactory;
    }

    public function index(Request $request) 
    {
       
        if (Auth::check())
        {
            
            return view('cms.cms_add');
        }
        else {
            return redirect('/login');
        }
    }
    

    /**
     * @uses Cms
     *
     * @author Jalpesh Bhadarka
     *
     * @return json
     */
    public function getAllCms(Request $request) {        
        
            $cmsLists = CMS::select()->whereNull('deleted_at')->orderBy('updated_at', 'ASC')->paginate(10);
            return view('cms.cms_list',array('cmsLists'=>$cmsLists));
            
    }

    /**
     * @uses Add CMS detail
     *
     * @author Jalpesh Bhadarka
     *
     * @return json
     */
    public function postCmsAdd(Request $request){
        $postData = $request->all();
        DB::beginTransaction();
        try {

            $postData['cms_slug'] = '';
            if (isset($postData['title'])) {
                $postData['cms_slug'] = General::generateSlug($postData['title']);
            }
            $stripDescription = (isset($postData['description']) && $postData['description']) ? trim(strip_tags($postData['description'])) : '';
            $string = preg_replace("/\s|&nbsp;/",'',$stripDescription);
            $postData['description'] = (!empty($string)) ? $postData['description'] : '';

            $rules = array(
                'title' => 'required|max:100',
                'cms_slug' => 'unique:cms,cms_slug,NULL,deleted_at',
                'description' => 'required',
                'content_display_location' => 'required'
            );

            $validator = Validator::make($postData, $rules);

            if ($validator->fails()) {
                return $this->res->json([
                    'success' => false,
                    'message' => $validator->messages()
                ]);
            } else {

                $CmsObj = New CMS();                
                $CmsObj->title = $postData['title'];
                $CmsObj->description = $postData['description'];                
                $CmsObj->cms_slug = General::generateSlug($postData['title']);
                $CmsObj->content_display_location = $postData['content_display_location'];
                $CmsObj->status = (isset($postData['status']) && ($postData['status']=='true' || $postData['status']==1)) ? 1 : 0;

                $CmsObj->save();
                DB::commit();

                return redirect('/cms-list')->with('status', 'cms add successfully!');
            }

        } catch(\Exception $e) {
            return redirect('/cms-list')->with('error', 'cms not add successfully!');
        }
    }

     /**
     * @uses DeleteCms
     *
     * @author Jalpesh Bhadarka
     *
     * @return json
     */
     public function getCmsDelete(Request $request, $CmsId) {

        DB::beginTransaction();
        try {
            if(!empty($CmsId)) {
                $cmsData = CMS::find($CmsId);

                if(isset($cmsData) && !empty($cmsData)) {
                    $cmsData->delete();
                    DB::commit();
                   return redirect('/cms-list')->with('status', 'cms delete successfully!');
                } else {
                    return redirect('/cms-list')->with('error', 'cms not delete successfully!');
                }
            } else {
                return redirect('/cms-list')->with('error', 'something wrong!');
            }
        } catch(\Exception $e) {
            return redirect('/cms-list')->with('error', 'cms not delete successfully!');
        }
    }

     /**
     * @uses Fetch Cms detail for update
     *
     * @author Jalpesh Bhadarka
     *
     * @return json
     */
     public function getCmsDetailForUpdate(Request $request, $CmsId){

        try{
            if(!empty($CmsId)){
                $cmsData = CMS::find($CmsId);
                if(!empty($cmsData)){
                   return view('cms.cms_edit',array('cmsData'=>$cmsData));
                } else {
                    return redirect('/cms-list')->with('error', 'cms data not found!');
                }
            } else {
                return redirect('/cms-list')->with('error', 'something wrong!');
            }
        }catch(\Exception $e){
            return redirect('/cms-list')->with('error', 'something wrong!');
        }
    }

    /**
     * @uses Update Cms detail
     *
     * @author Jalpesh Bhadarka
     *
     * @return json
     */
    public function postCmsUpdate(Request $request){

        $postData = $request->all();

        DB::beginTransaction();
        try {
            $cmsId = $postData['cms_id'];
            $postData['cms_slug'] = General::generateSlug($postData['title']);
            $stripDescription = (isset($postData['description']) && $postData['description']) ? trim(strip_tags($postData['description'])) : '';
            $string = preg_replace("/\s|&nbsp;/",'',$stripDescription);
            $postData['description'] = (!empty($string)) ? $postData['description'] : '';
            $rules = array(
                'title' => 'required|max:100',
                'cms_slug' => 'unique:cms,cms_slug,'.$cmsId.',cms_id,deleted_at,NULL',
                'description' => 'required',
                'content_display_location' => 'required'
            );

            $validator = Validator::make($postData, $rules);


            if ($validator->fails()) {
                return $this->res->json([
                    'success' => false,
                    'message' => $validator->messages()
                ]);
            } else {
                $CmsObj = CMS::find($postData['cms_id']);
                $CmsObj->title = $postData['title'];
                $CmsObj->description = $postData['description'];
                $CmsObj->cms_slug = General::generateSlug($postData['title']);
                $CmsObj->content_display_location = $postData['content_display_location'];
                $CmsObj->status = (isset($postData['status']) && ($postData['status']=='true' || $postData['status']==1)) ? 1 : 0;

                $CmsObj->update();
                DB::commit();
                 return redirect('/cms-list')->with('status', 'cms update successfully!');
                
            }
        } catch(\Exception $e) {
             return redirect('/cms-list')->with('status', 'cms not update successfully!');
        }
    }



    /**
     * @uses Update cms status
     *
     * @author Jalpesh Bhadarka
     *
     * @param  string $cmsId
     *
     * @return json
     */
    public function changeCmsStatus(Request $request, $cmsId, $status) {

        DB::beginTransaction();
        try {
            $cmsStatus = $status;
            $cmsNewStatus = ($cmsStatus==='1') ? '0' : '1';
            if(isset($cmsId) && !empty($cmsId)) {
                $cms = CMS::find($cmsId);
                if(isset($cms) && !empty($cms)) {
                    $cms->status =  $cmsNewStatus;
                    $cms->save();
                    DB::commit();
                    return redirect('/cms-list')->with('status', 'cms status change successfully!');
                } else {
                    return redirect('/cms-list')->with('error', 'cms status not change successfully!');
                }
            }
        } catch(\Exception $e) {
            return redirect('/cms-list')->with('error', 'cms status not change successfully!');
        }

    }

}