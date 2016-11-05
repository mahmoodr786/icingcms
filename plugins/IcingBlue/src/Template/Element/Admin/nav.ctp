<?php
    use Cake\Core\Configure;
    use Cake\Routing\Router;
    $links = Configure::read('globalAdminMenu');
?>

<?php if($this->request->Session()->read('Auth.User.role_id') == 1 && !isset($params['iframe'])):?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-admin-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?= $this->Html->link($links['brand']['name'],$links['brand']['url'],$links['brand']['options']);?>
    </div>
    <form class="navbar-form navbar-left">
        <div class="form-group searchdiv">
            <input type="text" class="form-control" placeholder="Search">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
    </form>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php
                $img = $this->request->Session()->read('Auth.User.img_url');
                $img = !empty($img) ? $img : 'http://placehold.it/50x50';
                echo $this->Html->image($img,['class' =>'user-img']); 
            ?>
            <?= $this->request->Session()->read('Auth.User.name');?> 
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link('Logout',['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'logout'],['class' => 'logout-link']);?></li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-admin-1">
        <ul class="nav navbar-nav side-nav">
            <?php $i = 0;?>
            <?php
                usort($links['menus'], function($link1, $link2){
                    return $link1['weight'] - $link2['weight'];
                }); 
            ?>
            <?php foreach ($links['menus'] as $link):?>
                <?php $isActive = $this->Theme->isActive($link['url']);?>
                <li class="<?= $isActive ? 'active' : '';?> <?= $link['dropdown'] ? 'dropdown' : ''; ?>">
                    <?php 
                        $icon = !empty($link['icon']) ? '<i class="' . $link['icon'] . '"></i> ' : ''; 
                        $link['options']['escape'] = false;
                        if($link['dropdown']){
                            $link['name'] .= ' <span class="caret"></span>';
                            $link['url'] = '#';
                            $link['options']['data-toggle'] = 'collapse';
                            $link['options']['data-target'] = '#link-' . $i;
                        }
                    ?>
                    <?= $this->Html->link($icon . $link['name'],$link['url'],$link['options']);?>
                    <?php if(count($link['childrens']) > 0):?>
                        <ul class="collapse <?= $isActive ? 'in' : '';?>" id="link-<?=$i;?>">
                        <?php foreach ($link['childrens'] as $chlink):?>
                            <?php $isActive = $this->Theme->isActive($chlink['url']);?>
                             <li class="<?= $isActive ? 'active' : '';?>">
                                <?= $this->Html->link($chlink['name'],$chlink['url'],$chlink['options']);?>
                            </li>
                        <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </li>
            <?php $i++;?>
            <?php endforeach;?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
    </nav>
<?php endif;?>