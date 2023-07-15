<?php

use App\Http\Controllers\panel\permission\index as PanelPermissionIndex;
use App\Http\Controllers\uploadImage;
use App\Http\Livewire\Admin\Article\Create as ArticleCreate;
use App\Http\Livewire\Admin\Article\Index as ArticleIndex;
use App\Http\Livewire\Admin\Article\Trashed as ArticleTrashed;
use App\Http\Livewire\Admin\Article\Update as ArticleUpdate;
use App\Http\Livewire\Admin\Article\View;
use App\Http\Livewire\Admin\Brand\Index as BrandIndex;
use App\Http\Livewire\Admin\Brand\Trashed as BrandTrashed;
use App\Http\Livewire\Admin\Brand\Update as BrandUpdate;
use App\Http\Livewire\Admin\Cart\Index as CartIndex;
use App\Http\Livewire\Admin\Cart\View as CartView;
use App\Http\Livewire\Admin\Category\Index as CategoryIndex;
use App\Http\Livewire\Admin\Category\Trashed;
use App\Http\Livewire\Admin\Category\Update;
use App\Http\Livewire\Admin\CategoryArticle\Index as CategoryArticleIndex;
use App\Http\Livewire\Admin\CategoryArticle\Trashed as CategoryArticleTrashed;
use App\Http\Livewire\Admin\CategoryArticle\Update as CategoryArticleUpdate;
use App\Http\Livewire\Admin\Comment\Article\Answer;
use App\Http\Livewire\Admin\Comment\Article\Index as CommentArticleIndex;
use App\Http\Livewire\Admin\Comment\Product\Answer as ProductAnswer;
use App\Http\Livewire\Admin\Comment\Product\Index as CommentProductIndex;
use App\Http\Livewire\Admin\Dashboard\Index;
use App\Http\Livewire\Admin\Discount\Index as DiscountIndex;
use App\Http\Livewire\Admin\DiscountBanner\EndSeasonDiscount;
use App\Http\Livewire\Admin\DiscountBanner\NewTask;
use App\Http\Livewire\Admin\DiscountBanner\SpecialDiscount;
use App\Http\Livewire\Admin\Favorite\Index as FavoriteIndex;
use App\Http\Livewire\Admin\Footer\Link\One;
use App\Http\Livewire\Admin\Footer\Link\Title;
use App\Http\Livewire\Admin\Footer\Link\Two;
use App\Http\Livewire\Admin\Footer\Link\UpdateTitle;
use App\Http\Livewire\Admin\Footer\MasterCard\Index as MasterCardIndex;
use App\Http\Livewire\Admin\Footer\Title\Index as TitleIndex;
use App\Http\Livewire\Admin\Footer\Title\Update as TitleUpdate;
use App\Http\Livewire\Admin\Header\Banner\Index as BannerIndex;
use App\Http\Livewire\Admin\Header\Banner\Update as BannerUpdate;
use App\Http\Livewire\Admin\Header\Logo\Index as LogoIndex;
use App\Http\Livewire\Admin\Header\Logo\Update as LogoUpdate;
use App\Http\Livewire\Admin\Header\Menu\Index as MenuIndex;
use App\Http\Livewire\Admin\Header\Menu\Update as MenuUpdate;
use App\Http\Livewire\Admin\Invoice\Index as InvoiceIndex;
use App\Http\Livewire\Admin\Log\Index as LogIndex;
use App\Http\Livewire\Admin\Newsletter\Index as NewsletterIndex;
use App\Http\Livewire\Admin\Order\Index as OrderIndex;
use App\Http\Livewire\Admin\Order\Trashed as OrderTrashed;
use App\Http\Livewire\Admin\Page\Index as PageIndex;
use App\Http\Livewire\Admin\Page\Trashed as PageTrashed;
use App\Http\Livewire\Admin\Page\Update as PageUpdate;
use App\Http\Livewire\Admin\Payment\Index as PaymentIndex;
use App\Http\Livewire\Admin\Payment\Paid;
use App\Http\Livewire\Admin\Payment\Trashed as PaymentTrashed;
use App\Http\Livewire\Admin\Payment\View as PaymentView;
use App\Http\Livewire\Admin\Permission\Index as PermissionIndex;
use App\Http\Livewire\Admin\Permission\Update as PermissionUpdate;
use App\Http\Livewire\Admin\Product\Attribute\Category;
use App\Http\Livewire\Admin\Product\Attribute\Index as AttributeIndex;
use App\Http\Livewire\Admin\Product\Attribute\Product as AttributeProduct;
use App\Http\Livewire\Admin\Product\Attribute\Trashed as AttributeTrashed;
use App\Http\Livewire\Admin\Product\Attribute\Update as AttributeUpdate;
use App\Http\Livewire\Admin\Product\Attributevalue\Index as AttributevalueIndex;
use App\Http\Livewire\Admin\Product\Attributevalue\Trashed as AttributevalueTrashed;
use App\Http\Livewire\Admin\Product\Attributevalue\Update as AttributevalueUpdate;
use App\Http\Livewire\Admin\Product\Color\Index as ProductColorIndex;
use App\Http\Livewire\Admin\Product\Color\Product as ColorProduct;
use App\Http\Livewire\Admin\Product\Color\Trashed as ProductColorTrashed;
use App\Http\Livewire\Admin\Product\Color\Update as ProductColorUpdate;
use App\Http\Livewire\Admin\Product\Create;
use App\Http\Livewire\Admin\Product\Gallery\Index as GalleryIndex;
use App\Http\Livewire\Admin\Product\Gallery\Product;
use App\Http\Livewire\Admin\Product\Gallery\Update as GalleryUpdate;
use App\Http\Livewire\Admin\Product\Index as ProductIndex;
use App\Http\Livewire\Admin\Product\Size\Index as SizeIndex;
use App\Http\Livewire\Admin\Product\Size\Product as SizeProduct;
use App\Http\Livewire\Admin\Product\Size\Update as SizeUpdate;
use App\Http\Livewire\Admin\Product\Trashed as ProductTrashed;
use App\Http\Livewire\Admin\Product\Update as ProductUpdate;
use App\Http\Livewire\Admin\SearchHistory\Index as SearchHistoryIndex;
use App\Http\Livewire\Admin\Sms\Index as SmsIndex;
use App\Http\Livewire\Admin\Social\Index as SocialIndex;
use App\Http\Livewire\Admin\Subcategory\Index as SubcategoryIndex;
use App\Http\Livewire\Admin\Subcategory\Trashed as SubcategoryTrashed;
use App\Http\Livewire\Admin\Subcategory\Update as SubcategoryUpdate;
use App\Http\Livewire\Admin\SubcategoryArticle\Index as SubcategoryArticleIndex;
use App\Http\Livewire\Admin\SubcategoryArticle\Trashed as SubcategoryArticleTrashed;
use App\Http\Livewire\Admin\SubcategoryArticle\Update as SubcategoryArticleUpdate;
use App\Http\Livewire\Admin\Users\Confirm;
use App\Http\Livewire\Admin\Users\Create as UsersCreate;
use App\Http\Livewire\Admin\Users\Index as UsersIndex;
use App\Http\Livewire\Admin\Users\NotConfirm;
use App\Http\Livewire\Admin\Users\Update as UsersUpdate;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class)->name('admin.index');

Route::post('image-upload', [uploadImage::class, 'upload'])->name('image.upload');

//---------------------------start route categoty product-------------------------

Route::get('/category', CategoryIndex::class)->name('category.index')->middleware('can:show-category');
Route::get('/category/update/{category}', Update::class)->name('category.update');
Route::get('/category/trashed', Trashed::class)->name('category.trashed')->middleware('can:show-category-trashed');

//-------------------------end route categoty product---------------------------


// -------------------------start route subcategory product--------------------

Route::get('/subcategory', SubcategoryIndex::class)->name('subcategory.index')->middleware('can:show-subcategory');
Route::get('/subcategory/update/{subcategory}', SubcategoryUpdate::class)->name('subcategory.update');
Route::get('/subcategory/trashed', SubcategoryTrashed::class)->name('subcategory.trashed')->middleware('can:show-subcategory-trashed');
// -------------------------end route subcategory product--------------------



// START CATEGORY ARTICLE
Route::get('/category-article', CategoryArticleIndex::class)->name('category.article.index')->middleware('can:show-category-article');
Route::get('/category-article/update/{category}', CategoryArticleUpdate::class)->name('category.article.update');
Route::get('/category-article/trashed', CategoryArticleTrashed::class)->name('category.article.trashed')->middleware('can:show-category-article-trashed');
//END CATEGORY ARTICLE

//START SUBCATEGORY ARTICLE
Route::get('/subcategory-article', SubcategoryArticleIndex::class)->name('subcategory.article.index')->middleware('can:show-subcategory-article');

Route::get('/subcategory-article/update/{subcategory}', SubcategoryArticleUpdate::class)->name('subcategory.article.update');

Route::get('/subcategory-article/trashed', SubcategoryArticleTrashed::class)->name('subcategory.article.trashed')->middleware('can:show-subcategory-article-trashed');
//END SUBCATEGORY ARTICLE

// ------------------------end route subcategory article---------------------


//-------------------------------start log------------------------------
Route::get('/log', LogIndex::class)->name('log.index')->middleware('can:show-log');
//-------------------------------end log-------------------------------


//-----------------------------start procuct---------------------------

Route::get('/product', ProductIndex::class)->name('product.index')->middleware('can:show-product');
Route::get('product/trashed', ProductTrashed::class)->name('product.trashed')->middleware('can:show-product-trashed');
Route::get('/product/create', Create::class)->name('product.create')->middleware('can:show-product-create');
Route::get('/product/update/{product}', ProductUpdate::class)->name('product.update');

//-----------------------------end product------------------------------------


//-------------------------------brand-------------------------------------------

Route::get('/brand', BrandIndex::class)->name('brand.index')->middleware('can:show-brand');
Route::get('/brand/trashed', BrandTrashed::class)->name('brand.trashed')->middleware('can:show-brand-trashed');
Route::get('/brand/update/{brand}', BrandUpdate::class)->name('brand.update');
//-----------------------------endbrand------------------------------------------

//-------------------------------color-------------------------------------------

Route::get('/color', ProductColorIndex::class)->name('color.index')->middleware('can:show-color');
Route::get('/color/trashed', ProductColorTrashed::class)->name('color.trashed')->middleware('can:show-color-trashed');
Route::get('/color/update/{color}', ProductColorUpdate::class)->name('color.update');
Route::get('/color/product/{product}', ColorProduct::class)->name('color.product_color');

//-----------------------------endcolor------------------------------------------

//-----------------------------start size------------------------------------------
Route::get('/size', SizeIndex::class)->name('size.index')->middleware('can:show-size');
Route::get('/size/update/{size}', SizeUpdate::class)->name('size.update');
Route::get('/size/product/{product}', SizeProduct::class)->name('size.product_size');
//-----------------------------endsize------------------------------------------


//-----------------------------start gallery----------------------------------------

Route::get('/gallery', GalleryIndex::class)->name('gallery.index')->middleware('can:show-gallery');
Route::get('/gallery/update/{gallery}', GalleryUpdate::class)->name('gallery.update');
Route::get('/gallery/product/{product}', Product::class)->name('gallery.product_image');

//-----------------------------endgallery------------------------------------------


//-----------------------------start attribute
Route::get('/attribute', AttributeIndex::class)->name('attribute.index')->middleware('can:show-attribute');
Route::get('/attribute/trashed', AttributeTrashed::class)->name('attribute.trashed');
Route::get('/attribute/update/{attribute}', AttributeUpdate::class)->name('attribute.update');
Route::get('/attribute/subcategory/{subcategroy}', Category::class)->name('subcategory.attribute');

//-----------------------------end attribute----------------------------------------

//-----------------------------start attributevalue-------------------------
Route::get('/attributevalue', AttributevalueIndex::class)->name('attributevalue.index')->middleware('can:show-attributevalue');
Route::get('/attributevalue/trashed', AttributevalueTrashed::class)->name('attributevalue.trashed');
Route::get('/attributevalue/update/{attributeValue}', AttributevalueUpdate::class)->name('attributevalue.update');
Route::get('/attribute/product/{product}', AttributeProduct::class)->name('attribute.product');

//-----------------------------end attributevalue------------------------------------


//-------------------------------page-------------------------------------------

Route::get('/page', PageIndex::class)->name('page.index')->middleware('can:show-page');
Route::get('/page/trashed', PageTrashed::class)->name('page.trashed');
Route::get('/page/update/{page}', PageUpdate::class)->name('page.update');
//-----------------------------end page------------------------------------------

// START  SETTING FOOTER & HEADER
//----------------------------start section middlebar--------------------

Route::get('footer/link1', One::class)->name('one.index')->middleware('can:show-footer');
Route::get('footer/link2', Two::class)->name('two.index');
Route::get('footer/link/title', Title::class)->name('title.index');
Route::get('footer/link/title/update/{footer}', UpdateTitle::class)->name('title.update');
//----------------------------end section middlebar--------------------

//----------------------------start newsLetter--------------------------
Route::get('footer/newsletter', NewsletterIndex::class)->name('newsletter.index')->middleware('can:show-newsletter');
//----------------------------end newsLetter--------------------------

//----------------------------start social--------------------------
Route::get('footer/social', SocialIndex::class)->name('social.index')->middleware('can:show-social');
//----------------------------end social--------------------------
Route::get('footer/title', TitleIndex::class)->name('footer_title.index');

Route::get('footer/title/update/{footerTitle}', TitleUpdate::class)->name('footer_title.update');

Route::get('footer/master_card', MasterCardIndex::class)->name('master_card.index');

//header site

Route::get('header/site', MenuIndex::class)->name('header.index')->middleware('can:show-header');
Route::get('header/site/update/{menu}', MenuUpdate::class)->name('header.update');
//banner
Route::get('header/banner', BannerIndex::class)->name('banner.index')->middleware('can:show-header-banner');
Route::get('header/banner/update/{banner}', BannerUpdate::class)->name('banner.update');
//logo
Route::get('header/logo', LogoIndex::class)->name('logo.index')->middleware('can:show-logo');
Route::get('header/logo/update/{logo}', LogoUpdate::class)->name('logo.update');

// END SETTING FOOTER & HEADER

//START ARTICLE

Route::get('/articles', ArticleIndex::class)->name('article.index')->middleware('can:show-article');
Route::get('/article/create', ArticleCreate::class)->name('article.create')->middleware('can:show-article-create');
Route::get('/article/trashed', ArticleTrashed::class)->name('article.trashed')->middleware('can:show-article-trashed');
Route::get('/article/update/{article}', ArticleUpdate::class)->name('article.update');
Route::get('/article/view/{article}', View::class)->name('article.view');

//END ARTICLE

//START PERMISSION
Route::get('/permission', PermissionIndex::class)->name('permission.index')->middleware('can:show-permission');
Route::get('/permission/update/{permission}', PermissionUpdate::class)->name('permission.update');
//END PERMISSION

//START USERS
Route::get('/users', UsersIndex::class)->name('users.index')->middleware('can:show-users');
Route::get('/user/create', UsersCreate::class)->name('user.create')->middleware('can:show-user-create');
Route::get('/users/confirm', Confirm::class)->name('users.confirm');
Route::get('/users/not-confirm', NotConfirm::class)->name('users.not.confirm');
Route::get('/user/update/{user}', UsersUpdate::class)->name('user.update');
Route::get('/user/permission/{user}', [PanelPermissionIndex::class, 'render'])->name('users.permission');
Route::post('/user/permission-create/{user}', [PanelPermissionIndex::class, 'create'])->name('users.permission.create');
//END USERS

//START COMMENTS ARTICLE
Route::get('/comment/article', CommentArticleIndex::class)->name('comment.article.index')->middleware('can:show-comment-article');

Route::get('/comment/article/answer-{comment}', Answer::class)->name('comment.article.answer');
//END COMMENTS ARTICLE

//START COMMENTS PRODUCT
Route::get('/comment/product', CommentProductIndex::class)->name('comment.product.index')->middleware('can:show-comment-product');

Route::get('/comment/product/answer-{comment}', ProductAnswer::class)->name('comment.product.answer');

//END COMMENTS PRODUCT

//START DISCOUNT
Route::get('/discount-code', DiscountIndex::class)->name('discount.code.index')->middleware('can:show-discount-code');

//END DISCOUNT

//START ORDER
Route::get('/orders', OrderIndex::class)->name('orders.index')->middleware('can:show-orders');
Route::get('/failed/orders', OrderTrashed::class)->name('orders.failed')->middleware('can:show-orders-failed');
//END ORDER\

//START PAYMENT
Route::get('/payment', PaymentIndex::class)->name('payments.index')->middleware('can:show-payment');
Route::get('/failed/payment', PaymentTrashed::class)->name('payments.failed')->middleware('can:show-payment-failed');
Route::get('/payment-{payment}/view', PaymentView::class)->name('payments.view');
Route::get('/paid', Paid::class)->name('payment.paid.index')->middleware('can:show-paid');

// END PAYMENT

//START END SEASON DISCOUNT
Route::get('/end-season-discount', EndSeasonDiscount::class)->name('end.season.discount')->middleware('can:show-end-season-discount');
//END END SEASON DISCOUNT

//START END SEASON DISCOUNT
Route::get('/special-discount', SpecialDiscount::class)->name('special.discount')->middleware('can:show-special-discount');
//END END SEASON DISCOUNT

//START NEW TASK
Route::get('/new-task', NewTask::class)->name('newTask.index')->middleware('can:show-new-task');
//END NEW TASK


//START FAVORITE
Route::get('/list-favorite', FavoriteIndex::class)->name('list.favorite.index')->middleware('can:show-favorite');
//END FAVORITE

//START SMS
Route::get('/sms-code', SmsIndex::class)->name('sms.index')->middleware('can:show-sms');

//END SMS

//START SEARCH HISTORY
Route::get('/search-history', SearchHistoryIndex::class)->name('search.history.index')->middleware('can:show-search-history');

//END SEARCH HISTORY

// START INVOICE
Route::get('/invoice', InvoiceIndex::class)->name('invoices.index')->middleware('can:show-invoices');

// END INVOICE

// START CART
Route::get('/carts', CartIndex::class)->name('carts.admin')->middleware('can:show-carts');
Route::get('/cart-{cart}/view', CartView::class)->name('cart.view');

// END CART
