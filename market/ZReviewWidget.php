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

use zetsoft\models\user\UserCompany;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;


class ZReviewWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
      'data' => []
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="row">
      <div class="col-md-10 ml-auto mr-auto p-4 border m-3">
        <div class="review-main">

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
                           <i class="fas fa-thumbs-up mr-2"></i><span id="likeBtn">{like}</span>
                       </a>
                       <a href="#" class="dislike ml-4">
                           <i class="fas fa-thumbs-down mr-2"></i><span id="dislikeBtn">{disLike}</span>
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
         <div class="collapse p-3" id="collapseExample">
          <div class="card card-body mt-2">
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
           </div>

           <div class="review-content">
               <div class="content-text">
                  <p>{text}</p>
               </div>
           </div>
           <div class="review-footer w-100 d-flex">
           <div class="footer-reviews w-50 d-flex">
          <p>
        </p>
           </div>
               <div class="footer-buttons w-50 ml-auto">
                   <div class="d-flex button-links">
                       <a href="#" class="like ml-auto">
                          <i class="fas fa-thumbs-up mr-2"></i><span id="likeBtn">{like}</span>
                       </a>
                       <a href="#" class="dislike ml-4">
                           <i class="fas fa-thumbs-down mr-2"></i><span id="dislikeBtn">{disLike}</span>
                       </a>
                   </div>
               </div>
           </div>
         
           
          </div>
          
        </div>
HTMl,
        
        'ckeditor' => <<<HTML
        <div class="collapse" id="collapseCkeditor">
          <div class="card card-body">
              {ckeditor}
              
              {addButton}
          </div>
        </div>
HTML,
        'addButton' => <<<HTML
        <button class="setReview btn btn-sm btn-primary">Добавит отзыв</button>
HTML,


      'js' => <<<JS

         $('.setReview').on('click', function() {
            var text = $('#myValue').val();
            $.ajax({
                method: "GET",
                url: '/core/product/setReview.aspx',
                data: {
                    reviewId: {id},
                    text: text, 
                },
                success: function(data) {
                   location.assign();
                  /* $.pjax.reload({container: '#begiin', timeout: false})*/
                }
            })
         });
         
         $('.like').on('click', function() {
            $.ajax({
              method: 'GET',
              url: '/core/product/like.aspx',
              data: {
                id: {product_id} 
              },
              success: function(data) {
                 $('#likeBtn').html(data);
              //   console.log(data);
              }
              
            })
         });
         
          $('.dislike').on('click', function() {
            $.ajax({
              method: 'GET',
              url: '/core/product/dislike.aspx',
              data: {
                id: {product_id} 
              },
              success: function(data) {
                 $('#dislikeBtn').html(data);
                // console.log(data);
              }
              
            })
         });
         
         
JS,


    ];

    public function asset()
    {
       // $this->fileCss('/render/market/ZReviewWidget/assets/style.css');
    }

    public function codes()
    {

    $app = new UserCompany();
    
        $ckeditor = ZCKEditorWidget::widget([
            'model' => $app,
            'value' => $this->value,
            'id' => 'myValue'
        ]);

        $addButton = '';

        if (!$this->userIsGuest()){
            $addButton .= strtr($this->_layout['addButton'],[

            ]);
        }else {
            $addButton = '';
        }

        $reviews = '';

        foreach ($this->_config['data'] as $item) {
          
            foreach ($item->items as $value) {
                $reviews .= strtr($this->_layout['collapse'], [
                    '{userImage}' => $value->user_image,
                    '{userName}' => $value->user_name,
                    '{text}' => $value->text,
                    '{id}'=>$value->id,
                    '{like}' => $value->like,
                    '{disLike}' => $value->dislike,
                    '{createdAt}' => $value->created_at,
                ]);
            }
            $this->js = strtr($this->_layout['js'], [
                '{id}' => $item->id,
                '{product_id}' => $item->id
            ]);
            $this->htm .= strtr($this->_layout['main'], [
                '{userImage}' => $item->user_image,
                '{userName}' => $item->user_name,
                '{text}' => $item->text,
                '{id}'=>$item->id,
                '{like}' => $item->like,
                '{disLike}' => $item->dislike,
                '{createdAt}' => $item->created_at,
                '{starRating}' => ZKStarRatingWidget::widget([
                    'model' => $app,
                    'value' => $item->rating,
                    'attribute' => 'name',
                    'config' => [
                        'isDisplayOnly' => true,
                    ]
                ]),
                '{editor}' => strtr($this->_layout['ckeditor'], [
                    '{addButton}' => $addButton,
                    '{ckeditor}' => $ckeditor
                ]),
                '{collapse}' => $reviews
            ]);

        }




       }

      
    


}
