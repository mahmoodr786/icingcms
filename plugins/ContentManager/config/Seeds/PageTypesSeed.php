<?php
use Phinx\Seed\AbstractSeed;

/**
 * PageTypes seed.
 */
class PageTypesSeed extends AbstractSeed
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
        $headers = ['id', 'name', 'layout', 'file_name', 'created', 'modified'];
        $rows = [
            ['1', 'Home Page', 'default', 'homepage', '2016-07-08 17:06:17', '2016-07-08 17:06:17'],
            ['2', 'Page', 'default', 'page', '2016-05-17 18:16:26', '2016-07-08 17:06:28'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('page_types');
        $table->insert($data)->save();
    }
}
