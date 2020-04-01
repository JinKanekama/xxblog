<?php
    class PostsController extends AppController {
        public $uses = array('Post', 'User', 'Good', 'Image', 'Category', 'Tag') ;

        //プラグイン読み込み
        public $components = array('Search.Prg','Paginator', 'Session');  
        public $presetVars = array( 
            'word' => array('type' => 'value'),
            'title' => array('type' => 'value'),  
            'category' => array('type' => 'value'),  
            'tag' => array('type' => 'value'),
          ); 
        public $helpers = array('Html', 'Form');

        public function beforeFilter() {  
            // ページャ設定  
            $pager_numbers = array(  
                'before' => ' - ',  
                'after'=>' - ',  
                'modulus'=> 10,  
                'separator'=> ' ',  
                'class'=>'pagenumbers'  
            );  
            $this->set('pager_numbers', $pager_numbers);  

            $this->Auth->allow('index', 'view', 'searchBlogs', 'news', 'rankings', 'user');
        }  

        //承認機能
        public function isAuthorized($user) {
            if ($this->action === 'index') {
                return true;
            }

            // 登録済ユーザーは投稿できる
            if ($this->action === 'add') {
                return true;
            }
        
            // 投稿のオーナーは編集や削除ができる
            if (in_array($this->action, array('edit', 'delete'))) {
                $postId = (int) $this->request->params['pass'][0];
                if ($this->Post->isOwnedBy($postId, $user['id'])) {
                    return true;
                }
            }
    
            return parent::isAuthorized($user);
        }

        //ユーザーランキング
        public function userRanking(){
            $this->User->Good->virtualFields['Total'] = 'count(Good.recieved_user_id)';
            $where = array(
                'fields' => array(
                    'User.*',
                    'count(Good.recieved_user_id) AS Good__Total',
                ),
                'joins' => array(
                    array(
                        'table' => 'goods',
                        'alias' => 'Good',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'User.id = Good.recieved_user_id'
                        )
                        )
                ),
                'conditions' => array(
                    'NOT' => array(
                        'Good.recieved_user_id' => NULL
                    )
                ),
                'group' => 'Good.recieved_user_id',
                'limit' => 10,
                'order' => array(
                    'Good.Total' => 'desc'
                )
            );
            $user_ranking = $this->User->find('all', $where);
            return $user_ranking;
        }
        
        //投稿一覧表示
        public function index() {
            $blogs = $this->Post->find(
                'all',
                array(
                    'order' => array('Post.id' => 'desc'),
                    'limit' => 10
                )
            );
            $this->set('blogs', $blogs);
            //serchFormのフラグを立てる
            $searchFlag = 1;
            $this->set('searchFlag', $searchFlag);

            //総合速報
            $news = $this->Post->find(
                'all',
                array(
                    'order' => array('Post.created' => 'desc'),
                    'limit' => 5
                )
            );
            $this->set('news', $news);

            //動物速報
            $animals_news = $this->Post->find(
                'all',
                array(
                    'conditions' => array('Category.id' => 1),
                    'order' => array('Post.created' => 'desc'),
                    'limit' => 5
                )
            );
            $this->set('animals_news', $animals_news);
            
            //プログラミング速報
            $programmings_news = $this->Post->find(
                'all',
                array(
                    'conditions' => array('Category.id' => 2),
                    'order' => array('Post.created' => 'desc'),
                    'limit' => 1
                )
            );
            $this->set('programmings_news', $programmings_news);

            //その他の速報
            $others_news = $this->Post->find(
                'all',
                array(
                    'conditions' => array('Category.id' => 3),
                    'order' => array('Post.created' => 'desc'),
                    'limit' => 1
                )
            );
            $this->set('others_news', $others_news);

            //hasManyアソシエーションのカウンターをもつバーチャルフィールド 記事ランキング
            $this->Post->recursive = 1;
            $this->Post->Good->virtualFields['Total'] = 'count(Good.post_id)';
            $where = array(
                'fields' => array(
                    'Post.*',
                    'count(Good.post_id) AS Good__Total',
                ),
                'joins' => array(
                    array(
                        'table' => 'goods',
                        'alias' => 'Good',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Good.post_id'
                        )
                    )
                ),
                'conditions' => array(
                    'NOT' => array(
                        'Good.post_id' => NULL
                    )
                ),
                'group' => 'Good.post_id',
                'limit' => 4,
                'order' => array(
                    'Good.Total' => 'desc'
                )
            );

            
            // Paginator に条件を設定
            $this->paginate = $where;

            // データの取得
            $ranking = $this->Paginator->paginate();
            $this->set('ranking', $ranking);

            //hasManyアソシエーションのカウンターをもつバーチャルフィールド ブロガーランキング
            $this->User->Good->virtualFields['Total'] = 'count(Good.recieved_user_id)';
            $where2 = array(
                'fields' => array(
                    'User.*',
                    'count(Good.recieved_user_id) AS Good__Total',
                ),
                'joins' => array(
                    array(
                        'table' => 'goods',
                        'alias' => 'Good',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'User.id = Good.recieved_user_id'
                        )
                        )

                ),
                'conditions' => array(
                    'NOT' => array(
                        'Good.recieved_user_id' => NULL
                    )
                ),
                'group' => 'Good.recieved_user_id',
                'limit' => 4,
                'order' => array(
                    'Good.Total' => 'desc'
                )
            );
            $this->paginate = $where2;

            // データの取得
            $ranking2 = $this->Paginator->paginate('User');
            $this->set('ranking2', $ranking2);
        }

        public function searchBlogs() {
            //searchプラグイン
            $this->Prg->commonProcess();
            $conditions = $this->Post->parseCriteria($this->passedArgs);
            $this->paginate = array(  
                'conditions' => $conditions,
                'limit' => 10 ,
                'order' => array('Post.id' => 'desc'),
                'recursive' => 2
            );
            $this->set('posts', $this->paginate('Post'));  

            $searchFlag = 1;
            $this->set('searchFlag', $searchFlag);
            $this->set('keyword', $this->passedArgs);

            $tagcheck =  $this->Tag->find( 'list', array( 
                'fields' => array( 'id', 'name')
            ));
            
            $this->set( 'tagCheck', $tagcheck);
            }

        //詳細表示
        public function view($id = null) {
            //time計測 
            $time_start = microtime(true);

            //ブログ取得
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }
            $this->Post->recursive = 2;
            $post = $this->Post->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }
            $this->set('post', $post);

            //関連記事
            $articles = $this->Post->find('all',
                        array(    
                        'conditions' => array('Category.id' => $post['Category']['id']),
                        'limit' => 6,
                        'order' => array('Post.created' => 'desc')
                        ));
            $this->set('articles', $articles);
            
           
            //既にいいねした投稿か調べる
            $user_id = $this->Session->read('Auth.User.id');
            $goodFlag = $this->Good->find('count', array(
                'conditions' => array('Good.post_id' => $id, 'Good.send_user_id' => $user_id)
            ));
            $this->set('goodFlag', $goodFlag);

            $time = microtime(true) - $time_start;
            $this->Flash->success(__($time));
        }

        //投稿
        public function add() {
            $this->loadModel('Category');
            $this->loadModel('Tag');

            $select = $this->Category->find('list', array('fields' => array('id', 'name')));
            $this->set('select', $select);
            
            $this->set( 'check', $this->Tag->find( 'list', array( 
                'fields' => array( 'id', 'name')
            )));

            //postで受信
            if ($this->request->is('post')) {
                $this->Post->create();
                $this->request->data['Post']['user_id'] = $this->Auth->user('id');
                //デバッグ
                // Debugger::dump($this->request->data['Image']);
                //アップロード検証
                for ($i=0; $i<3; $i++) {
                    if (!$this->Post->isUploadedFile($this->request->data['Image'][$i]['name'])){
                        unset($this->request->data['Image'][$i]);
                    }
                }
                if ($this->Post->saveAll($this->request->data, array('deep' => true))) {
                    
                    $this->Flash->success(__('投稿しました。'));
                    return $this->redirect(array('action' => 'index'));
                    
                } 
                $this->Flash->error(__('投稿できませんでした。')); 
            }
        }

        //編集機能
        public function edit($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }
        
            $post = $this->Post->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }
        
            if ($this->request->is(array('post', 'put'))) {
                $this->Post->id = $id;
                if ($this->Post->save($this->request->data)) {
                    $this->Flash->success(__('更新しました'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(__('更新できませんでした。'));
            }
            
            //edit画面のフォームに入る初期値設定
            if (!$this->request->data) {
                $this->request->data = $post;
            }
        }

        //削除機能
        public function delete($id) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
            //postの削除前に変数に格納
            $post = $this->Post->findById($id);
            //$images = $post['Image'];
            
            if ($this->Post->delete($id)) {
                //物理削除の場合
                //投稿画像があるか検出 
                // if (!empty($images)) {
                //     foreach ($images as $i){
                //         $dir_path = "/var/www/html/blogapp/app/webroot/files/image/name/".$i['image_dir'];
                //         $files = array_diff(scandir($dir_path), array('.','..'));
                //         foreach ($files as $file) {
                //             $file_path =  $dir_path ."/".$file;
                //             if (is_file($file_path)) { 
                //                 // ファイルを削除
                //                 unlink($file_path);
                //             }
                //         }
                //         if (is_dir($dir_path)) {
                //             //ディレクトリを削除
                //             rmdir($dir_path);
                //         } 
                //     }
                // }
                $this->Flash->success(
                    __('削除されました。', h($id))
                );
            } else {
                $this->Flash->error(
                    __('削除できませんでした。', h($id))
                );
            }
        
            return $this->redirect(array('action' => 'index'));
        }

        //速報ページ
        public function news($category_id){
            $category_name;
            if (!$category_id) {
                throw new NotFoundException(__('Invalid posts'));
            }
            //カテゴリー別速報
            if ($category_id == "total") {
                $this->paginate = array( 
                        'limit' => 10,
                        'order' => array('Post.id' => 'desc'),
                        'recursive' => 2
                    );
                $news = $this->paginate('Post');
                $category_name = "総合";
            } else {
                $this->paginate = array( 
                    'conditions' => array('Category.id' => $category_id),
                    'limit' => 10,
                    'order' => array('Post.id' => 'desc'),
                    'recursive' => 2
                );
                $news = $this->paginate('Post');
                $category = $this->Category->find('first', array(
                    'fields' => 'Category.name',
                    'conditions' => array('Category.id' => $category_id)
                ));
                $category_name = $category['Category']['name'];
            }
            
            if (!$news) {
                throw new NotFoundException(__('Invalid posts'));
            }
            $this->set('news', $news);
            $this->set('category_name', $category_name);
            
            //カテゴリー一覧取得
            $category_list = $this->Category->find('all', array(
                'fields' => array('Category.id', 'Category.name'),
                'recursive' => -1
            ));
            $this->set('category_list', $category_list);

            //ユーザーランキング
            $user_ranking = $this->userRanking();
            $this->set('user_ranking', $user_ranking);

        }

        //ランキングページ
        public function rankings($category_id){
            $category_name;
            if (!$category_id) {
                throw new NotFoundException(__('Invalid posts 1'));
            }
            $this->Post->recursive = 2;
            
            if ($category_id == "total") {
                $this->Post->Good->virtualFields['Total'] = 'count(Good.post_id)';
                $where = array(
                    'fields' => array(
                        'Post.*',
                        'count(Good.post_id) AS Good__Total',
                    ),
                    'joins' => array(
                        array(
                            'table' => 'goods',
                            'alias' => 'Good',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Post.id = Good.post_id'
                            )
                            ),
                    ),
                    'group' => 'Good.post_id',
                    'conditions' => array(
                        'NOT' => array(
                            'Good.post_id' => NULL
                        )
                    ),
                    'limit' => 10,
                    'order' => array(
                        'Good.Total' => 'desc'
                    )
                );
                // Paginator に条件を設定
                $this->paginate = $where;
                // データの取得
                $rankings = $this->Paginator->paginate();
                $category_name = "総合";
            } else {
                $this->Post->Good->virtualFields['Total'] = 'count(Good.post_id)';
                $where = array(
                    'fields' => array(
                        'Post.*',
                        'count(Good.post_id) AS Good__Total',
                    ),
                    'joins' => array(
                        array(
                            'table' => 'goods',
                            'alias' => 'Good',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Post.id = Good.post_id'
                            )
                            ),
                    ),
                    'conditions' => array(
                        'Category.id' => $category_id,
                        'NOT' => array(
                            'Good.post_id' => NULL
                        )
                    ),
                    'group' => 'Good.post_id',
                    'limit' => 10,
                    'order' => array(
                        'Good.Total' => 'desc'
                    )
                );
                // Paginator に条件を設定
                $this->paginate = $where;

                // データの取得
                $rankings = $this->Paginator->paginate();
                $category = $this->Category->find('first', array(
                    'fields' => 'Category.name',
                    'conditions' => array('Category.id' => $category_id)
                ));
                $category_name = $category['Category']['name'];
            }
            
            if (!$rankings) {
                throw new NotFoundException(__('Invalid posts 2'));
            }
            $this->set('rankings', $rankings);
            $this->set('category_name', $category_name);

            //カテゴリー一覧取得
            $category_list = $this->Category->find('all', array(
                'fields' => array('Category.id', 'Category.name'),
                'recursive' => -1
            ));
            $this->set('category_list', $category_list);

            //ユーザーランキング
            $user_ranking = $this->userRanking();
            // データの取得
            $this->set('user_ranking', $user_ranking);
        }

        //mypageの表示
        public function mypage(){
            $userId = $this->Session->read('Auth.User.id');
            $this->paginate = array( 
                'conditions' => array('Post.user_id' => $userId),
                'limit' => 10,
                'order' => array('Post.id' => 'desc')
            );
            $setting = $this->paginate('Post');
            $this->set('posts', $setting);
        }

        //ユーザーページ
        public function user($user_id, $arg){
            //ユーザー特定
            $user = $this->User->findById($user_id);
            $this->set('user', $user);

            if ($arg == "new"){
                //新着順のユーザーの記事
                $userId = $this->Session->read('Auth.User.id');
                //Paginatorに条件を設定
                $this->paginate = array( 
                    'conditions' => array('Post.user_id' => $user_id),
                    'limit' => 5,
                    'order' => array('Post.id' => 'desc')
                );
                $setting = $this->paginate();
                $this->set('posts', $setting);

            } elseif($arg == "good") {
                //いいね順のユーザーの記事
                $this->Post->Good->virtualFields['Total'] = 'count(Good.post_id)';
                //条件をセット
                $where = array(
                    'fields' => array(
                        'Post.*',
                        'count(Good.post_id) AS Good__Total',
                    ),
                    'joins' => array(
                        array(
                            'table' => 'goods',
                            'alias' => 'Good',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Post.id = Good.post_id'
                            )
                        )
                    ),
                    'conditions' => array(
                        'Post.user_id' => $user_id,
                        'NOT' => array(
                            'Good.post_id' => NULL
                        )
                    ),
                    'recursive' => 2,
                    'group' => 'Good.post_id',
                    'limit' => 5,
                    'order' => array(
                        'Good.Total' => 'desc'
                    )
                );
                
                // Paginator に条件を設定
                $this->paginate = $where;
                // データの取得
                $rankings = $this->Paginator->paginate();
                $this->set('posts', $rankings);
            }
            $this->set('arg', $arg);
        }
    }

?>
