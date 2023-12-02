<?php 
class CloudinaryResponse {
    public string $assetId;
    public string $publicId;
    public string $version;
    public string $signature;
    public int $width;
    public int $height;
    public string $format;
    public string $resourceType;
    public $createdAt;
    public array $tags;
    public string $bytes;
    public string $type;
    public string $etag;
    public string $placeholder;
    public string $url;
    public string $secureUrl;
    public string $folder;
    public string $originalFilename;
    public string $originalExtension;
    public string $apiKey;
    public string $imagePath;

    public function __construct(
        string $assetId, 
        string $publicId,
        string $version,
        string $signature,
        int $width,
        int $height,
        string $format,
        string $resourceType,
        $createdAt,
        array $tags,
        string $bytes,
        string $type,
        string $etag,
        string $placeholder,
        string $url,
        string $secureUrl,
        string $folder,
        string $originalFilename,
        string $originalExtension,
        string $apiKey
    ) {
        $this->assetId = $assetId;
        $this->publicId = $publicId;
        $this->version = $version;
        $this->signature = $signature;
        $this->width = $width;
        $this->height = $height;
        $this->format = $format;
        $this->resourceType = $resourceType;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
        $this->bytes = $bytes;
        $this->type = $type;
        $this->etag = $etag;
        $this->placeholder = $placeholder;
        $this->url = $url;
        $this->secureUrl = $secureUrl;
        $this->folder = $folder;
        $this->originalFilename = $originalFilename;
        $this->originalExtension = $originalExtension;
        $this->apiKey = $apiKey;
        $this->imagePath = $publicId . '.webp';
    }

    public static function fromJson($json): CloudinaryResponse {
        return new CloudinaryResponse(
            $json->asset_id,
            $json->public_id,
            $json->version,
            $json->signature,
            $json->width,
            $json->height,
            $json->format,
            $json->resource_type,
            $json->created_at,
            $json->tags,
            $json->bytes,
            $json->type,
            $json->etag,
            $json->placeholder,
            $json->url,
            $json->secure_url,
            $json->folder,
            $json->original_filename,
            $json->original_extension,
            $json->api_key
        );
    }
}