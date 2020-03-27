<?php

namespace common\repositories;

use common\models\Category;
use yii\db\ActiveRecord;

class CategoryRepository
{
    /**
     * Return category by id
     *
     * @param string $id
     *
     * @return Category
     */
    public function findCategory(string $id): Category
    {
        return Category::findOne($id);
    }


    /**
     * Return all categories query
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return Category::find();
    }

    /**
     * Return all categories
     *
     * @return array| \yii\db\ActiveRecord[]
     */
    public function getCategoriesList()
    {
        return Category::find()->all();
    }


    /**
     * Save category
     *
     * @param Category $category
     *
     * @return bool
     */

    public function save(Category $category)
    {
        if ( ! $category->save()) {
            \Yii::error(
                'Error has been occurred while saving Message model. Errors = ' . json_encode( $category->getErrors()) . '. Attributes = ' . json_encode($category->getAttributes()),
                __METHOD__
            );

            return false;
        }

        return true;
    }

}