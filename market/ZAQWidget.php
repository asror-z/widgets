<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use widgets\inptest\ZStarratingWidget;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\models\shop\ShopBrand;
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\ChatGroup;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;


class ZAQWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="row">
      <div class="col-md-6 border m-3">
        <div class="review-main">

           <div class="review-header d-flex">
                <div class="header-image">
                   <img class="header-img" src="{userImage}" alt=""> 
                </div>
               <div class="header-name">
                  <p>{userName}</p>
               </div>

           
               <div class="header-stars d-flex ml-auto">
                  {starRating}
               </div>
           </div>

           <div class="review-content">
               <div class="content-text w-100">
                  <p class="w-100">{text}</p>
               </div>
           </div>

           <div class="review-footer w-100 d-flex">
           <div class="footer-reviews w-50 d-flex">
          <p class="d-flex">
          <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Больше комментариев
          </a>
          <a class="nav-link" data-toggle="collapse" href="#collapseCkeditor" role="button"
          aria-expanded="false" aria-controls="collapseCkeditor">
            Написать коммент
          </a>
        </p>
           </div>
               <div class="footer-buttons w-50 ml-auto">
                   <div class="d-flex button-links">
                       <a href="#" class="like ml-auto">
                           <i class="fas fa-thumbs-up mr-2"></i><span>{like}</span>
                       </a>
                       <a href="#" class="delike ml-4">
                           <i class="fas fa-thumbs-down mr-2"></i><span>{disLike}</span>
                       </a>
                   </div>
               </div>
           </div>
           {editor}
           {collapse}
           
            
        </div>
        
      </div>
    </div>
        

HTML,

        'collapse' => <<<HTMl
         <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="review-header d-flex">
                <div class="header-image">
                   <img class="header-img" src="{userImage}" alt=""> 
                </div>
               <div class="header-name">
                  <p>{userName}</p>
               </div>

               <div class="header-time">
                 <p>{createdAt}</p>
               </div>

               <div class="header-stars d-flex ml-auto">
                 {starRating}
                 
               </div>
           </div>

           <div class="review-content">
               <div class="content-text">
                  <p>{text}</p>
               </div>
           </div>
           <div class="review-footer w-100 d-flex">
           <div class="footer-reviews w-50 d-flex">
          <p>
          <a class="nav-link" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
            Ответы
          </a>
        </p>
           </div>
               <div class="footer-buttons w-50 ml-auto">
                   <div class="d-flex button-links">
                       <a href="#" class="like ml-auto">
                           <i class="fas fa-thumbs-up mr-2"></i><span>{like}</span>
                       </a>
                       <a href="#" class="delike ml-4">
                           <i class="fas fa-thumbs-down mr-2"></i><span>{disLike}</span>
                       </a>
                   </div>
               </div>
           </div>
           {collapse2}
           
          </div>
          
        </div>
HTMl,


        'collapse2' => <<<HTML
         <div class="collapse" id="collapse2">
          <div class="card card-body">
            <div class="review-header d-flex">
                <div class="header-image">
                   <img class="header-img" src="{userImage}" alt=""> 
                </div>
               <div class="header-name">
                  <p>{userName}</p>
               </div>

               <div class="header-time">
                 <p>{createdAt}</p>
               </div>

               <div class="header-stars d-flex ml-auto">
                   {starRating}
               </div>
           </div>

           <div class="review-content">
               <div class="content-text">
                  <p>{text}</p>
               </div>
           </div>
           <div class="review-footer w-100 d-flex">
               <div class="footer-buttons w-50 ml-auto">
                   <div class="d-flex button-links">
                       <a href="#" class="like ml-auto">
                           <i class="fas fa-thumbs-up mr-2"></i><span>{like}</span>
                       </a>
                       <a href="#" class="delike ml-4">
                           <i class="fas fa-thumbs-down mr-2"></i><span>{disLike}</span>
                       </a>
                   </div>
               </div>
           </div>
          </div>
        </div>
HTML,

        'ckeditor' => <<<HTML
        <div class="collapse" id="collapseCkeditor">
          <div class="card card-body">
              {ckeditor}
          </div>
        </div>
HTML,



    ];

    public function asset()
    {
        $this->fileCss('render/market/ZReviewWidget/assets/style.css');
    }

    public function codes()
    {

$app = new UserCompany();
      $items = [];

        $model = new ReviewItem();
        $model->id = 1;
        $model->text = 'asdsadasdsadsadsadsadsadsadasdasdsadsadasdasdsadasdasd';
        $model->user_name = 'John';
        $model->user_image = 'https://img.icons8.com/clouds/2x/user.png';
        $model->like = 10;
        $model->dislike = 5;
        $model->rating = 3;

        $items[] = $model;
        $ckeditor = ZCKEditorWidget::widget([
            'model' => $app,
            
        ]);
        
        foreach ($items as $item) {
            $this->htm .= strtr($this->_layout['main'], [
                '{userImage}' => $item->user_image,
                '{userName}' => $item->user_name,
                '{text}' => $item->text,
                '{id}'=>$item->id,
                '{like}' => $item->like,
                '{disLike}' => $item->dislike,
                '{starRating}' => ZKStarRatingWidget::widget([
                    'model' => $app,
                    'value' => $item->rating,
                    'attribute' => 'name',
                    'config' => [
                        'isDisplayOnly' => true,

                    ]
                ]),
                '{editor}' => strtr($this->_layout['ckeditor'], [
                    '{ckeditor}' => $ckeditor
                ]),
                '{collapse}' => strtr($this->_layout['collapse'], [
                    '{userImage}' => $item->user_image,
                    '{userName}' => $item->user_name,
                    '{text}' => $item->text,
                    '{id}'=>$item->id,
                    '{like}' => $item->like,
                    '{disLike}' => $item->dislike,
                    '{collapse2}' => strtr($this->_layout['collapse2'],[
                        '{userImage}' => $item->user_image,
                        '{userName}' => $item->user_name,
                        '{text}' => $item->text,
                        '{id}'=>$item->id,
                        '{like}' => $item->like,
                        '{disLike}' => $item->dislike,
                    ]),
                ]),
            ]);
        }



       }

      
    


}
