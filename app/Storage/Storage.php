<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/7/12
 * Time: 14:51
 */

namespace App\Storage;

/**
 * Storage接口
 *
 * 该接口定义了访问数据存储器的方法
 * 具体的实现可以是多样化的，比如内存、关系型数据库、NoSQL数据库等等
 *
 */
interface Storage
{
    /**
     * 持久化数据方法
     * 返回新创建的对象ID
     *
     * @param array() $data
     * @return int
     */
    public function persist($data = [] );

    /**
     * 通过指定id返回数据
     * 如果为空返回null
     *
     * @param int $id
     * @return array|null
     */
    public function retrieve($id, $columns = array('*'));




    /**
     * 返回属性对应的数据字段名字
     * @param $propertyName
     * @return string
     */
    public function getFieldName($propertyName);
}