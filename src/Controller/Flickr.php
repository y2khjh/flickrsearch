<?php
namespace FlickrSearch\Controller;

use FlickrSearch\Http;
use FlickrSearch\Model;
use FlickrSearch\Library;
use FlickrSearch\View;

class Flickr extends App{

    const IMAGES_PER_PAGE = 5;

    /**
     * @param Http\Request $request
     *
     * this is the flickr controller control the data retrieving and view display
     */
    public function __construct(Http\Request $request) {
        parent::__construct($request);
        $this->model_flickrapi = new Model\FlickrAPI();
    }

    /**
     * control the image search and display
     */
    public function action_search() {
        $data = array();

        if (isset($this->request->params['text']) && trim($this->request->params['text'])) {
            // sanitizing
            $text = filter_var($this->request->params['text'], FILTER_SANITIZE_STRING);
            $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

            $current_page = 1;
            if (isset($this->request->params['page']) && is_numeric($this->request->params['page']) && $this->request->params['page']>0) {
                $current_page = intval($this->request->params['page']);
            }

            $this->model_flickrapi->search_image($text, self::IMAGES_PER_PAGE, $current_page);
            $total_num = $this->model_flickrapi->get_images_total_num();
            $images = $this->model_flickrapi->get_images();

            $urlPattern = "?text=".urlencode($this->request->params['text'])."&page=(:num)";
            $pagination = new Library\Pagination($total_num, self::IMAGES_PER_PAGE, $current_page, $urlPattern);

            $data['images'] = $images;
            $data['pagination'] = $pagination;
        }
        $view = new View('index');
        $view->set_data($data);
        echo $this->show($view);
    }
}
