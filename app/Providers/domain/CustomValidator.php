<?php

namespace App\Providers\Domain;

class CustomValidator extends \Illuminate\Validation\Validator
{
  /**
     * The validation rules that may be applied to files.
     *
     * @var array
     */
    protected $fileRules = [
        'File', 'Image', 'Mimes', 'MimeTypes', 'Min',
        'Max', 'Size', 'Between', 'Dimensions',
        'SafeFilename',
    ];

    /**
     * Validate the given file has safe filename.
     *
     * @param string $attribute
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $value
     * @return bool
     */
    public function validateSafeFilename($attribute, \Symfony\Component\HttpFoundation\File\UploadedFile $value)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value->getClientOriginalName());
    }

}
