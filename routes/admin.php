<?php

use App\Livewire\Admin\ArticleCategories\ArticleCategories;
use App\Livewire\Admin\Articlecategories\TrashedArticleCategories;
use App\Livewire\Admin\Articles\Article;
use App\Livewire\Admin\Articles\ArticlesList;
use App\Livewire\Admin\Articles\EditArticle;
use App\Livewire\Admin\Articles\TrashedArticles;
use App\Livewire\Admin\Brands\Brands;
use App\Livewire\Admin\Brands\TrashedBrands;
use App\Livewire\Admin\Colors\Colors;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Panel; 
use App\Livewire\Admin\Users\UserList; 
use App\Livewire\Admin\Categories\Categories;
use App\Livewire\Admin\Categories\CategoryFeature;
use App\Livewire\Admin\Categories\TrashedCategories;
use App\Livewire\Admin\Colors\TrashedColors;
use App\Livewire\Admin\Comments\Comments;
use App\Livewire\Admin\Orders\OrderDetails;
use App\Livewire\Admin\Orders\Orders;
use App\Livewire\Admin\Products\EditProduct;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\CreateProductPrice;
use App\Livewire\Admin\Products\EditProductPrice;
use App\Livewire\Admin\Products\ProductPrice;
use App\Livewire\Admin\Products\ProductGallery;
use App\Livewire\Admin\Products\ProductInfo as ProductInformation;
use App\Livewire\Admin\Products\ProductsList;
use App\Livewire\Admin\Products\TrashedProducts;
use App\Livewire\Admin\SendType\SendType ;
use App\Livewire\Admin\Users\TrashedUsers;
use App\Livewire\Admin\Users\UserPermission;
use App\Livewire\Admin\Users\UserRole;
use App\Livewire\Admin\Warranties\TrashedWarranties;
use App\Livewire\Admin\Warranties\Warranties;

// -- panel --
Route::get('/', Panel::class)->name('home');

// -- users --
Route::get('/userList', UserList::class)->name('admin.user.list');
Route::get('/trashedUsers', TrashedUsers::class)->name('admin.trashed.users');
Route::get('/userRole',UserRole::class)->name('admin.user.role');
Route::get('/userPermission',UserPermission::class)->name('admin.user.Permission');


// -- categories --
Route::get('/categoriesList', Categories::class)->name('admin.categories.list');
Route::get('/trashedCategoriesList', TrashedCategories::class)->name('admin.trashed.categories.list');
Route::get('/categoriesFeature/{category}', CategoryFeature::class)->name('admin.category.feature');


// -- brands --
Route::get('/brandLists',Brands::class)->name('admin.brands.list');
Route::get('/trashedBrandList', TrashedBrands::class)->name('admin.trashed.brands.list');

// -- colors --
Route::get('/colorsList', Colors::class)->name('admin.colors.list');
Route::get('/trashedColorsList', TrashedColors::class)->name('admin.trashed.colors.list');


// -- warranties --
Route::get('/warrantiesList', Warranties::class)->name('admin.warranties.list');
Route::get('/trashedWarrantiesList', TrashedWarranties::class)->name('admin.trashed.Warranties.list');

// -- products --
Route::get('/createProduct', CreateProduct::class)->name('admin.create.product');
Route::get('/productsList', ProductsList::class)->name( 'admin.products.list');
Route::get('/trashedProductList', TrashedProducts::class)->name( 'admin.trashed.product.list');
Route::get('/editProductList/{product}', EditProduct::class)->name( 'admin.edit.product');
Route::get('/ProductPrices/{product}', ProductPrice::class)->name( 'admin.product.prices');
Route::get('/createProductPrice/{product}', CreateProductPrice::class)->name( 'admin.create.product.price');
Route::get('/editProductPrice/{productPrice}', EditProductPrice::class)->name( 'admin.edit.product.price');
Route::get('/productInformation/{product}', ProductInformation::class)->name( 'admin.product.information');
Route::get('/productGallery/{product}', ProductGallery::class)->name( 'admin.product.gallery');

// -- sendTypes --
Route::get('/sendType', SendType::class)->name('admin.send.type');

// -- orders --
Route::get('/orders', Orders::class)->name('admin.orders');
Route::get('/orderDetails/{order}', OrderDetails::class)->name('admin.order.details');

// comments
Route::get('/comments', Comments::class)->name('admin.comments');

// -- ArticleCategories --
Route::get('/articleCategoriesList', ArticleCategories::class)->name('admin.article.categories.list');
Route::get('/trashedArticleCategoriesList', TrashedArticleCategories::class)->name('admin.trashed.article.categories.list');

// -- Articles --
Route::get('/createArticle', Article::class)->name('admin.create.article');
Route::get('/articlesList', ArticlesList::class)->name('admin.article.list');
Route::get('/editArticle/{article}', EditArticle::class)->name('admin.edit.article');
Route::get('/editArticle/{article}', EditArticle::class)->name('admin.edit.article');
Route::get('/trashedArticle', TrashedArticles::class)->name('admin.trashed.article');











