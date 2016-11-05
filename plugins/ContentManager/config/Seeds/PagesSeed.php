<?php
use Phinx\Seed\AbstractSeed;

/**
 * Pages seed.
 */
class PagesSeed extends AbstractSeed
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
        $data = [
            ['id' => '1', 'page_type_id' => '1', 'role_id' => '3', 'name' => 'Home', 'url' => '/', 'meta_title' => 'IcingCMS,CakePHP,CakePHP 3,CMS,MVC,MVC CMS,Best CMS', 'meta_description' => 'IcingCMS a new CakePHP 3 CMS', 'status' => '1', 'created' => '2015-10-22 20:26:21', 'modified' => '2016-11-04 14:04:35'],
        ];

        $table = $this->table('pages');
        $table->insert($data)->save();
    }
}
