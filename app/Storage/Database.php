<?php
/**
 * Created by PhpStorm.
 * User: moerlong
 * Date: 2018/7/12
 * Time: 14:54
 */

namespace App\Storage;


use Illuminate\Database\Eloquent\Model;

abstract class Database extends Model implements Storage
{



    protected $fields = [

    ];

    protected $dateFormat = 'U';

    protected $fieldNameMap = [];

    public function __construct(array $attributes = [])
    {

        $this->fieldNameMap = array_flip($this->fields);

        parent::__construct($attributes);

    }

    public function getUpdatedAtAttribute($value)
    {

        return $value;

    }

    public function getDeletedAtAttribute($value)
    {

        return $value;
    }

   public function getCreatedAtAttribute($value)
    {

        return $value;
    }

    public function getFieldName($propertyName)
    {

        return $this->fieldNameMap[$propertyName] ?? $propertyName;
    }

    protected static function boot()
    {

        parent::boot();

    }

    public function persist($data = [])
    {

        return $this->save();
    }

    public function retrieve($id, $columns = array('*'))
    {

       return  $this->findOrFail($id);
    }

    public function finData($id, $columns = array('*'))
    {
        return  $this->find($id);

    } //查询一条信息

    public function __set($propertyName, $value)
    {

        if (isset($this->fieldNameMap [$propertyName])) {

            $this->setAttribute($this->fieldNameMap [$propertyName], $value);

        } else {
            $this->setAttribute($propertyName, $value);

        }


    }

//    public function __get($propertyName)
//    {
//
//        if (isset($this->fieldNameMap [$propertyName]) && isset($this->attributes[$this->fieldNameMap [$propertyName]]) )
//            return $this->attributes[$this->fieldNameMap [$propertyName]];
//
//        return $this->getAttribute($propertyName);
//
//    }

    public function toArray()
    {

        $ret = [];
        foreach ($this->fields as $dbField => $classProperty) {

            $ret[$classProperty] = $this->{$dbField};
        }

        return $ret;
    }
}