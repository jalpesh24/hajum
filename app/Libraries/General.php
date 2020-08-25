<?php namespace App\Libraries;

use Config;
use Carbon;
use File;
use Image;
use URL;
use Storage;
use Validator;
use PDF;
use PDFMerger;

class General {

    public static $thumbFolder = [
        'original' => [],
        '160X160'=>[160,160],
        '532X502'=>[532,502]
    ];

    public static $imageExtension = [
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'
    ];

    public static $uploadInPublicFolder = [       
        'banner_image',
        'testimonial_image'
    ];

    public static $defaultImagePath = '/uploads/default_img.png';

    /**
     * @author Ashwin Vadgama < ashwinvadgama@gmail.com >
     *
     * @uses Generate slug
     *
     * @return string
     */
    static function generateSlug($title, $replaceWith="-") {
        // $title = str_replace(' ', $replaceWith, trim($title)); // Replaces all spaces with hyphens.
        // return  strtolower(preg_replace('/[^A-Za-z0-9\-\_]/', '', $title)); // Removes special chars.
        return str_slug($title, '-');
    }

    public static function getStoragePath(){
        return storage_path("app/public");
    }
    public static function getPublicPath(){
        return public_path();   
    }


    /**
     * @author Ghanshyam Tank
     *
     * @uses Move images from temp to specific folder
     *
     * @return boolean
     */
    static function moveImages($imageName="", $destinationFolderName="", $unlinkOldImage="", $folderList = array()) {

        // List of folder name
        if(!empty($folderList)){
            $thumbFolder = $folderList;
            $thumbFolder['original'] = [];
        } else {
            $thumbFolder = self::$thumbFolder;
        }

        $storageBasePathTempData = self::getUploadBasePath('temp');
        $storageBasePathTemp = $storageBasePathTempData['filepath'];

        $destinationBasePathData = self::getUploadBasePath($destinationFolderName);
        $destinationBasePath = $destinationBasePathData['filepath'];

        // If specific folder not exist, It will create
        if(!is_dir($destinationBasePath)) {
            File::makeDirectory($destinationBasePath, 0755, true, true);
        }

        $checkFile = file_exists($storageBasePathTemp.$imageName);

        if($checkFile) {

            foreach ($thumbFolder as $folderName => $size) {
                // if(count($folderList)>0 && !in_array($folderName, $folderList)){
                //     continue;
                // }

                // if($folderName == 'original') {
                //     continue;
                // }

                if($folderName == 'original') {
                    $thumbFilepath = $destinationBasePath;
                    File::move($storageBasePathTemp.$imageName , $destinationBasePath.$imageName);
                } else {
                    $thumbFilepath = $destinationBasePath.$folderName;

                    // If thumb folder not exist, It will create
                    if(!is_dir($thumbFilepath)) {
                        File::makeDirectory($thumbFilepath, 0755, true, true);
                    }

                    $checkFileSub = file_exists($storageBasePathTemp.$folderName.'/'.$imageName);
                    if($checkFileSub){
                        File::move($storageBasePathTemp.$folderName.'/'.$imageName , $destinationBasePath.$folderName.'/'.$imageName);
                    }
                }
            }
        }

        if(!empty($unlinkOldImage)){
            self::unlinkImage($unlinkOldImage, $destinationFolderName);
        }

        return true;

    }
    // Added Function - Ghanshyam - END


     // File upload
    static function getUploadBasePathNew($type="", $specificDir="") {
        $uploadfilepath = 'uploads';

        // get current domain
        // $current_domain = Config::get("CURRENT_DOMAIN");
        // Clone directory path
        // $clone_dir_path = '';
        // Only for specific clone directory - specify in array
        /*if(in_array($type, [])) {
            $finalDirPath = $clone_dir_path;
        } else {
            // Set proper domain
            if(isset($specificDir) && $specificDir != ""){
                $finalDirPath = $specificDir;
            } else {
                $finalDirPath = $current_domain;
            }
        }*/

        $storage_path = storage_path("app/public");
        // $filepath = $storage_path.'/'.$uploadfilepath.'/'.$finalDirPath.'/';
        $filepath = $storage_path.'/'.$uploadfilepath.'/';
        if(!empty($type)) {
            $filepath .= $type.'/';
        }

        return $filepath;
    }

    // File upload
    static function getUploadBasePath($type="", $specificDir="") {
        $uploadfilepath = 'uploads';

        if(in_array($type, self::$uploadInPublicFolder)) {
            $directoryFrom = 'public';
        } else {
            $directoryFrom = 'storage';
        }

        $directoryPath = '';
        if($directoryFrom == 'public') {
            $directoryPath = public_path();
        } else {
            $directoryPath = storage_path("app/public");
        }

        $specificDirPath = "";
        // Set proper domain
        if($specificDir != ""){
            $specificDirPath = $specificDir.'/';
        }

        $filepath = $directoryPath.'/'.$uploadfilepath.'/'.$specificDirPath;

        if(!empty($type)) {
            $filepath .= $type.'/';
        }

        $finalData = array(
            'filepath' => $filepath,
            'directoryFrom' => $directoryFrom
        );

        return $finalData;
    }



    static function fileUpload($file, $type, $oldProfile="", $specificDir="", $folderList = array()) {

        set_time_limit(18000); // in seconds
        ini_set('memory_limit', '-1');

        $thumbFolder = self::$thumbFolder;
        $imageExtension = self::$imageExtension;

        $current_time = time();
        $filepathData = self::getUploadBasePath($type, $specificDir);
        $filepath = $filepathData['filepath'];

        // Unlink old image
        if(!empty($oldProfile)){
            self::unlinkImage($oldProfile, $type, $specificDir);
        }

        $uploadfilename = "";
        if(isset($file) && !empty($file)){
            $filename = $file->getClientOriginalName();
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $guid = GUID::create_guid();

            // If specific folder not exist, It will create
            if(!is_dir($filepath)) {
                File::makeDirectory($filepath, 0755, true, true);
            }
            $fileName =  $guid.".".$extension;
            $uploadImageDirPath = $file->move($filepath,$fileName)->getpathName();

            /* **** Create Thumbnail - Start **** */
            if(in_array($extension, $imageExtension)){
                foreach ($thumbFolder as $folderName => $size) {
                    if(count($folderList)>0 && !in_array($folderName, $folderList)){
                        continue;
                    }

                    if($folderName == 'original') {
                        continue;
                    }

                    $thumbFilepath = $filepath.'/'.$folderName;

                    // If thumb folder not exist, It will create
                    if(!is_dir($thumbFilepath)) {
                        File::makeDirectory($thumbFilepath, 0755, true, true);
                    }
                    $img = Image::make($uploadImageDirPath); //->orientate();

                     // Check if the image is a jpg
                    $isJpg = $img->mime === 'img/jpg' || $img->mime === 'img/jpeg';
                    if($isJpg && $img->exif('Orientation'))
                        $img = orientate($img, $img->exif('Orientation'));


                    $img->resize($size[0], $size[1], function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbFilepath.'/'.$fileName);

                }
            }

            /* **** Create Thumbnail - End **** */
            $uploadfilename = $fileName;
        }
        return $uploadfilename;
    }

    static function imageUrlPath($folderType, $imageName='', $http_url=0, $is_need_default_image=1, $image_size="160X160", $default_image="" ){

        $uploadfilepath = 'uploads';

        $imageUrlData = self::getUploadBasePath($folderType);
        $imageUrl = $imageUrlData['filepath'];
        $directoryFrom = $imageUrlData['directoryFrom'];

        if($directoryFrom == 'storage') {
            return self::createBinaryImage($folderType, $imageName, $is_need_default_image, $image_size, $default_image);
        } else {
            $setFolderPath = "";
            if(!empty($imageName) && !empty($image_size)) {
                $setFolderPath .= $image_size.'/'.$imageName;
            } else if(!empty($image_size)) {
                $setFolderPath .= $image_size.'/';
            } else if(!empty($imageName)) {
                $setFolderPath .= $imageName;
            }
            $checkFile = "";
            if(!empty($imageName)){
                $checkFile = file_exists($imageUrl.$setFolderPath);
            }

            if($checkFile) {
                $imagePath = $uploadfilepath .'/'. $folderType .'/'. $setFolderPath;

                if($http_url==1) {
                    return URL::to('/').'/'.$imagePath;
                } else {
                    return $imagePath;
                }
            } else {
                if($is_need_default_image){
                    return URL::to('/').'/uploads/default_img.png';
                }
            }

        }

    }


    /**
     * @author Ghanshyam Tank < ghanshyam.tank@jini.guru >
     *
     * @uses Unlink image with its thumb
     *
     * @return string
     */
    static function unlinkImage($imageName, $type, $specificDir="") {
        if($imageName) {
            // List of folder name
            $thumbFolder = self::$thumbFolder;

            $filepath = self::getUploadBasePathNew($type, $specificDir);
            foreach ($thumbFolder as $folderName => $size) {
                if($folderName == "original") {
                    $imagePath = $filepath.$imageName;
                } else {
                    $imagePath = $filepath.$folderName.'/'.$imageName;
                }
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        return true;
    }

    /**
     * @author Ghanshyam Tank
     *
     * @uses Convert image in Binary format & return
     *
     * @return string
     */
    public static function createBinaryImage($folderType, $imageName="", $is_need_default_image, $image_size="160X160", $defaultImage = "") {

        $defaultImagePath = "";
        if($is_need_default_image){
            $defaultImagePath = self::$defaultImagePath;
        }

        if(!empty($imageName)) {
            // $imageUrl =  storage_path('app/public/uploads/'. $folderType);
            $imageUrlData = self::getUploadBasePath($folderType);
            $imageUrl = $imageUrlData['filepath'];

            if(!empty($image_size)) {
                $imageUrl .=  '/'.$image_size.'/'. $imageName;
            } else {
                $imageUrl .=  '/'. $imageName;
            }

            if(file_exists($imageUrl)) {
                $file_info = new \finfo(FILEINFO_MIME_TYPE);
                $mime_type = $file_info->buffer(file_get_contents($imageUrl));

                $contents = file_get_contents($imageUrl);
                return ('data:' . $mime_type . ';base64,' . base64_encode($contents));
            } else if(!empty($defaultImage) && $is_need_default_image) {
                return $defaultImage;
            } else {
                return $defaultImagePath;
            }
        } else {
            return $defaultImagePath;
        }
    }

    static function generateRandomTokan(){
        $password = "";
        $smallChar = str_shuffle('abcdefghjklmnopqrstuvwxyz');
        $password .= substr($smallChar, 0, 2);

        $capsChar = str_shuffle('ABCDEFGHJKLMNOPQRSTUVWXYZ');
        $password .= substr($capsChar, 0, 2);

        $latter = str_shuffle('234567890');
        $password .= substr($latter, 0, 2);

        $spacChar = str_shuffle('!$%^&!$%^&');
        $password .= substr($spacChar, 0, 2);

        return $password;
        // $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        // return substr($random, 0, 8);
    }

    static function sendEmail($passData){      
        $response = Curl::to(url('/').'/sendMail')->withData($passData)->withTimeout(3)->get();
        return $response;
    }

    static function generateRandomPassword()
    {
        $password = "";
        $smallChar = str_shuffle('abcdefghjklmnopqrstuvwxyz');
        $password .= substr($smallChar, 0, 2);

        $capsChar = str_shuffle('ABCDEFGHJKLMNOPQRSTUVWXYZ');
        $password .= substr($capsChar, 0, 2);

        $latter = str_shuffle('234567890');
        $password .= substr($latter, 0, 2);

        $spacChar = str_shuffle('!$%&!$%&');
        $password .= substr($spacChar, 0, 2);

        return $password;        
    }

}
