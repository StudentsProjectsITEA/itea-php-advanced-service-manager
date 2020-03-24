<?php

namespace common\components;

use backend\models\forms\CreateCategoryForm;
use common\repositories\CategoryRepository;
use common\models\Category;
use Ramsey\Uuid\Uuid;
use yii\db\ActiveQuery;

/**
 * Class CategoryService
 * @package common\components
 */
class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    private $id;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param string $id
     *
     * @return Category
     */
    public function getCategoryById($id): Category
    {
        return $this->categoryRepository->findCategory($id);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategories(): ActiveQuery
    {
        return $this->categoryRepository->getCategories();
    }

    /**
     *
     * Method for create new category
     *
     * @param CreateCategoryForm $createCategory
     *
     * @return bool
     * @throws \Exception
     */
    public function createCategory(CreateCategoryForm $createCategory)
    {
        $category = new Category();
        $createCategory->id = Uuid::uuid4()->toString();
        $category->load($createCategory->getAttributes(), '');
        if ($this->categoryRepository->save($category)) {
            return true;
        }

        $createCategory->addErrors($category->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }

    /**
     *
     * Method for create new category
     * @param Category $category
     *
     * @return bool
     * @throws \Exception
     */
    public function updateCategory(Category $category): bool
    {
        if ($this->categoryRepository->save($category)) {
            return true;
        }
        $category->addErrors($category->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }
}
