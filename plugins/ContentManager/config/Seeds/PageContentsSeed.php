<?php
use Phinx\Seed\AbstractSeed;

/**
 * PageContents seed.
 */
class PageContentsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $headers = ['id', 'page_id', 'name', 'value', 'created', 'modified'];
        $rows = [
            ['1', '1', 'content', '<h2>Built for teams that move fast... And everyone else.</h2><div class="features col-lg-10 col-md-10 col-sm-12 col-xs-12"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-files-o">&nbsp;</i><h4>File Manager</h4><p>File Manager that supports uploading to Local, Azure, <strong>AWS S3 V2</strong>, <strong>AWS S3 V3</strong>, Copy.com, Dropbox, FTP, GridFS, Memory, Null / Test, Rackspace, ReplicateAdapter, SFTP, WebDAV, PHPCR, ZipArchive. With fully functional file browser.</p></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-pencil-square-o">&nbsp;</i><h4>Content Manager</h4><p>Content manager that allows you to quickly make editable and dynamic or static pages with role management. The freedom to use your own MVC dynamic content using <strong>View Cells.</strong></p></div><div class="clearfix">&nbsp;</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-users">&nbsp;</i><h4>User Manager</h4><p>User manager is the back end Auth that can be used to protect the front end with just one line of code. Allows you to add, edit, view, delete, forget, activate, and role management.</p></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-plug">&nbsp;</i><h4>Plugin Installer</h4><p>IcingManager Plugin Installer allows you to install plugins from the store. Automatically use migrations to migrate plugin DB and seed it. Takes less than 1 minute to convert any CakePHP plugin to be readable by Plugin Installer and uploaded to the store.</p></div><div class="clearfix">&nbsp;</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-picture-o">&nbsp;</i><h4>Theme Installer</h4><p>IcingManager Theme Installer allows you to install themes from the store just like plugins and because CakePHP&#39;s themes are also plugins it allows more functionality than a normal theme has to offer. IcingCMS is probably the first CMS to allow you to activate multiple themes and use the parts from each theme.</p></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-shopping-bag">&nbsp;</i><h4>Demo Plugin &amp; Themes</h4><p>Demo plugin and themes to get you started quickly in make new themes and plugin. Deploy your themes to store to reach a lot of people.</p></div><div class="clearfix">&nbsp;</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-birthday-cake">&nbsp;</i><h4>it is CakePHP</h4><p><strong>No new rules</strong>. It is just like a any other CakePHP Application that makes your life more easier not harder. <strong>No new templating engine</strong> or the need to learn one. Gives you all of that functionality by using Cake&#39;s CTP files and View Cells. Does <strong>absolutely no modification </strong>to CakePHP&#39;s core.</p></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature"><i aria-hidden="true" class="fa fa-question-circle-o">&nbsp;</i><h4>About IcingCMS</h4><p>We started building IcingCMS about year ago when CakePHP 3 was released. We make a lot websites so we need something where we can one click an spin up a new website need for client. This was a closed project then we decided to release to Cake community. We have been using CakePHP for a long time and it is about time we give back to CakePHP&#39;s community. IcingCMS is geared more towards making websites, building API&#39;s, and to be used as backend for SPA&#39;s. You can build a websites with dynamic content pretty quickly.</p></div></div>', '2016-11-04 14:04:35', '2016-11-04 14:11:44'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('page_contents');
        $table->insert($data)->save();
    }
}
