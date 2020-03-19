<?php

namespace common\repositories;

use common\models\Category;

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
     * Return all categories
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return Category::find();
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