<?php 
    class MediaStorageService {

        private string $cloudinaryConnectionUrl;
        private string $cloudinaryAccessUrl;
        private int $maxImageSize;
        private static $cloudinary;
        private static $instances = [];

        
        public function getAccessUrl() {
            return $this->cloudinaryAccessUrl;
        }
        public function getMaxImageSize() {
            return $this->maxImageSize;
        }

        public function __construct()
        {
            /**
             * @var array $config
             */
            $config = App::get('config');
            $this->cloudinaryConnectionUrl = $config['cloudinary']['connection_url'];
            $this->cloudinaryAccessUrl = $config['cloudinary']['access_url'];
            $this->maxImageSize = $config['cloudinary']['max_image_size'];
            self::$cloudinary = new \Cloudinary\Cloudinary($this->cloudinaryConnectionUrl);
        }
    
        protected function __clone()
        {
        }
    
        public function __wakeup()
        {
            throw new \Exception("Cannot unserialize a singleton.");
        }
    
        public static function getInstance(): MediaStorageService
        {
            $cls = static::class;
            if (!isset(self::$instances[$cls])) {
                self::$instances[$cls] = new static();
            }
    
            return self::$instances[$cls];
        }

        public function getImageExtension($image)
        {
            // get image extension from its header
            $imagePath = $image['tmp_name'];
            $imageInfo = getimagesize($imagePath);
            $extension = image_type_to_extension($imageInfo[2]);
            
            // remove dot from extension
            $extension = substr($extension, 1);
            return $extension;
        }

        public function validateImageExtension($image)
        {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = $this->getImageExtension($image);
            if (in_array($extension, $allowedExtensions)) {
                return true;
            }

            return true;
        }

        public function validateImageSize($image)
        {
            $imagePath = $image['tmp_name'];
            $imageSize = filesize($imagePath);
            if ($imageSize <= $this->maxImageSize) {
                return true;
            }

            return false;
        }

        public function uploadImage(string $imagePath, string $folder, string $publicId): CloudinaryResponse|null
        {
            $options = [
                'folder' => $folder,
                'public_id' => $publicId,
                'resource_type' => 'image',
                'invalidate' => true,
                'overwrite' => true,
            ];

            $uploadResult = self::$cloudinary->uploadApi()->upload($imagePath, $options);
            if ($uploadResult) {
                $uploadResult = json_decode(json_encode($uploadResult));
                $cloudinaryResponse = CloudinaryResponse::fromJson($uploadResult);
                return $cloudinaryResponse;
            }

            return null;
        }
    }